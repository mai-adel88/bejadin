<?php

namespace App\Http\Controllers\Hr\settings;

use App\DataTables\Hr\EntryAndDeparturePortsDataTable;
use App\Models\Hr\HrAstPorts;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EntryAndDeparturePortsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param EntryAndDeparturePortsDataTable $dataTable
     * @return void
     */
    public function index(EntryAndDeparturePortsDataTable $dataTable)
    {
        return $dataTable->render('hr.settings.entry_departure_ports.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return  view('hr.settings.entry_departure_ports.create');
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
            "Ports_No" => 'required',
            "Ports_NmAr" => 'required',
            "Ports_NmEn" => 'sometimes',

        ], [], [
            "Ports_No" => trans('hr.entry_and_departure_ports_number'),
            "Ports_NmAr" => trans('hr.entry_and_departure_ports_name_ar'),
            "Ports_NmEn" => trans('hr.entry_and_departure_ports_name_en'),
        ]);


        HrAstPorts::create($data);

        return redirect()->route('entryDeparturePorts.index')->with(session()->flash('message',trans('hr.add_success')));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($ID_NO)
    {
        $HrAstPorts = HrAstPorts::findOrFail($ID_NO);   
        return  view('hr.settings.entry_departure_ports.show',compact(['HrAstPorts']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($ID_NO)
    {
        $HrAstPorts = HrAstPorts::findOrFail($ID_NO);   
        return  view('hr.settings.entry_departure_ports.edit',compact(['HrAstPorts']));
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
        $HrAstPorts = HrAstPorts::findOrFail($ID_NO); 
        $data = $this->validate($request, [
           
            "Ports_NmAr" => 'required',
            "Ports_NmEn" => 'required',

        ], [], [
           
            "Ports_NmAr" => trans('hr.entry_and_departure_ports_name_ar'),
            "Ports_NmEn" => trans('hr.entry_and_departure_ports_name_en'),
        ]);


        $HrAstPorts->update($data);

        return redirect()->route('entryDeparturePorts.index')->with(session()->flash('message',trans('hr.update_success')));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($ID_NO)
    {
        $HrAstPorts = HrAstPorts::findOrFail($ID_NO);
        $HrAstPorts->delete();
        return redirect()->route('entryDeparturePorts.index')->with(session()->flash('message',trans('hr.delete_success')));
    }
}
