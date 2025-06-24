<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\CancelledOrderDataTable;
use App\DataTables\DeliveredOrderDataTable;
use App\DataTables\DroppedoffOrderDataTable;
use App\DataTables\OrderDataTable;
use App\DataTables\OutForDeliveryOrderDataTable;
use App\DataTables\PendingOrderDataTable;
use App\DataTables\ProcessedOrderDataTable;
use App\DataTables\ShippedOrderDataTable;
use App\Http\Controllers\Controller;
use App\Interfaces\OrderRepositoryInterface;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(OrderDataTable $dataTable)
    {
        return $dataTable->render('admin.order.index');
    }

    /**All pending orders */
    public function pendingOrders(PendingOrderDataTable $dataTable)
    {
        return $dataTable->render('admin.order.pending-order');
    }

    /**All processed orders */
    public function processedOrders(ProcessedOrderDataTable $dataTable)
    {
        return $dataTable->render('admin.order.processed-order');
    }

    /**All processed orders */
    public function droppedoffOrders(DroppedoffOrderDataTable $dataTable)
    {
        return $dataTable->render('admin.order.droppedoff-order');
    }

    /**All shipped orders */
    public function shippedOrders(ShippedOrderDataTable $dataTable)
    {
        return $dataTable->render('admin.order.shipped-order');
    }

    /**All out for delivery orders */
    public function outForDeliveryOrders(OutForDeliveryOrderDataTable $dataTable)
    {
        return $dataTable->render('admin.order.out-for-delivery-order');
    }

    /**All delivered orders */
    public function deliveredOrders(DeliveredOrderDataTable $dataTable)
    {
        return $dataTable->render('admin.order.delivered-order');
    }

    /**All cancelled orders */
    public function cancelledOrders(CancelledOrderDataTable $dataTable)
    {
        return $dataTable->render('admin.order.cancelled-order');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order = app(OrderRepositoryInterface::class)->getById($id);
        return view('admin.order.show', compact(
            'order'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        app(OrderRepositoryInterface::class)->deleteOrdersWithDependencies($id);
        return response(['status'=>'success', 'message' => 'Order deleted succesfully']);
    }

    /**
     * Change order status
     */
    public function changeOrderStatus(Request $request)
    {
        app(OrderRepositoryInterface::class)->updateOrderStatus($request->status, $request->id);
        return response(['status'=>'success', 'message'=> 'Order status updated succesfully']);
    }

    /**
     * Change order status
     */
    public function changePaymentStatus(Request $request)
    {
        app(OrderRepositoryInterface::class)->updatePaymentStatus($request->status, $request->id);
        return response(['status'=>'success', 'message'=> 'Payment status updated succesfully']);
    }


}
