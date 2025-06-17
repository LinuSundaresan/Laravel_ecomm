<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\PlaceOrderRequest;
use App\Http\Requests\UserAddressRequest;
use App\Interfaces\ShippingruleRepositoryInterface;
use App\Interfaces\UserAddressRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    //

    public function index()
    {
        $addresses = app(UserAddressRepositoryInterface::class)->getAll(Auth::user()->id);
        $shippingMethods = app(ShippingruleRepositoryInterface::class)->getActive();
        return view('frontend.pages.checkout', compact('addresses', 'shippingMethods'));
    }

    public function createAddress(UserAddressRequest $request)
    {
        app(UserAddressRepositoryInterface::class)->create(array_merge($request->validated(), ['user_id' => Auth::user()->id]));
        toastr()->success('User Address Added Successfully!');
        return redirect()->back();
    }

    public function placeOrder(PlaceOrderRequest $request)
    {
        $shippingMethod = app(ShippingruleRepositoryInterface::class)->getByid($request->shipping_method_id);

        if($shippingMethod){
            Session::put('shipping_method', [
                'id'    =>  $shippingMethod->id,
                'name'  =>  $shippingMethod->name,
                'type'  =>  $shippingMethod->type,
                'cost'  =>  $shippingMethod->cost,
            ]);
        }

        $address = app(UserAddressRepositoryInterface::class)->getById($request->shipping_address_id)->toArray();
        if($address){
            Session::put('address', $address);
        }

        return response(['status' => 'success' , 'redirect_url' => route('user.payment')]);
    }
}
