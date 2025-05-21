<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\VendorProductImageGalleryDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\VendorProductImageGalleryRequest;
use App\Interfaces\ProductImageGalleryRepositoryInterface;
use App\Interfaces\ProductRepositoryInterface;

use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorProductImageGalleryController extends Controller
{

    use ImageUploadTrait;


    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, VendorProductImageGalleryDataTable $datatable)
    {
        $product = app(ProductRepositoryInterface::class)->getById($request->product);

        if($product->vendor_id != Auth::user()->vendor->id){
            abort(403, 'You are not authorized to access this product');
        }

        return $datatable->render('vendor.product.image-gallery.index', compact(
            'product'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VendorProductImageGalleryRequest $request)
    {
        $imagePaths = $this->uploadMultipleImage($request, 'image' , 'uploads/products');
        foreach ($imagePaths as $imagePath){
            app(ProductImageGalleryRepositoryInterface::class)->create(array_merge($request->validated(),['image'=>$imagePath]) );
        }
        toastr()->success('Product Gallery Updated Successfully!');
        return redirect()->back();
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
        $productGallery = app(ProductImageGalleryRepositoryInterface::class)->getById($id);

        if($productGallery->product->vendor_id != Auth::user()->vendor->id){
            abort(403, 'You are not authorized to access this product');
        }

        $this->deleteImage($productGallery->image);
        app(ProductImageGalleryRepositoryInterface::class)->delete($id);
        return response(['status' =>'success' , 'message' =>"Product Image deleted successfully"]);
    }
}
