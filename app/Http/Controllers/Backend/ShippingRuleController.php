<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ShippingRuleDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\ShippingRuleRequest;
use App\Http\Requests\ShippingRuleUpdateRequest;
use App\Interfaces\ShippingruleRepositoryInterface;
use Illuminate\Http\Request;

class ShippingRuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ShippingRuleDataTable $datatable)
    {
        return $datatable->render('admin.shipping-rule.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.shipping-rule.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ShippingRuleRequest $request)
    {
        app(ShippingruleRepositoryInterface::class)->create($request->validated());
        toastr('Shipping Rule created Succesfully');
        return redirect()->route('admin.shipping-rule.index');
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
        $shipping_rule = app(ShippingruleRepositoryInterface::class)->getByid($id);
        return view('admin.shipping-rule.edit', compact(
            'shipping_rule'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ShippingRuleUpdateRequest $request, string $id)
    {
        app(ShippingruleRepositoryInterface::class)->update($request->validated(), $id);
        toastr('Shipping Rule updated Succesfully');
        return redirect()->route('admin.shipping-rule.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        app(ShippingruleRepositoryInterface::class)->delete($id);

        return response(["status" => "success" , "message" =>
        "Shipping Rule deleted successfully!"]);
    }

    /*** Update status **/

    public function updateStatus(Request $request)
    {
        $request->status=='false' ? $status = 0 : $status = 1;

         $data = ['status'=> $status];
         app(ShippingruleRepositoryInterface::class)->updateStatus($data ,$request->id);
         return response(['status' =>'success' , 'message' =>"Status updated successfully"]);
    }
}
