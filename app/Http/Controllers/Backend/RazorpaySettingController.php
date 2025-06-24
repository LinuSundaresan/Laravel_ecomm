<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\RazorpaySettingUpdateRequest;
use App\Interfaces\RazorpaySettingRepositoryInterface;
use Illuminate\Http\Request;

class RazorpaySettingController extends Controller
{
    public function update(RazorpaySettingUpdateRequest $request, string $id)
    {
        app(RazorpaySettingRepositoryInterface::class)->update($id , $request->validated());
        toastr()->success('Razorpay Settings Updated Successfully!');
        return redirect()->back();
    }
}
