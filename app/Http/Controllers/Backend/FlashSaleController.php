<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\FlashSaleItemDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\FlashSaleAddProductRequest;
use App\Http\Requests\FlashSaleUpdateRequest;
use App\Interfaces\FlashSaleItemRepositoryInterface;
use App\Interfaces\FlashSaleRepositoryInterface;
use App\Interfaces\ProductRepositoryInterface;
use Illuminate\Http\Request;

class FlashSaleController extends Controller
{
    public function index(FlashSaleItemDataTable $datatable)
    {
        $flashSaleDate = app(FlashSaleRepositoryInterface::class)->getFlashSale();
        $products = app(ProductRepositoryInterface::class)->getActiveProducts();
        return $datatable->render('admin.flash-sale.index' , compact(
            'flashSaleDate',
            'products'
        ));
    }

    public function update(FlashSaleUpdateRequest $request)
    {

        app(FlashSaleRepositoryInterface::class)->createFlashSale($request->validated());

        toastr()->success('Flash Sale Updated Successfully!');
        return redirect()->route('admin.flash-sale.index');

    }

    public function addProduct(FlashSaleAddProductRequest $request)
    {
        $flashSaleDate = app(FlashSaleRepositoryInterface::class)->getFlashSale();
        $flashSaleId = $flashSaleDate->id;

        app(FlashSaleItemRepositoryInterface::class)->addProductToFlashSale(array_merge($request->validated(),['flash_sale_id'=>$flashSaleId]));

        toastr()->success('Product Added to Flashsale Successfully!');
        return redirect()->route('admin.flash-sale.index');
    }

    public function changeShowatHomeStatus(Request $request)
    {
        $request->status=='false' ? $status = 0 : $status = 1;

        $data = ['show_at_home'=> $status];
        app(FlashSaleItemRepositoryInterface::class)->updateInHomeStatus($data ,$request->id);
        return response(['status' =>'success' , 'message' =>"Show at Home status updated successfully"]);
    }

    public function changeStatus(Request $request)
    {
        $request->status=='false' ? $status = 0 : $status = 1;

        $data = ['status'=> $status];
        app(FlashSaleItemRepositoryInterface::class)->updateStatus($data ,$request->id);
        return response(['status' =>'success' , 'message' =>"Status updated successfully"]);
    }

    public function destroy($id)
    {
        app(FlashSaleItemRepositoryInterface::class)->deleteItem($id);

        return response(["status" => "success" , "message" =>
        "Product deleted from flash sale successfully!"]);
    }
}
