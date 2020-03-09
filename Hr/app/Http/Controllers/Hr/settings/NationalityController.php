<?php

namespace App\Http\Controllers\Hr\settings;
use App\DataTables\Hr\NationalityDataTable;
use App\Models\Hr\HrAstEmpCntry;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class NationalityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param HouseTypeClassDataTable $dataTable
     * @return Response
     */
    public function index(NationalityDataTable $dataTable)
    {
        return $dataTable->render('hr.settings.nationality.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return  view('hr.settings.nationality.create');
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
            "Cntry_No" => 'required',
            "Cntry_NmAr" => 'required',
            "Cntry_NmEn" => 'sometimes',

        ], [], [
            "Cntry_No" => trans('hr.nationality_number'),
            "Cntry_NmAr" => trans('hr.nationality_name_ar'),
            "Cntry_NmEn" => trans('hr.nationality_name_ar'),
        ]);


        HrAstEmpCntry::create($data);

        return redirect()->route('nationality.index')->with(session()->flash('message',trans('hr.add_success')));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($ID_NO)
    {
        $nationality = HrAstEmpCntry::findOrFail($ID_NO);
        return  view('hr.settings.nationality.show', compact(['nationality']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($ID_NO)
    {
        $nationality = HrAstEmpCntry::findOrFail($ID_NO);
        return  view('hr.settings.nationality.edit', compact(['nationality']));
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
        $nationality = HrAstEmpCntry::findOrFail($ID_NO);
        $data = $this->validate($request, [
           
            "Cntry_NmAr" => 'required',
            "Cntry_NmEn" => 'sometimes',
        ], [], [
            "Cntry_NmAr" => trans('hr.nationality_name_ar'),
            "Cntry_NmEn" => trans('hr.nationality_name_ar'),
        ]);

        $nationality->update($data);
        
        return redirect()->route('nationality.index')->with(session()->flash('message',trans('hr.update_success')));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($ID_NO)
    {
        $nationality = HrAstEmpCntry::findOrFail($ID_NO);
        $nationality->delete();
        return redirect()->route('nationality.index')->with(session()->flash('message',trans('hr.delete_success')));
    }
}
