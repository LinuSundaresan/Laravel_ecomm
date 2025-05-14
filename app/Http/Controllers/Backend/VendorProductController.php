<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\VendorProductDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\VendorProductRequest;
use App\Http\Requests\VendorProductUpdateRequest;
use App\Interfaces\BrandRepositoryInterface;
use App\Interfaces\CategoryRepositoryInterface;
use App\Interfaces\ChildCategoryRepositoryInterface;
use App\Interfaces\ProductRepositoryInterface;
use App\Interfaces\SubCategoryRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Traits\ImageUploadTrait;

class VendorProductController extends Controller
{

    use ImageUploadTrait;

    /**
     * Display a listing of the resource.
     */
    public function index(VendorProductDataTable $datatable)
    {
        return $datatable->render('vendor.product.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = app(CategoryRepositoryInterface::class)->getAll();
        $brands = app(BrandRepositoryInterface::class)->getAll();
        return view('vendor.product.create' , compact(
            'categories', 'brands'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VendorProductRequest $request)
    {
        $path = $this->uploadImage($request, 'thumb_image', 'uploads/products');
        $slug = Str::slug($request->name);
        $vendor = Auth::user()->vendor->id;
        $is_approved = 0;
        app(ProductRepositoryInterface::class)->create(array_merge($request->validated(),['slug'=>$slug],['thumb_image'=>$path], ['vendor_id'=>$vendor] , ['is_approved'=>$is_approved]));

        toastr()->success('Product Added Successfully!');
        return redirect()->route('vendor.products.index');
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
        $product = app(ProductRepositoryInterface::class)->getById($id);

        if($product->vendor_id != Auth::user()->vendor->id){
            abort(403, 'You are not authorized to access this product');
        }

        $brands = app(BrandRepositoryInterface::class)->getAll();
        $categories = app(CategoryRepositoryInterface::class)->getAll();
        $subCategories = app(SubCategoryRepositoryInterface::class)->getSubCategoryByCategoryId($product->category_id);
        $childCategories = app(ChildCategoryRepositoryInterface::class)->getChildCategoryBySubCategoryId($product->sub_category_id);
        return view('vendor.product.edit' , compact('product' , 'brands' , 'categories' , 'subCategories' , 'childCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(VendorProductUpdateRequest $request, string $id)
    {
        $product = app(ProductRepositoryInterface::class)->getById($id);

        if($product->vendor_id != Auth::user()->vendor->id){
            abort(403, 'You are not authorized to access this product');
        }

        $path = $this->updateImage($request, 'thumb_image', 'uploads/products', $product->thumb_image);
        $is_approved = 0;

        app(ProductRepositoryInterface::class)->update(array_merge($request->validated(),['thumb_image'=>empty(!$path)? $path: $product->thumb_image],['is_approved'=>$is_approved] ), $id);

        toastr()->success('Product Update Successfully!');
        return redirect()->route('vendor.products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    public function getSubCategories(Request $request)
    {
        $subCategories = app(SubCategoryRepositoryInterface::class )->getSubCategoryByCategoryId($request->id);
         return $subCategories;
    }

    public function getChildCategories(Request $request)
    {
        $childCategories = app(ChildCategoryRepositoryInterface::class )->getChildCategoryBySubCategoryId($request->id);
       return $childCategories;
    }
}
