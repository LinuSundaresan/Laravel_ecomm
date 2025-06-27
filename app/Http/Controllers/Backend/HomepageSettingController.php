<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Interfaces\CategoryRepositoryInterface;
use App\Interfaces\HomepageSettingRepositoryInterface;
use Illuminate\Http\Request;

class HomepageSettingController extends Controller
{
    public function index()
    {
        $categories = app(CategoryRepositoryInterface::class)->getAll();
        $popularCategories = app(HomepageSettingRepositoryInterface::class)->getPopularCategories();
        return view('admin.home-page-setting.index', compact(
            'categories',
            'popularCategories'
        ));
    }

    public function updatePopularCategorySection(Request $request)
    {
        $data = [
            [
                'category' =>  $request->cat_one,
                'sub_category'  => $request->sub_cat_one,
                'child_category'=> $request->child_cat_one
            ],
            [
                'category' =>  $request->cat_two,
                'sub_category'  => $request->sub_cat_two,
                'child_category'=> $request->child_cat_two
            ],
            [
                'category' =>  $request->cat_three,
                'sub_category'  => $request->sub_cat_three,
                'child_category'=> $request->child_cat_three
            ],
            [
                'category' =>  $request->cat_four,
                'sub_category'  => $request->sub_cat_four,
                'child_category'=> $request->child_cat_four
            ],

        ];

        app(HomepageSettingRepositoryInterface::class)->updatePopularCategories($data);

        toastr('Updated succesfully', 'success');
        return redirect()->back();
    }
}
