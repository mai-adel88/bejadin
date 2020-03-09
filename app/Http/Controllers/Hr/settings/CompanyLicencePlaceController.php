<?php

namespace App\Http\Controllers\Hr\settings;

use App\DataTables\Hr\CompanyLicencePlaceDataTable;
use App\Models\Hr\HrCmpLicPlc;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class CompanyLicencePlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param CompanyLicencePlaceDataTable $dataTable
     * @return void
     */
    public function index(CompanyLicencePlaceDataTable $dataTable)
    {
        return $dataTable->render('hr.settings.company_licence_place.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('hr.settings.company_licence_place.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $data = $this->validate($request, [
            "CmpLicplc_No" => 'required',
            "CmpLicplc_NmAr" => 'required',
            "CmpLicplc_NmEn" => 'sometimes',
        ], [], [
            "CmpLicplc_No" => trans('hr.company_licence_place_number'),
            "CmpLicplc_NmAr" => trans('hr.company_licence_place_name_ar'),
            "CmpLicplc_NmEn" => trans('hr.company_licence_place_name_ar'),
        ]);
        HrCmpLicPlc::create($data);
        return redirect()->route('companyLicencePlace.index')->with(session()->flash('message',trans('hr.add_success')));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return void
     */
    public function show($ID_NO)
    {
        $HrCmpLicPlc = HrCmpLicPlc::findOrFail($ID_NO);
        return view('hr.settings.company_licence_place.show',compact(['HrCmpLicPlc']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return void
     */
    public function edit($ID_NO)
    {
        $HrCmpLicPlc = HrCmpLicPlc::findOrFail($ID_NO);
        return view('hr.settings.company_licence_place.edit',compact(['HrCmpLicPlc']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return void
     */
    public function update(Request $request, $ID_NO)
    {
        $HrCmpLicPlc = HrCmpLicPlc::findOrFail($ID_NO);
        $data = $this->validate($request, [
            "CmpLicplc_NmAr" => 'required',
            "CmpLicplc_NmEn" => 'sometimes',
            
        ], [], [
            
            "CmpLicplc_NmAr" => trans('hr.company_licence_place_name_ar'),
            "CmpLicplc_NmEn" => trans('hr.company_licence_place_name_ar'),
        ]);
       
        // dd($data);
        $HrCmpLicPlc->update($data);
        return redirect()->route('companyLicencePlace.index')->with(session()->flash('message',trans('hr.update_success')));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($ID_NO)
    {
        $HrCmpLicPlc = HrCmpLicPlc::findOrFail($ID_NO);
        $HrCmpLicPlc->delete();
        return redirect()->route('companyLicencePlace.index')->with(session()->flash('message',trans('hr.delete_success')));
    }
}
