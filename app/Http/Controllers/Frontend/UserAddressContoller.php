<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserAddressRequest;
use App\Http\Requests\UserAddressUpdateRequest;
use App\Interfaces\UserAddressRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAddressContoller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $addresses = app(UserAddressRepositoryInterface::class)->getAll(Auth::user()->id);
        return view('frontend.dashboard.address.index' , compact(
            'addresses'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('frontend.dashboard.address.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserAddressRequest $request)
    {
        app(UserAddressRepositoryInterface::class)->create(array_merge($request->validated(), ['user_id' => Auth::user()->id]));

        toastr()->success('User Address Added Successfully!');
        return redirect()->route('user.address.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $address = app(UserAddressRepositoryInterface::class)->getById($id);
        return view('frontend.dashboard.address.edit', compact(
            'address'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserAddressUpdateRequest $request, string $id)
    {
        app(UserAddressRepositoryInterface::class)->update(array_merge($request->validated(), ['user_id' => Auth::user()->id]), $id);

        toastr()->success('User Address Updated Successfully!');
        return redirect()->route('user.address.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        app(UserAddressRepositoryInterface::class)->delete($id);
        return response(['status' =>'success' , 'message' =>"Address deleted successfully"]);
    }
}
