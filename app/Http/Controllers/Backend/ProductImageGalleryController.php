<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ProductImageGalleryDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductImageGalleryRequest;
use App\Interfaces\ProductImageGalleryRepositoryInterface;
use App\Interfaces\ProductRepositoryInterface;
use Illuminate\Http\Request;
use App\Traits\ImageUploadTrait;

class ProductImageGalleryController extends Controller
{

    use ImageUploadTrait;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, ProductImageGalleryDataTable $datatable)
    {
        $product = app(ProductRepositoryInterface::class)->getById($request->product);
        return $datatable->render('admin.product.image-gallery.index', compact('product'));
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
    public function store(ProductImageGalleryRequest $request)
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
        $this->deleteImage($productGallery->image);
        app(ProductImageGalleryRepositoryInterface::class)->delete($id);
        return response(['status' =>'success' , 'message' =>"Product Image deleted successfully"]);
    }
}
