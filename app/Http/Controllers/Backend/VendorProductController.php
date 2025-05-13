<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\VendorProductDataTable;
use App\Http\Controllers\Controller;
use App\Interfaces\BrandRepositoryInterface;
use App\Interfaces\CategoryRepositoryInterface;
use App\Interfaces\ChildCategoryRepositoryInterface;
use App\Interfaces\SubCategoryRepositoryInterface;
use Illuminate\Http\Request;

class VendorProductController extends Controller
{
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
    public function store(Request $request)
    {
        //
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
