<?php

namespace App\Http\Controllers\Hr\settings;

use App\DataTables\Hr\CompanyLicenceProvidersDataTable;
use App\Models\Hr\HrAstCmpLicIsu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CompanyLicenceProvidersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param CompanyLicenceProvidersDataTable $dataTable
     * @return void
     */
    public function index(CompanyLicenceProvidersDataTable $dataTable)
    {
        return $dataTable->render('hr.settings.company_licence_providers.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('hr.settings.company_licence_providers.create');
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
            "CmpLicisu_No" => 'required',
            "CmpLicisu_NmAr" => 'required',
            "CmpLicisu_NmEn" => 'sometimes',

        ], [], [
            "CmpLicisu_No" => trans('hr.com_license_providers_number'),
            "CmpLicisu_NmAr" => trans('hr.com_license_providers_name_ar'),
            "CmpLicisu_NmEn" => trans('hr.com_license_providers_name_en'),
        ]);
        HrAstCmpLicIsu::create($data);
        return redirect()->route('companyLicenceProviders.index')->with(session()->flash('message',trans('hr.add_success')));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($ID_NO)
    {
        $HrAstCmpLicIsu = HrAstCmpLicIsu::findOrFail($ID_NO);
        return view('hr.settings.company_licence_providers.show', compact(['HrAstCmpLicIsu']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($ID_NO)
    {
        $HrAstCmpLicIsu = HrAstCmpLicIsu::findOrFail($ID_NO);
        return view('hr.settings.company_licence_providers.edit', compact(['HrAstCmpLicIsu']));
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
        $HrAstCmpLicIsu = HrAstCmpLicIsu::findOrFail($ID_NO);
        $data = $this->validate($request, [
            
            "CmpLicisu_NmAr" => 'required',
            "CmpLicisu_NmEn" => 'sometimes',

        ], [], [
            
            "CmpLicisu_NmAr" => trans('hr.com_license_providers_name_ar'),
            "CmpLicisu_NmEn" => trans('hr.com_license_providers_name_en'),
        ]);
        $HrAstCmpLicIsu->update($data);
        return redirect()->route('companyLicenceProviders.index')->with(session()->flash('message',trans('hr.update_success')));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($ID_NO)
    {
        $HrAstCmpLicIsu = HrAstCmpLicIsu::findOrFail($ID_NO);
        $HrAstCmpLicIsu->delete();
        return redirect()->route('companyLicenceProviders.index')->with(session()->flash('message',trans('hr.delete_success')));
    }
}
