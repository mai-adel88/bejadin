<?php

namespace App\Http\Controllers\Hr\settings;

use App\DataTables\Hr\CompanyLicenceTypeDataTable;
use App\Models\Hr\HrCmpLicType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CompanyLicenceTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param CompanyLicenceProvidersDataTable $dataTable
     * @return void
     */
    public function index(CompanyLicenceTypeDataTable $dataTable)
    {
        return $dataTable->render('hr.settings.company_licence_type.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('hr.settings.company_licence_type.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validate($request, [
            "CmplicTyp_No" => 'required',
            "CmplicTyp_NmAr" => 'required',
            "CmplicTyp_NmEn" => 'sometimes',

        ], [], [
            "CmplicTyp_No" => trans('hr.com_license_types_number'),
            "CmplicTyp_NmAr" => trans('hr.com_license_types_name_ar'),
            "CmplicTyp_NmEn" => trans('hr.com_license_types_name_en'),
        ]);
        HrCmpLicType::create($data);
        return redirect()->route('companyLicenceType.index')->with(session()->flash('message',trans('hr.add_success')));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($ID_NO)
    {
        $HrCmpLicType = HrCmpLicType::findOrFail($ID_NO);
        return view('hr.settings.company_licence_type.show',compact(['HrCmpLicType']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($ID_NO)
    {
        $HrCmpLicType = HrCmpLicType::findOrFail($ID_NO);
        return view('hr.settings.company_licence_type.edit',compact(['HrCmpLicType']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $ID_NO)
    {
        $HrCmpLicType = HrCmpLicType::findOrFail($ID_NO);
        $data = $this->validate($request, [
           
            "CmplicTyp_NmAr" => 'required',
            "CmplicTyp_NmEn" => 'sometimes',

        ], [], [
            
            "CmplicTyp_NmAr" => trans('hr.com_license_types_name_ar'),
            "CmplicTyp_NmEn" => trans('hr.com_license_types_name_en'),
        ]);
        $HrCmpLicType->update($data);
        return redirect()->route('companyLicenceType.index')->with(session()->flash('message',trans('hr.update_success')));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($ID_NO)
    {   
        
        $HrCmpLicType = HrCmpLicType::findOrFail($ID_NO);
        $HrCmpLicType->delete();
        return redirect()->route('companyLicenceType.index')->with(session()->flash('message',trans('hr.delete_success')));
    }
}
