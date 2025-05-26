<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\SellerPendingProductsDataTable;
use App\DataTables\SellerProductsDataTable;
use App\Http\Controllers\Controller;
use App\Interfaces\ProductRepositoryInterface;
use Illuminate\Http\Request;

class SellerProductController extends Controller
{

    public function index(SellerProductsDataTable $datatable)
    {
        return $datatable->render('admin.product.seller-product.index');
    }

    public function pendingProducts(SellerPendingProductsDataTable $datatable)
    {
        return $datatable->render('admin.product.seller-pending-products.index');
    }

    public function changeApproveStatus(Request $request)
    {
        app(ProductRepositoryInterface::class)->updateApproval(['is_approved'=>$request->value ], $request->id);
        return response(['message' => 'Product Approve status changed']);
    }
}
