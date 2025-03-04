<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\SubCategoryDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\SubCategoryRequest;
use App\Http\Requests\SubCategoryStatusUpdateRequest;
use App\Http\Requests\SubCategoryUpdateRequest;
use App\Interfaces\CategoryRepositoryInterface;
use App\Interfaces\SubCategoryRepositoryInterface;
use Illuminate\Http\Request;
use Str;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SubCategoryDataTable $datatable)
    {
        return $datatable->render('admin.sub-category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = app(CategoryRepositoryInterface::class)->getAll();
        return view('admin.sub-category.create', compact(
            'categories'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SubCategoryRequest $request)
    {
        $slug = Str::slug($request->name);
        app(SubCategoryRepositoryInterface::class)->create($request->validated()+['slug'=>$slug]);
        toastr()->success('Subcategory Added Successfully!');
        return redirect()->route('admin.sub-category.index');

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
        $categories = app(CategoryRepositoryInterface::class)->getAll();
        $subcategory = app(SubCategoryRepositoryInterface::class)->getById($id);

        return view('admin.sub-category.edit' , compact(
            'subcategory' , 'categories'
        ) );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SubCategoryUpdateRequest $request, string $id)
    {
        $data = $request->validated();
        app(SubCategoryRepositoryInterface::class)->update($data , $id);

        toastr()->success('Subcategory Updated Successfully!');
        return redirect()->route('admin.sub-category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        app(SubCategoryRepositoryInterface::class)->delete($id);
        return response(['status' =>'success' , 'message' =>"Sub Category deleted successfully"]);
    }

    /**
     * Update status of subcategories.
     */

     public function updateStatus(SubCategoryStatusUpdateRequest $request)
     {
         $request->status=='false' ? $status = 0 : $status = 1;

         $data = ['status'=> $status];
         app(SubCategoryRepositoryInterface::class)->updateStatus($data ,$request->id);
         return response(['status' =>'success' , 'message' =>"Status updated successfully"]);
     }
}
