<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\SliderDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\SliderRequest;
use App\Interfaces\SliderRepositoryInterface;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;


class SliderController extends Controller
{
    use ImageUploadTrait;

    /**
     * Display a listing of the resource.
     */
    public function index(SliderDataTable $dataTable)
    {
        //return view('admin.slider.index');
        return $dataTable->render('admin.slider.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SliderRequest $request)
    {
       // dd($request->all());
        // if($request->hasFile('banner')){

        //     $image = $request->banner;
        //     $imageName = rand().'_'.$image->getClientOriginalName();
        //     $image->move(public_path('uploads/slider'), $imageName);
        //     $path = "/uploads/slider/".$imageName;
        //     //$user->image = $path;
        // }
        $path = $this->uploadImage($request, 'banner', 'uploads/slider');

        app(SliderRepositoryInterface::class)->create(array_merge($request->validated(), ['banner' => $path]));

        toastr()->success('Slider Added Successfully!');
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
        //
    }
}
