<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\GeneralSettingUpdateRequest;
use App\Interfaces\GeneralSettingRepositoryInterface;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        $generalSetting = app(GeneralSettingRepositoryInterface::class)->getGeneralSetting();
        return view('admin.settings.index' , compact(
            'generalSetting'
        ));
    }

    public function generalSettingUpdate(GeneralSettingUpdateRequest $request)
    {
        app(GeneralSettingRepositoryInterface::class)->updateGeneralSetting($request->validated());

        toastr()->success('Settings Updated Successfully!');
        return redirect()->back();
    }
}
