<?php

namespace App\Http\Controllers\Admin\report;


use App\Branches;
use App\drivers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class ReportDriverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Branches $branches)
    {
        if (auth()->guard('admin')->user()->branches_id == $branches->first()->id) {
            $drivers = drivers::all();
        }else{
            $drivers = auth()->guard('admin')->user()->branches->drivers;
        }
        return view('admin.reports.drivers.report',compact('drivers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if($request->ajax()){
            if($request->from){
                $from = $request->from;
                $to = $request->to;

                $driver = drivers::find($request->driver);
                $transportcount = DB::table('transport')->where('driver_id',$request->driver)->whereBetween('date', [$from,$to])->count();
                $hasTask = DB::table('transport')->where('driver_id',$request->driver)->whereBetween('date', [$from,$to])->exists();
                $transports = DB::table('transport')->where('driver_id',$request->driver)->whereBetween('date', [$from,$to])->get();
                $contents = view('admin.reports.drivers.select', ['transports'=>$transports,'transportcount'=>$transportcount,'hasTask'=>$hasTask,'driver'=>$driver])->render();
                return $contents;


            }
        }
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
            if($request->driver){
                $driver = drivers::findOrFail($request->driver);
                $contents = view('admin.reports.drivers.show', ['driver'=>$driver])->render();
                // do some other manipulation?
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
    public function pdf($id) {
        $driver = drivers::where('id',$id)->first();
        $pdf = PDF::loadView('admin.reports.drivers.pdf.report', ['driver'=>$driver]);
        return $pdf->stream();
    }
}
