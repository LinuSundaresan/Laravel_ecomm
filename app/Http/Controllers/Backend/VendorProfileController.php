<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\VendorprofileRequest;
use Illuminate\Support\Facades\Auth;
use App\Interfaces\UserRepositoryInterface;
use File;

class VendorProfileController extends Controller
{
    public function index()
    {
        return view('vendor.dashboard.profile');
    }

    public function updateProfile(VendorprofileRequest $request)
    {
        $user = Auth::user();

        if($request->hasFile('image')){

            if(File::exists(public_path($user->image))){
                File::delete(public_path($user->image));
            }

            $image = $request->image;
            $imageName = rand().'_'.$image->getClientOriginalName();
            $image->move(public_path('uploads'), $imageName);
            $path = "/uploads/".$imageName;
            //$user->image = $path;
        }
        // $user->name = $request->name;
        // $user->email = $request->email;

        app(UserRepositoryInterface::class)->create(array_merge($request->validated(),['image'=>$path]));

        //$user->save();
        toastr()->success('Profile Updated Successfully!');
        return redirect()->back();
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password'=> ['required' , 'current_password'],
            'password'=> ['required' , 'confirmed', 'min:6']
        ]);

        $request->user()->update([
            'password'=> bcrypt($request->password)
        ]);

        toastr()->success('Password Updated Successfully!');
        return redirect()->back();
    }
}
