<?php

namespace App\Http\Controllers\Hr\settings;

use App\DataTables\Hr\HouseTypeClassDataTable;
use App\Models\Hr\HrPyhousTyp;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class HouseTypeClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param HouseTypeClassDataTable $dataTable
     * @return Response
     */
    public function index(HouseTypeClassDataTable $dataTable)
    {
        return $dataTable->render('hr.settings.house_type_class.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return  view('hr.settings.house_type_class.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $data = $this->validate($request, [
            "HusTyp_No" => 'required',
            "HusTyp_NmAr" => 'required',
            "HusTyp_NmEn" => 'sometimes',

        ], [], [
            "HusTyp_No" => trans('hr.house_number'),
            "HusTyp_NmAr" => trans('hr.house_name_ar'),
            "HusTyp_NmEn" => trans('hr.house_name_ar'),
        ]);

        HrPyhousTyp::create($data);
        return redirect()->route('houseTypeClass.index')->with(session()->flash('message',trans('hr.add_success')));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($ID_NO)
    {
        $HrPyhousTyp = HrPyhousTyp::findOrFail($ID_NO);
        return  view('hr.settings.house_type_class.show',compact(['HrPyhousTyp']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($ID_NO)
    {
        $HrPyhousTyp = HrPyhousTyp::findOrFail($ID_NO);
        return  view('hr.settings.house_type_class.edit',compact(['HrPyhousTyp']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $ID_NO)
    {
        $HrPyhousTyp = HrPyhousTyp::findOrFail($ID_NO);
        $data = $this->validate($request, [
           
            "HusTyp_NmAr" => 'required',
            "HusTyp_NmEn" => 'required',

        ], [], [
            
            "HusTyp_NmAr" => trans('hr.house_name_ar'),
            "HusTyp_NmEn" => trans('hr.house_name_ar'),
        ]);

        $HrPyhousTyp->update($data);
        return redirect()->route('houseTypeClass.index')->with(session()->flash('message',trans('hr.update_success')));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($ID_NO)
    {
        $HrPyhousTyp = HrPyhousTyp::findOrFail($ID_NO);
        $HrPyhousTyp->delete();
        return redirect()->route('houseTypeClass.index')->with(session()->flash('message',trans('hr.delete_success')));
    }
}
