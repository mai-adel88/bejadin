<?php

namespace App\Http\Controllers\Admin\report;

use App\Branches;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportBrancheController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Branches $branches)
    {
        if (auth()->guard('admin')->user()->branches_id == $branches->first()->id) {
            $branches = Branches::all();
        }else{
            $branches = Branches::where('branche_id','=',auth()->guard('admin')->user()->branches_id)->get();
        }
        return view('admin.reports.branches.report',compact('branches'));
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

                $branche = Branches::find($request->branche);
                $transportcount = DB::table('transport')->where('branche_id',$request->branche)->whereBetween('date', [$from,$to])->count();
                $hasTask = DB::table('transport')->where('branche_id',$request->branche)->whereBetween('date', [$from,$to])->exists();
                $transports = DB::table('transport')->where('branche_id',$request->branche)->whereBetween('date', [$from,$to])->get();
                $contents = view('admin.reports.branches.select', ['transports'=>$transports,'transportcount'=>$transportcount,'hasTask'=>$hasTask,'branche'=>$branche])->render();
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
            if($request->branche){
                $branche = Branches::findOrFail($request->branche);
                $contents = view('admin.reports.branches.show', ['branche'=>$branche])->render();
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
}
