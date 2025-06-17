<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Interfaces\PaypalSettingRepositoryInterface;
use Illuminate\Http\Request;

class PaymentSettingController extends Controller
{
    public function index()
    {
        $paypalSettings = app(PaypalSettingRepositoryInterface::class)->getPaypalSettings();
        return view('admin.payment-settings.index', compact(
            'paypalSettings'
        ));
    }
}
