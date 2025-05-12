<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ProductDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Interfaces\BrandRepositoryInterface;
use App\Interfaces\CategoryRepositoryInterface;
use App\Interfaces\SubCategoryRepositoryInterface;
use App\Interfaces\ChildCategoryRepositoryInterface;
use App\Interfaces\ProductImageGalleryRepositoryInterface;
use App\Interfaces\ProductRepositoryInterface;
use App\Interfaces\ProductVariantRepositoryInterface;
use Illuminate\Http\Request;
use App\Traits\ImageUploadTrait;
use Illuminate\Support\Facades\Auth;
use Str;
class ProductController extends Controller
{

    use ImageUploadTrait;

    /**
     * Display a listing of the resource.
     */
    public function index(ProductDataTable $datatable)
    {
        return $datatable->render('admin.product.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = app(CategoryRepositoryInterface::class)->getAll();
        $brands = app(BrandRepositoryInterface::class)->getAll();
        return view('admin.product.create' , compact(
            'categories', 'brands',
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {

       // dd($request->all());
        $path = $this->uploadImage($request, 'thumb_image', 'uploads/products');
        $slug = Str::slug($request->name);
        $vendor = Auth::user()->vendor->id;
        $is_approved = 1;
        app(ProductRepositoryInterface::class)->create(array_merge($request->validated(),['slug'=>$slug],['thumb_image'=>$path], ['vendor_id'=>$vendor] , ['is_approved'=>$is_approved]));

        toastr()->success('Product Added Successfully!');
        return redirect()->route('admin.products.index');
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
        $brands = app(BrandRepositoryInterface::class)->getAll();
        $categories = app(CategoryRepositoryInterface::class)->getAll();
        $subCategories = app(SubCategoryRepositoryInterface::class)->getSubCategoryByCategoryId($product->category_id);
        $childCategories = app(ChildCategoryRepositoryInterface::class)->getChildCategoryBySubCategoryId($product->sub_category_id);
        return view('admin.product.edit' , compact('product' , 'brands' , 'categories' , 'subCategories' , 'childCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductUpdateRequest $request, string $id)
    {
        $product = app(ProductRepositoryInterface::class)->getById($id);
        $path = $this->updateImage($request, 'thumb_image', 'uploads/products', $product->thumb_image);

        app(ProductRepositoryInterface::class)->update(array_merge($request->validated(),['thumb_image'=>empty(!$path)? $path: $product->thumb_image] ), $id);

        toastr()->success('Product Update Successfully!');
        return redirect()->route('admin.products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = app(ProductRepositoryInterface::class)->getById($id);
        $this->deleteImage($product->thumb_image);

        $galleryImages = app(ProductImageGalleryRepositoryInterface::class)->getAllGaleryByProductId($id);

        foreach($galleryImages as $image){
            $this->deleteImage($image->image);
        }

        $variants = app(ProductVariantRepositoryInterface::class)->getProductVariantsByProduct($id);

        foreach($variants as $variant){
            $variant->productVariantItems()->delete();
            $variant->delete();
        }

        app(ProductRepositoryInterface::class)->delete($id);

        return response(["status" => "success" , "message" =>
        "Product deleted successfully!"]);

    }

    /**
     * Update status of products.
     */

     public function updateStatus(Request $request)
     {
         $request->status=='false' ? $status = 0 : $status = 1;

         $data = ['status'=> $status];
         app(ProductRepositoryInterface::class)->updateStatus($data ,$request->id);
         return response(['status' =>'success' , 'message' =>"Status updated successfully"]);
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
