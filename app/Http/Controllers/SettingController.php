<?php

namespace App\Http\Controllers;

// use App\Setting;
use App\Models\Admin\MainCompany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Up;
class SettingController extends Controller
{
    public function index()
    {
        //create new Brn_No
        $Cmp_No = 0;
        if(count(MainCompany::all()) == 0){
            $Cmp_No = 1;
        }
        else{
            $last_cmp = MainCompany::orderBy('Cmp_No', 'desc')->first();
            if($last_cmp == null){
                $Cmp_No = 1;
            }
            else{
                $Cmp_No = $last_cmp->Cmp_No + 1;
            }
        }

        $company = MainCompany::findOrFail(MainCompany::create([
            'Cmp_NmAr' => '',
        ])->ID_No);

        if (!empty($company)){
            $company->Cmp_No = $Cmp_No;
            $company->save();
            return view('admin.setting', compact('company'));
        }
    }


    public function setting_save(Request $request){
        $data = $this->validate($request,[
            'logo' => validate_image(),
            'icon' => validate_image(),
            'Cmp_NmAr' => 'required',
            'Cmp_NmEn' => 'required',
            'Cmp_Email' => 'sometimes',
            'main_lang' => 'required',
            'currancy' => 'required',
            'description' => 'sometimes|max:1000',
            'description_ar' => 'sometimes|max:1000',
            'contact_description' => 'sometimes|max:1000',
            'contact_description_ar' => 'sometimes|max:1000',
            'keyword' => 'sometimes|max:1000',
            'status' => 'required',
            'message_maintenance' => 'sometimes|max:1000',
            'Cmp_Adrs' => 'required',
            'Cmp_Tel' => 'sometimes',
            'facebook' => 'sometimes',
            'twitter' => 'sometimes',
            'googel' => 'sometimes',
            'linkedin' => 'sometimes',
        ],[],[
            'logo' => trans('admin.image'),
            'icon' => trans('admin.icon'),
            'Cmp_NmEn' => trans('admin.arabic_name'),
            'Cmp_NmAr' => trans('admin.english_name'),
            'Cmp_Email' => trans('admin.email'),
            'main_lang' => trans('admin.main_lang'),
            'currancy' => trans('admin.currency'),
            'description' => trans('admin.description'),
            'contact_description' => trans('admin.contact_description'),
            'contact_description_ar' => trans('admin.contact_description'),
            'keyword' => trans('admin.keyword'),
            'status' => trans('admin.status'),
            'message_maintenance' => trans('admin.message_Maintenance'),
            'Cmp_Adrs' => trans('admin.addriss'),
            'Cmp_Tel' => trans('admin.phone'),
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
        MainCompany::orderBy('ID_No','desc')->update($data);
        return redirect(aurl('setting'))->with('message',trans('admin.success_update'));
    }
}
