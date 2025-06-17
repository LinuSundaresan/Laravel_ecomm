<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaypaySettingUpdateRequest;
use App\Interfaces\PaypalSettingRepositoryInterface;
use Illuminate\Http\Request;

class PaypalSettingController extends Controller
{

    /**
     * Update the specified resource in storage.
     */
    public function update(PaypaySettingUpdateRequest $request, string $id)
    {
        app(PaypalSettingRepositoryInterface::class)->update($id , $request->validated());
        toastr()->success('Paypal Settings Updated Successfully!');
        return redirect()->back();
    }
}
