<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ChildCategoryDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\ChildCategoryRequest;
use App\Http\Requests\ChildCategoryStatusUpdateRequest;
use App\Http\Requests\ChildCategoryUpdateRequest;
use App\Interfaces\CategoryRepositoryInterface;
use App\Interfaces\SubCategoryRepositoryInterface;
use App\Interfaces\ChildCategoryRepositoryInterface;
use Illuminate\Http\Request;
use Str;

class ChildCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ChildCategoryDataTable $dataTable)
    {
        return $dataTable->render('admin.child-category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = app(CategoryRepositoryInterface::class)->getAll();
        return view('admin.child-category.create' , compact(
            'categories'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ChildCategoryRequest $request)
    {
        $slug = Str::slug($request->name);
        app(ChildCategoryRepositoryInterface::class)->create($request->validated()+['slug'=>$slug]);
        toastr()->success('Child category Added Successfully!');
        return redirect()->route('admin.child-category.index');
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
        $childCategory = app(ChildCategoryRepositoryInterface::class)->getById($id);
        $subcategories = app(SubCategoryRepositoryInterface::class)->getSubCategoryByCategoryId($childCategory->category_id);
        return view('admin.child-category.edit', compact(
            'categories' , 'childCategory' , 'subcategories'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ChildCategoryUpdateRequest $request, string $id)
    {
        $data = $request->validated();
        app(ChildCategoryRepositoryInterface::class)->update($data , $id);

        toastr()->success('Child category Updated Successfully!');
        return redirect()->route('admin.child-category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        app(ChildCategoryRepositoryInterface::class)->delete($id);
        return response(['status' =>'success' , 'message' =>"Child Category deleted successfully"]);
    }

    public function getSubCategories(Request $request)
    {
         $subCategories = app(SubCategoryRepositoryInterface::class )->getSubCategoryByCategoryId($request->id);
         return $subCategories;
    }

    /**
     * Update status of subcategories.
     */

     public function updateStatus(ChildCategoryStatusUpdateRequest $request)
     {
         $request->status=='false' ? $status = 0 : $status = 1;

         $data = ['status'=> $status];
         app(ChildCategoryRepositoryInterface::class)->updateStatus($data ,$request->id);
         return response(['status' =>'success' , 'message' =>"Status updated successfully"]);
     }
}
