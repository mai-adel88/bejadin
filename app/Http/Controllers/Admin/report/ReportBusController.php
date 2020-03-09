<?php

namespace App\Http\Controllers\Admin\report;

use App\book;
use App\Branches;
use App\bus;
use App\Http\Controllers\Controller;
use App\schedule;
use App\transport;
use Illuminate\Http\Request;

class ReportBusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Branches $branches)
    {
        if (auth()->guard('admin')->user()->branches_id == $branches->first()->id) {
            $buses = bus::all();
        }else{
            $buses = auth()->guard('admin')->user()->branches->buses;
        }
        $schedules = schedule::all();
        return view('admin.reports.buses.report',compact('buses','schedules'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,Request $request)
    {
        if($request->ajax()){
            $buses = $request->bus;
            $date = $request->date;
            $schedules = $request->schedules;
            if($buses && $date && $schedules){
                $bus = bus::findOrFail($buses);
                $transport = transport::where('bus_id',$buses)->where('schedule_id',$schedules)->where('date',$date)->first();
                if ($transport != null){
                    $books = book::where('date',$date)->where('transport_id',$transport->id)->get();
                    $driver = $transport->driver_id;
                }else{
                    return '<div style="padding: 0 10px"> <div class="alert alert-danger">'.trans('admin.theres_no_travel_in_this_day').'</div></div>';
                }
                $contents = view('admin.reports.buses.show', ['bus'=>$bus,'driver'=>$driver,'books'=>$books])->render();
                return $contents;
            }
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
