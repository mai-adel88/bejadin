<?php

namespace App\Http\Controllers\Admin\report;

use App\Branches;
use App\Http\Controllers\Controller;
use App\schedule;
use App\subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Branches $branches)
    {
        if (auth()->guard('admin')->user()->branches_id == $branches->first()->id) {
            $subscriptions = subscription::all();
        }else{
            $subscriptions = subscription::where('branches_id','=',auth()->guard('admin')->user()->branches_id)->get();
        }
        return view('admin.reports.report',compact('subscriptions'));
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

                $subscriber = subscription::find($request->subscriber);
                $bookcount = DB::table('book')->where('subscriper_id',$request->subscriber)->whereBetween('date', [$from,$to])->count();
                $hasTask = DB::table('book')->where('subscriper_id',$request->subscriber)->whereBetween('date', [$from,$to])->exists();
                $transports = $subscriber->transport->whereBetween('date', [$from,$to]);

                $contents = view('admin.reports.select', ['transports'=>$transports,'bookcount'=>$bookcount,'hasTask'=>$hasTask,'subscriber'=>$subscriber])->render();
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
            if($request->sub){
                $subscriber = subscription::findOrFail($request->sub);
                $contents = view('admin.reports.show', ['subscriber'=>$subscriber])->render();
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
