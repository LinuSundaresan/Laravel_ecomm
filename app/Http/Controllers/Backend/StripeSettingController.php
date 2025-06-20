<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StripeSettingUpdateRequest;
use App\Interfaces\StripeSettingRepositoryInterface;
use Illuminate\Http\Request;

class StripeSettingController extends Controller
{
    public function update(StripeSettingUpdateRequest $request, string $id)
    {
        app(StripeSettingRepositoryInterface::class)->update($id , $request->validated());
        toastr()->success('Stripe Settings Updated Successfully!');
        return redirect()->back();
    }
}
