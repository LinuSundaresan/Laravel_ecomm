<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Interfaces\PaypalSettingRepositoryInterface;
use Illuminate\Http\Request;
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
            return "Paid Succcesfully";
        }

        return redirect()->route('user.paypalCancel');
    }

    /**paypal success */
    public function paypalCancel(Request $request)
    {
        dd($request->all());
    }
}
