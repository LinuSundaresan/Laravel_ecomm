<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Interfaces\GeneralSettingRepositoryInterface;
use App\Interfaces\OrderRepositoryInterface;
use App\Interfaces\PaypalSettingRepositoryInterface;
use App\Interfaces\ProductRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

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

    public function storeOrder($paymentMethod , $paymentStatus)
    {
        $settings = app(GeneralSettingRepositoryInterface::class)->getGeneralSetting();

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
            'order_status'  =>  0
        ];

        $order_id = app(OrderRepositoryInterface::class)->store($orderData);

        $orderProducts = [];

        foreach(\Cart::content() as $item){

            $product = app(ProductRepositoryInterface::class)->getById($item->id);
            $orderProduct['order_id'] = $order_id;
            $orderProduct['product_id'] = $product->id;
            $orderProduct['vendor_id'] = $product->vendor_id;
            $orderProduct['product_name'] = $product->name;
            $orderProduct['variants'] = json_encode($item->options->variants);
            $orderProduct['variant_total'] = $item->options->variant_total;
        }
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
        // dd($config);

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

        // dd($response);

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
}
