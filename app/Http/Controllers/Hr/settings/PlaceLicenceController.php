<?php

namespace App\Http\Controllers\Hr\settings;

use App\DataTables\Hr\PlaceLicenceDataTable;
use App\Models\Hr\HrAstPlcLicns;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PlaceLicenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param PlaceLicenceDataTable $dataTable
     * @return void
     */
    public function index(PlaceLicenceDataTable $dataTable)
    {
        return $dataTable->render('hr.settings.place_licence.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return  view('hr.settings.place_licence.create');
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
            "State_No" => 'required',
            "State_NmAr" => 'required',
            "State_NmEn" => 'sometimes',
            'cty_client'  => 'sometimes', // عملاء
            'cty_resident'  => 'sometimes', // اقامة
            'cty_drivlic'  => 'sometimes', // رخصة القيادة
            'cty_jobactv'  => 'sometimes',  // رخصة مزاولة المهنة
            'cty_Nat_id'  => 'sometimes',  // الهوية الوطنية
            'cty_address'  => 'sometimes',  // العنوان
            'cty_actv'  => 'sometimes',  // فعال او لا

        ], [], [
            "State_No" => trans('hr.com_no'),
            "State_NmAr" => trans('hr.place_licence_name_ar'),
            "State_NmEn" => trans('hr.place_licence_name_en'),
        ]);
        // dd($data);

        HrAstPlcLicns::create($data);

        return redirect()->route('placeLicence.index')->with(session()->flash('message',trans('hr.add_success')));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($ID_NO)
    {
        $HrAstPlcLicns = HrAstPlcLicns::findOrFail($ID_NO);
        return  view('hr.settings.place_licence.show', compact(['HrAstPlcLicns']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($ID_NO)
    {
        $HrAstPlcLicns = HrAstPlcLicns::findOrFail($ID_NO);
        return  view('hr.settings.place_licence.edit', compact(['HrAstPlcLicns']));
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
        $HrAstPlcLicns = HrAstPlcLicns::findOrFail($ID_NO);
        $data = $this->validate($request, [
            "State_NmAr" => 'required',
            "State_NmEn" => 'sometimes',
            'cty_client'  => 'sometimes', // عملاء
            'cty_resident'  => 'sometimes', // اقامة
            'cty_drivlic'  => 'sometimes', // رخصة القيادة
            'cty_jobactv'  => 'sometimes',  // رخصة مزاولة المهنة
            'cty_Nat_id'  => 'sometimes',  // الهوية الوطنية
            'cty_address'  => 'sometimes',  // العنوان
            'cty_actv'  => 'sometimes',  // فعال او لا

        ], [], [
            "State_NmAr" => trans('hr.place_licence_name_ar'),
            "State_NmEn" => trans('hr.place_licence_name_en'),
        ]);

        $checkboxarr = [
            'cty_client' ,  // عملاء
            'cty_resident',   // اقامة
            'cty_drivlic' ,  // رخصة القيادة
            'cty_jobactv' ,  // رخصة مزاولة المهنة
            'cty_Nat_id' ,  // الهوية الوطنية
            'cty_address' ,   // العنوان
            'cty_actv'  ,  // فعال او لا
        ];
        foreach($checkboxarr as $checkval){
            if(!array_key_exists($checkval, $data)){
                $HrAstPlcLicns->{$checkval} = '0';
                $HrAstPlcLicns->save();
            }
        }
        $HrAstPlcLicns->update($data);
        return redirect()->route('placeLicence.index')->with(session()->flash('message',trans('hr.update_success')));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($ID_NO)
    {
        $HrAstPlcLicns = HrAstPlcLicns::findOrFail($ID_NO);
        $HrAstPlcLicns->delete();
        return redirect()->route('placeLicence.index')->with(session()->flash('message', trans('hr.delete_success')));
    }
}
