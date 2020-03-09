<?php

namespace App\Http\Controllers\Hr\settings;

use App\DataTables\Hr\MainCompanyDataTable;
use App\Models\Hr\HRMainCmpnam;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class MainCompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param MainCompanyDataTable $dataTable
     * @return Response
     */
    public function index(MainCompanyDataTable $dataTable)
    {
        return $dataTable->render('hr.settings.main_company.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $mainCompanies = HRMainCmpnam::all();
        return view('hr.settings.main_company.create', compact('mainCompanies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return void
     * @throws ValidationException
     */
    public function store(Request $request)
    {
       
        $data = $this->validate($request, [
            "Cmp_No" => 'required',
            "Cmp_ShrtNm" => 'required',
            "Cmp_NmAr" => 'required',
            "Cmp_NmAr2" => 'sometimes',
            "Cmp_NmEn" => 'required',
            "Cmp_NmEn2" => 'required',
            "Cmp_Email" => 'required',
            "Cmp_AddAr" => 'required',
            "Cmp_AddEn" => 'required',
            "Cmp_Tel" => 'required|integer',
            "Cmp_Fax" => 'required|integer',
            "Start_Month" => 'required',
            "Start_Year" => 'required',
            "End_Month" => 'required',
            "End_year" => 'required',
            "Start_MonthHij" => 'required',
            "Start_YearHij" => 'required',
            "End_MonthHij" => 'required',
            "End_yearHij" => 'required',
            "HldIssue_Depend" => 'sometimes',
            "Hldestm_Depend" => 'sometimes',
            "NofDay_SalryMnth" => 'sometimes',
            "NofDay_PationHldy" => 'sometimes',
            "Emp_App" => 'sometimes',
            "Nation_Effect" => 'sometimes',
            "Dep_Budge" => 'sometimes',
            "Job_Under" => 'sometimes',
            "Allw_RenewResidnc" => 'sometimes',
            "NofDys_RenewResidnc" =>'sometimes',
            "AllCmp_RenewResidnc" => 'sometimes',
            "CmpNo_RenewResidnc" => 'sometimes',
            "Allw_RenewPassport" => 'sometimes',
            "NofDys_RenewPassport" =>'sometimes',
            "AllCmp_RenewPassport" => 'sometimes',
            "CmpNo_RenewPassport" => 'sometimes',
            "Allw_RenewDrivLicns" => 'sometimes',
            "NofDys_RenewDrivLicns" =>'sometimes',
            "AllCmp_RenewDrivLicns" => 'sometimes',
            "CmpNo_RenewDrivLicns" => 'sometimes',
            "Allw_ReneWorkPermit" => 'sometimes',
            "NofDys_ReneWorkPermit" =>'sometimes',
            "AllCmp_ReneWorkPermit" => 'sometimes',
            "CmpNo_ReneWorkPermit" => 'sometimes',
            "Allw_RenewCarlicense" => 'sometimes',
            "NofDys_RenewCarlicense" =>'sometimes',
            "AllCmp_RenewCarlicense" => 'sometimes',
            "CmpNo_RenewCarlicense" => 'sometimes',
            "Allw_RenewCarInsurance" => 'sometimes',
            "NofDys_RenewCarInsurance" =>'sometimes',
            "AllCmp_RenewCarInsurance" => 'sometimes',
            "CmpNo_RenewCarInsurance" => 'sometimes',
            "Picture" => 'sometimes|image',

            "CR_No" => 'sometimes',
            "CC_No" => 'sometimes',
            "License_No" => 'sometimes',
            "Tax_No" => 'sometimes',
            "TaxExtra_Prct" => 'sometimes',

        ], [
            "integer" => ':attribute '.trans('hr.must_number'),
            "image" => ':attribute '.trans('hr.must_image'),
        ], [
            "Cmp_No" => trans('hr.com_no'),
            "Cmp_ShrtNm" => trans('hr.com_shortcut_name'),
            "Cmp_NmAr" => trans('hr.com_name_ar'),
            "Cmp_NmAr2" => trans('hr.com_second_name_ar'),
            "Cmp_NmEn" => trans('hr.com_name_en'),
            "Cmp_NmEn2" => trans('hr.com_second_name_en'),
            "Cmp_Email" => trans('hr.email'),
            "Cmp_AddAr" => trans('hr.com_address_ar'),
            "Cmp_AddEn" => trans('hr.com_address_en'),
            "Cmp_Tel" => trans('hr.com_phone'),
            "Cmp_Fax" => trans('hr.com_fax'),
            "Start_Month" => trans('hr.month_start'),
            "Start_Year" => trans('hr.year_start'),
            "End_Month" => trans('hr.month_end'),
            "End_year" => trans('hr.year_end'),
            "Start_MonthHij" => trans('hr.month_start_ar'),
            "Start_YearHij" => trans('hr.year_start_ar'),
            "End_MonthHij" => trans('hr.month_end_ar'),
            "End_yearHij" => trans('hr.year_end_ar'),
//            "HldIssue_Depend" => trans('hr.date_of_hiring'),
//            "Hldestm_Depend" => trans('hr.depending_on_vacation_chart'),
//            "NofDay_SalryMnth" => trans('hr.number_of_days_for_salary'),
//            "NofDay_PationHldy" => trans('hr.number_of_days_for_patient'),
//            "Emp_App" => trans('hr.depending_on_emp_steps_app'),
//            "Nation_Effect" => trans('hr.com_no'),
//            "Dep_Budge" => trans('hr.com_no'),
//            "Job_Under" => trans('hr.com_no'),
//            "Allw_RenewResidnc" => trans('hr.com_no'),
//            "NofDys_RenewResidnc" =>trans('hr.com_no'),
//            "AllCmp_RenewResidnc" => trans('hr.com_no'),
//            "CmpNo_RenewResidnc" => trans('hr.com_no'),
//            "Allw_RenewPassport" => trans('hr.com_no'),
//            "NofDys_RenewPassport" =>trans('hr.com_no'),
//            "AllCmp_RenewPassport" => trans('hr.com_no'),
//            "CmpNo_RenewPassport" => trans('hr.com_no'),
//            "Allw_RenewDrivLicns" => trans('hr.com_no'),
//            "NofDys_RenewDrivLicns" =>trans('hr.com_no'),
//            "AllCmp_RenewDrivLicns" => trans('hr.com_no'),
//            "CmpNo_RenewDrivLicns" => trans('hr.com_no'),
//            "Allw_ReneWorkPermit" => trans('hr.com_no'),
//            "NofDys_ReneWorkPermit" =>trans('hr.com_no'),
//            "AllCmp_ReneWorkPermit" => trans('hr.com_no'),
//            "CmpNo_ReneWorkPermit" => trans('hr.com_no'),
//            "Allw_RenewCarlicense" => trans('hr.com_no'),
//            "NofDys_RenewCarlicense" =>trans('hr.com_no'),
//            "AllCmp_RenewCarlicense" => trans('hr.com_no'),
//            "CmpNo_RenewCarlicense" => trans('hr.com_no'),
//            "Allw_RenewCarInsurance" => trans('hr.com_no'),
//            "NofDys_RenewCarInsurance" =>trans('hr.com_no'),
//            "AllCmp_RenewCarInsurance" => trans('hr.com_no'),
//            "CmpNo_RenewCarInsurance" => trans('hr.com_no'),
            "Picture" => trans('hr.com_logo'),

//            "CR_No" => "trans('hr.com_no')",
//            "CC_No" => "trans('hr.com_no')",
//            "License_No" => "trans('hr.com_no')",
//            "Tax_No" => "trans('hr.com_no')",
//            "TaxExtra_Prct" => "trans('hr.com_no')",
        ]);

        $data['Picture'] = \Up::upload([
            'request' => 'Picture',
            'path'=>'hr/main_company',
            'upload_type' => 'single'
        ]);
        
       
        HRMainCmpnam::create($data);

        return redirect()->route('mainCompany.index')->with(session()->flash('message',trans('hr.add_success')));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($ID_NO)
    {
        $allCompanies = HRMainCmpnam::all();
        $mainCompanies = HRMainCmpnam::findOrFail($ID_NO);
        // dd($mainCompany->ID_NO);
        return view('hr.settings.main_company.show', compact(['mainCompanies','allCompanies']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($ID_NO)
    {
        $allCompanies = HRMainCmpnam::all();
        $mainCompanies = HRMainCmpnam::findOrFail($ID_NO);
        // dd($mainCompany->ID_NO);
        return view('hr.settings.main_company.edit', compact(['mainCompanies','allCompanies']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $ID_NO)
    {
        
        $mainCompanies = HRMainCmpnam::findOrFail($ID_NO);
        $data = $this->validate($request, [
           
            "Cmp_ShrtNm" => 'required',
            "Cmp_NmAr" => 'required',
            "Cmp_NmAr2" => 'sometimes',
            "Cmp_NmEn" => 'required',
            "Cmp_NmEn2" => 'required',
            "Cmp_Email" => 'required',
            "Cmp_AddAr" => 'required',
            "Cmp_AddEn" => 'required',
            "Cmp_Tel" => 'required|integer',
            "Cmp_Fax" => 'required|integer',
            "Start_Month" => 'required',
            "Start_Year" => 'required',
            "End_Month" => 'required',
            "End_year" => 'required',
            "Start_MonthHij" => 'required',
            "Start_YearHij" => 'required',
            "End_MonthHij" => 'required',
            "End_yearHij" => 'required',
            "HldIssue_Depend" => 'sometimes',
            "Hldestm_Depend" => 'sometimes',
            "NofDay_SalryMnth" => 'sometimes',
            "NofDay_PationHldy" => 'sometimes',
            "Emp_App" => 'sometimes',
            "Nation_Effect" => 'sometimes',
            "Dep_Budge" => 'sometimes',
            "Job_Under" => 'sometimes',
            "Allw_RenewResidnc" => 'sometimes',
            "NofDys_RenewResidnc" =>'sometimes',
            "AllCmp_RenewResidnc" => 'sometimes',
            "CmpNo_RenewResidnc" => 'sometimes',
            "Allw_RenewPassport" => 'sometimes',
            "NofDys_RenewPassport" =>'sometimes',
            "AllCmp_RenewPassport" => 'sometimes',
            "CmpNo_RenewPassport" => 'sometimes',
            "Allw_RenewDrivLicns" => 'sometimes',
            "NofDys_RenewDrivLicns" =>'sometimes',
            "AllCmp_RenewDrivLicns" => 'sometimes',
            "CmpNo_RenewDrivLicns" => 'sometimes',
            "Allw_ReneWorkPermit" => 'sometimes',
            "NofDys_ReneWorkPermit" =>'sometimes',
            "AllCmp_ReneWorkPermit" => 'sometimes',
            "CmpNo_ReneWorkPermit" => 'sometimes',
            "Allw_RenewCarlicense" => 'sometimes',
            "NofDys_RenewCarlicense" =>'sometimes',
            "AllCmp_RenewCarlicense" => 'sometimes',
            "CmpNo_RenewCarlicense" => 'sometimes',
            "Allw_RenewCarInsurance" => 'sometimes',
            "NofDys_RenewCarInsurance" =>'sometimes',
            "AllCmp_RenewCarInsurance" => 'sometimes',
            "CmpNo_RenewCarInsurance" => 'sometimes',
            "Picture" => 'sometimes',

            "CR_No" => 'sometimes',
            "CC_No" => 'sometimes',
            "License_No" => 'sometimes',
            "Tax_No" => 'sometimes',
            "TaxExtra_Prct" => 'sometimes',

        ], [
            "integer" => ':attribute '.trans('hr.must_number'),
        ],[
            "Cmp_ShrtNm" => trans('hr.com_shortcut_name'),
            "Cmp_NmAr" => trans('hr.com_name_ar'),
            "Cmp_NmAr2" => trans('hr.com_second_name_ar'),
            "Cmp_NmEn" => trans('hr.com_name_en'),
            "Cmp_NmEn2" => trans('hr.com_second_name_en'),
            "Cmp_Email" => trans('hr.email'),
            "Cmp_AddAr" => trans('hr.com_address_ar'),
            "Cmp_AddEn" => trans('hr.com_address_en'),
            "Cmp_Tel" => trans('hr.com_phone'),
            "Cmp_Fax" => trans('hr.com_fax'),
            "Start_Month" => trans('hr.month_start'),
            "Start_Year" => trans('hr.year_start'),
            "End_Month" => trans('hr.month_end'),
            "End_year" => trans('hr.year_end'),
            "Start_MonthHij" => trans('hr.month_start_ar'),
            "Start_YearHij" => trans('hr.year_start_ar'),
            "End_MonthHij" => trans('hr.month_end_ar'),
            "End_yearHij" => trans('hr.year_end_ar'),
        ]);

        $data['Picture'] = \Up::upload([
            'request' => 'Picture',
            'path'=>'hr/main_company',
            'upload_type' => 'single',
            'delete_file' => $mainCompanies->Picture,
        ]);

        $checkboxarr = [
            'Hldestm_Depend',

            'Emp_App',
            'Nation_Effect',
            'Dep_Budge',
            'Job_Under',

            'Allw_RenewResidnc',
            'Allw_RenewPassport',
            'Allw_RenewDrivLicns',
            'Allw_ReneWorkPermit',

            'AllCmp_RenewResidnc',
            'AllCmp_RenewPassport',
            'AllCmp_RenewDrivLicns',
            'AllCmp_ReneWorkPermit',

            'Allw_RenewCarlicense',
            'Allw_RenewCarInsurance',

            'AllCmp_RenewCarlicense',
            'AllCmp_RenewCarInsurance',
        ];
        
        $mainCompanies->update($data);

        
        foreach($checkboxarr as $checkval){


            if(!array_key_exists($checkval, $data)){
                $mainCompanies->{$checkval} = '0';
                $mainCompanies->save();
            }
        }

        return redirect()->route('mainCompany.index')->with(session()->flash('message',trans('hr.update_success')));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($ID_NO)
    {
        $mainCompanies = HRMainCmpnam::findOrFail($ID_NO);
        $mainCompanies->delete();
        return  redirect()->route('mainCompany.index')->with(session()->flash('message', trans('admin.delete_success')));
    }
}
