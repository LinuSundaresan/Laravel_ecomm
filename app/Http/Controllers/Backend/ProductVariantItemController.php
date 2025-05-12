<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ProductVariantItemDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductVariantItemRequest;
use App\Http\Requests\ProductVariantItemStatusUpdateRequest;
use App\Http\Requests\ProductVariantItemUpdateRequest;
use App\Interfaces\ProductRepositoryInterface;
use App\Interfaces\ProductVariantItemRepositoryInterface;
use App\Interfaces\ProductVariantRepositoryInterface;
use Illuminate\Http\Request;

class ProductVariantItemController extends Controller
{
    public function index(ProductVariantItemDataTable $datatable, $productId, $variantId)
    {
        $product = app(ProductRepositoryInterface::class)->getById($productId);
        $variant = app(ProductVariantRepositoryInterface::class)->getById($variantId);
        return $datatable->render('admin.product.product-variant-item.index' , compact(
            'product',
            'variant'
        ));
    }


    public function create($productId, $variantId)
    {
        $variant = app(ProductVariantRepositoryInterface::class)->getById($variantId);
        $product = app(ProductRepositoryInterface::class)->getById($productId);
        return view('admin.product.product-variant-item.create', compact('variant', 'product'));
    }

    public function store(ProductVariantItemRequest $request)
    {
        app(ProductVariantItemRepositoryInterface::class)->create($request->validated());

        toastr()->success('Product Variant item created successfully');
        return redirect()->route('admin.products-variant-item.index', ['productId'=>$request->product_id, 'variantId'=>$request->product_variant_id]);
    }

    public function edit($variantId)
    {
        $variantData = app(ProductVariantItemRepositoryInterface::class)->getById($variantId);
        return view('admin.product.product-variant-item.edit', compact('variantData'));
    }

    public function update(ProductVariantItemUpdateRequest $request , $variantId)
    {

        $variantItem = app(ProductVariantItemRepositoryInterface::class)->getById($variantId);
        $variantId = $variantItem->productVariant->id;

        $productId = app(ProductVariantRepositoryInterface::class)->getById($variantId)->product->id;

        app(ProductVariantItemRepositoryInterface::class)->update($request->validated(), $variantId);

        toastr()->success('Variant Item Updated Successfully!');
        return redirect()->route('admin.products-variant-item.index', ['productId'=>$productId ,'variantId'=>$variantId]);
    }

    public function destroy($variantItemId)
    {
        app(ProductVariantItemRepositoryInterface::class)->delete($variantItemId);
        return response(['status' =>'success', 'message' => 'Product Variant Item deleted successfully']);
    }

    public function changeStatus(ProductVariantItemStatusUpdateRequest $request)
    {
        $request->status=='false' ? $status = 0 : $status = 1;

        $data = ['status'=> $status];
        app(ProductVariantItemRepositoryInterface::class)->updateStatus($data ,$request->id);
        return response(['status' =>'success' , 'message' =>"Status updated successfully"]);
    }
}
