<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ProductVariantDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductVariantRequest;
use App\Http\Requests\ProductVariantUpdateRequest;
use App\Interfaces\ProductVariantItemRepositoryInterface;
use App\Interfaces\ProductVariantRepositoryInterface;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductVariantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request , ProductVariantDataTable $datatable)
    {
        $product = Product::findOrFail($request->product);
        return $datatable->render('admin.product.product-variant.index' , compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.product.product-variant.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductVariantRequest $request)
    {
        app(ProductVariantRepositoryInterface::class)->create($request->validated());
        toastr()->success('Product Variant created successfully');
        return redirect()->route('admin.products-variant.index', ['product'=>$request->product_id]);
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
        $varient = app(ProductVariantRepositoryInterface::class)->getById($id);
        return view('admin.product.product-variant.edit' , compact(
            'varient'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductVariantUpdateRequest $request, string $id)
    {
        $data = $request->validated();
        $variant = app(ProductVariantRepositoryInterface::class)->getProductByVariant( $id);
        app(ProductVariantRepositoryInterface::class)->update($data , $id);

        toastr()->success('Product Variant Updated Successfully!');
        return redirect()->route('admin.products-variant.index', ['product'=>$variant->product_id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $productVariantItemCount = app(ProductVariantItemRepositoryInterface::class)->getVariantItemCountByVariant($id);

        if($productVariantItemCount > 0)
        {
            return response(['status' =>'error' , 'message' =>"This Variant contains variant items. Inorder to delete this Variant you have to delete all variant items first"]);
        }

        app(ProductVariantRepositoryInterface::class)->delete($id);
        return response(['status' =>'success', 'message' => 'Product Variant deleted successfully']);
    }

    /**
     * Update Status
     */

     public function updateStatus(Request $request)
     {
        $request->status=='false' ? $status = 0 : $status = 1;
        $data = ['status'=> $status];
        app(ProductVariantRepositoryInterface::class)->updateStatus($data ,$request->id);
        return response(['status' =>'success' , 'message' =>"Status updated successfully"]);
     }

}
