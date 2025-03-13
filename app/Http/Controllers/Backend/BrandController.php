<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\BrandDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\BrandRequest;
use App\Http\Requests\BrandStatusUpdateRequest;
use App\Http\Requests\BrandUpdateRequest;
use App\Interfaces\BrandRepositoryInterface;
use Illuminate\Http\Request;
use App\Traits\ImageUploadTrait;
use Str;

class BrandController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(BrandDataTable $datatable)
    {
        return $datatable->render('admin.brand.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BrandRequest $request)
    {
        $path = $this->uploadImage($request, 'logo', 'uploads/brands');
        $slug = Str::slug($request->name);
        app(BrandRepositoryInterface::class)->create(array_merge($request->validated(), ['logo' => $path , 'slug'=> $slug] ));

        toastr()->success('Brand Created Successfully!');
        return redirect()->route('admin.brand.index');

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
        $brand = app(BrandRepositoryInterface::class)->getById($id);
        return view('admin.brand.edit' , compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BrandUpdateRequest $request, string $id)
    {
        $data = $request->validated();
        $path = $this->updateImage($request, 'logo', 'uploads/brands');
        if($path){
            $data = array_merge($data, ['logo' => $path]);
        }
        app(BrandRepositoryInterface::class)->update($data , $id);

        toastr()->success('Brand Updated Successfully!');
        return redirect()->route('admin.brand.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $logoPath = app(BrandRepositoryInterface::class)->getById($id)->logo;
        $this->deleteImage(asset($logoPath));
        app(BrandRepositoryInterface::class)->delete($id);
        return response(['status' =>'success' , 'message' =>"Brand deleted successfully"]);
     }

    /**
     * Update status of brands.
     */

     public function updateStatus(BrandStatusUpdateRequest $request)
     {
         $request->status=='false' ? $status = 0 : $status = 1;

         $data = ['status'=> $status];
         app(BrandRepositoryInterface::class)->updateStatus($data ,$request->id);
         return response(['status' =>'success' , 'message' =>"Status updated successfully"]);
     }
}
