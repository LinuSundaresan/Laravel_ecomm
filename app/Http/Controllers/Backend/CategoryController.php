<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\CategoryDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Interfaces\CategoryRepositoryInterface;
use Illuminate\Http\Request;
use Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CategoryDataTable $dataTable)
    {
        return $dataTable->render('admin.category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $slug = Str::slug($request->name);
        app(CategoryRepositoryInterface::class)->create($request->validated()+['slug'=>$slug]);
        toastr()->success('Category Added Successfully!');
        return redirect()->route('admin.category.index');
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
        $category = app(CategoryRepositoryInterface::class)->getById($id);
        return view('admin.category.edit' , compact(
            'category'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryUpdateRequest $request, string $id)
    {
        $data = $request->validated();
        app(CategoryRepositoryInterface::class)->update($data , $id);

        toastr()->success('Category Updated Successfully!');
        return redirect()->route('admin.category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        app(CategoryRepositoryInterface::class)->delete($id);
        return response(['status' =>'success' , 'message' =>"Category deleted successfully"]);
    }
}
