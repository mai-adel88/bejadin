<?php

namespace App\Http\Controllers\Admin\report;

use App\book;
use App\bus;
use App\Http\Controllers\Controller;
use App\transport;
use Illuminate\Http\Request;

class RBusController extends Controller
{
    public function index(Request $request)
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
                    return '<div class="subbadgit"> <div class="alert alert-danger">'.trans('admin.theres_no_travel_in_this_schedule').'</div></div>';
                }
                $contents = view('admin.reports.buses.reportbus', ['bus'=>$bus,'driver'=>$driver,'books'=>$books])->render();
                return $contents;
            }
        }
    }
}
