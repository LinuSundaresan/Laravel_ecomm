<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\VendorOrderDataTable;
use App\Http\Controllers\Controller;
use App\Interfaces\OrderRepositoryInterface;
use Illuminate\Http\Request;

class VendorOrderController extends Controller
{
    public function index(VendorOrderDataTable $datatable)
    {
        return $datatable->render('vendor.order.index');
    }

    public function show($id)
    {
        $order = app(OrderRepositoryInterface::class)->getByIdwithUser($id);
        return view('vendor.order.show', compact(
            'order'
        ));
    }

    public function orderStatus(Request $request, $id)
    {
        $data =  $request->order_status;
        app(OrderRepositoryInterface::class)->updateOrderStatus($data, $id);
        toastr('Order status updated successfully', 'success');

        return redirect()->back();
    }
}
