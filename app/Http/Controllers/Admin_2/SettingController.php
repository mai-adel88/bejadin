<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Up;
class SettingController extends Controller
{
    public function index()
    {
        return view('admin.setting');
    }


    public function setting_save(Request $request){
        $data = $this->validate($request,[
            'logo' => validate_image(),
            'icon' => validate_image(),
            'sitename_en' => 'required',
            'sitename_ar' => 'required',
            'email' => 'sometimes',
            'main_lang' => 'required',
            'currancy' => 'required',
            'description' => 'sometimes|max:1000',
            'description_ar' => 'sometimes|max:1000',
            'contact_description' => 'sometimes|max:1000',
            'contact_description_ar' => 'sometimes|max:1000',
            'keyword' => 'sometimes|max:1000',
            'status' => 'required',
            'message_maintenance' => 'sometimes|max:1000',
            'addriss' => 'sometimes',
            'phone' => 'sometimes',
            'facebook' => 'sometimes',
            'twitter' => 'sometimes',
            'googel' => 'sometimes',
            'linkedin' => 'sometimes',
        ],[],[
            'logo' => trans('admin.image'),
            'icon' => trans('admin.icon'),
            'sitename_en' => trans('admin.arabic_name'),
            'sitename_ar' => trans('admin.english_name'),
            'email' => trans('admin.email'),
            'main_lang' => trans('admin.main_lang'),
            'currancy' => trans('admin.currency'),
            'description' => trans('admin.description'),
            'contact_description' => trans('admin.contact_description'),
            'contact_description_ar' => trans('admin.contact_description'),
            'keyword' => trans('admin.keyword'),
            'status' => trans('admin.status'),
            'message_maintenance' => trans('admin.message_Maintenance'),
            'addriss' => trans('admin.addriss'),
            'phone' => trans('admin.phone'),
            'facebook' => trans('admin.facebook'),
            'twitter' => trans('admin.twitter'),
            'googel' => trans('admin.googel'),
            'linkedin' => trans('admin.linkedin'),
        ]);

        if($request->hasFile('logo')){
            $data['logo'] = Up::upload([
                'request' => 'logo',
                'path'=>'setting',
                'upload_type' => 'single',
                'delete_file'=> setting()->logo
            ]);
        }
        if($request->hasFile('icon')){
            $data['icon'] = Up::upload([
                'request' => 'icon',
                'path'=>'setting',
                'upload_type' => 'single',
                'delete_file'=> setting()->icon
            ]);
        }
        $data['currancy'] = $request->currancy;
        Setting::orderBy('id','desc')->update($data);
        return redirect(aurl('setting'))->with('message',trans('admin.success_update'));
    }
}
