<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Interfaces\GeneralSettingRepositoryInterface;
use App\Interfaces\OrderProductRepositoryInterface;
use App\Interfaces\OrderRepositoryInterface;
use App\Interfaces\PaypalSettingRepositoryInterface;
use App\Interfaces\ProductRepositoryInterface;
use App\Interfaces\StripeSettingRepositoryInterface;
use App\Interfaces\TransactionRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Stripe\Charge;
use Stripe\Stripe;

class PaymentController extends Controller
{
    public function index()
    {
        if(!Session::has('address')){
            return redirect()->route('user.checkout');
        }
        return view('frontend.pages.payment');
    }

    public function paymentSuccess()
    {
        return view('frontend.pages.payment-success');
    }

    public function storeOrder($paymentMethod , $paymentStatus , $transactionId, $paidAmount , $paidCurrencyName)
    {

        $settings = app(GeneralSettingRepositoryInterface::class)->getGeneralSetting();

        //store order details
        $orderData = [
            'invoice_id'    =>  rand(1,99999),
            'user_id'       =>  Auth::user()->id,
            'sub_total'     =>  getMainCartTotal(),
            'amount'        =>  getFinalPayableAmount(),
            'currency_name' =>  $settings->currency_name,
            'currency_icon' =>  $settings->currency_icon,
            'product_qty'   =>  \Cart::content()->count(),
            'payment_method'=>  $paymentMethod,
            'payment_status'=>  $paymentStatus,
            'order_address' =>  json_encode(Session::get('address')),
            'shipping_method'=> json_encode(Session::get('shipping_method')),
            'coupen'        =>  json_encode(Session::get('coupen')),
            'order-status'  =>  0
        ];

        $order_id = app(OrderRepositoryInterface::class)->store($orderData);

        //store order products
        $orderProducts = [];

        foreach(\Cart::content() as $item){

            $product = app(ProductRepositoryInterface::class)->getById($item->id);
            $orderProducts['order_id'] = $order_id;
            $orderProducts['product_id'] = $product->id;
            $orderProducts['vendor_id'] = $product->vendor_id;
            $orderProducts['product_name'] = $product->name;
            $orderProducts['variants'] = json_encode($item->options->variants);
            $orderProducts['variantTotal'] = $item->options->variant_total;
            $orderProducts['unit_price'] = $item->price;
            $orderProducts['qty'] = $item->qty;

            app(OrderProductRepositoryInterface::class)->store($orderProducts);
        }

        //store transaction details
        $transactionDetails = [];

        $transactionDetails['order_id'] = $order_id;
        $transactionDetails['transaction_id'] = $transactionId;
        $transactionDetails['payment_method'] = $paymentMethod;
        $transactionDetails['amount'] = getFinalPayableAmount();
        $transactionDetails['amount_real_currency'] = $paidAmount;
        $transactionDetails['amount_real_currency_name'] = $paidCurrencyName;

        app(TransactionRepositoryInterface::class)->store($transactionDetails);
    }

    public function clearSession()
    {
        \Cart::destroy();
        Session::forget('address');
        Session::forget('coupen');
        Session::forget('shipping_method');
    }

    public function paypalConfig()
    {
        $paypalSetting = app(PaypalSettingRepositoryInterface::class)->getPaypalSettings();
        $config = [
            'mode'    => $paypalSetting->mode==1 ? 'live' : 'sandbox',
            'sandbox' => [
                'client_id'         => $paypalSetting->client_id,
                'client_secret'     => $paypalSetting->secret_key,
                'app_id'            => '',
            ],
            'live' => [
                'client_id'         => $paypalSetting->client_id,
                'client_secret'     => $paypalSetting->secret_key,
                'app_id'            => '',
            ],

            'payment_action' => 'Sale',
            'currency'       => $paypalSetting->currency_name,
            'notify_url'     => '',
            'locale'         => 'en_US',
            'validate_ssl'   => true,
        ];

        return $config;
    }

    /**paypal redirect */
    public function payWithPaypal()
    {
        $config = $this->paypalConfig();

        // $provider = new PayPalClient();
        $provider = new PayPalClient($config);
        // $provider->setApiCredentials($config);

        $provider->getAccessToken();

        $total = getFinalPayableAmount();

        // $response = $provider->createOrder([
        //     "intent" =>  "CAPTURE",
        //     "application_context" => [
        //         "return_url" => route('user.paypal.success'),
        //         "cancel_url" => route('user.paypal.cancel')
        //     ],
        //     "purchase_units" => [
        //         "amount" => [
        //             "currency_code"=> $config['currency'],
        //             "value" => $total
        //         ]
        //     ]
        // ]);

        $config['currency'] = 'USD';
        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('user.paypal.success'),
                "cancel_url" => route('user.paypal.cancel')
            ],
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => $config['currency'],
                        "value" => $total
                    ]
                ]
            ]
        ]);

        if(isset($response['id']) && $response['id']!=null){
            foreach($response['links'] as $links){
                if($links['rel'] == 'approve'){
                    return redirect()->away($links['href']);
                }
            }
        } else {
            return redirect()->route('user.paypal.cancel');
        }

    }

    /**paypal success */
    public function paypalSuccess(Request $request)
    {
        $config = $this->paypalConfig();
        $provider = new PayPalClient($config);
        $provider->getAccessToken();

        $response = $provider->capturePaymentOrder($request->token);

        if(isset($response['status']) && $response['status']=='COMPLETED'){

            $paypalSetting = app(PaypalSettingRepositoryInterface::class)->getPaypalSettings();
            $total = getFinalPayableAmount();
            $paidAmount = round($total * $paypalSetting->currency_rate, 2);

            $this->storeOrder('paypal', 1, $response['id'], $paidAmount , $paypalSetting->currency_name);

            //clearSession
            $this->clearSession();

            return redirect()->route('user.payment.success');
        }

        return redirect()->route('user.paypalCancel');
    }

    /**paypal success */
    public function paypalCancel(Request $request)
    {
        toastr('Something went wrong, try again later!', 'error', 'Error');
        return redirect()->route('user.payment');
    }


    /**stripe payment */
    public function payWithStripe(Request $request)
    {
        $total = getFinalPayableAmount();

        $stripeSetting = app(StripeSettingRepositoryInterface::class)->getStripeSettings();
        Stripe::setApiKey($stripeSetting->secret_key);
        $response = Charge::create([
            "amount"    =>  $total * 100,
            "currency"  =>  $stripeSetting->currency_name,
            "source"    =>  $request->stripe_token,
            "description"=>  'Product Purchase'
        ]);

        if($response->status == 'succeeded'){
            $this->storeOrder('stripe', 1, $response->id, $total , $stripeSetting->currency_name);

            $this->clearSession();
            return redirect()->route('user.payment.success');

        } else {
            toastr('Something went wrong, try again later!', 'error', 'Error');
            return redirect()->route('user.payment');
        }
    }
}
