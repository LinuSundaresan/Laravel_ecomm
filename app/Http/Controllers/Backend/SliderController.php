<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\SliderDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\SliderRequest;
use App\Http\Requests\SliderUpdateRequest;
use App\Interfaces\SliderRepositoryInterface;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use App\Models\Slider;

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
        $slider = Slider::findOrFail($id);
        return view('admin.slider.edit' , compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SliderUpdateRequest $request, string $id)
    {
        $data = $request->validated();
        $path = $this->updateImage($request, 'banner', 'uploads/slider');
        if($path){
            $data = array_merge($data, ['banner' => $path]);
        }

        app(SliderRepositoryInterface::class)->update($data , $id);

        toastr()->success('Slider Updated Successfully!');
        return redirect()->route('admin.slider.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $imagePath = app(SliderRepositoryInterface::class)->getById($id)->banner;
        $this->deleteImage($imagePath);
        app(SliderRepositoryInterface::class)->delete($id);
        return response(['status' =>'success' , 'message' =>"Slider deleted successfully"]);
    }
}
