<?php

namespace App\Http\Controllers\Hr;

// use App\Branches;
use App\Http\Controllers\Controller;
use App\Models\Admin\MainBranch;
use App\Models\Admin\SchLStudntMfs;
use App\bus;
use App\drivers;
use App\Mail\AdminMessage;
use App\Models\Hr\Hr;
use App\schedule;
use App\students;
use App\subtransport;
use App\transport;
use App\User;
use App\visitor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Khill\Lavacharts\Lavacharts;

class HrDashboardController extends Controller
{
    public function home(Hr $users){
        $branches = MainBranch::all();
        $branche_id = MainBranch::all()->first()->Brn_No;

//        if (auth()->guard('hr')->user()->branches_id == $branches->first()->id) {
//            $transports = transport::where('date','>=',Carbon::today()->format('Y-m-d'))->whereIn('status',[1,null])->where('seats','!=',null)->get();
//        }else{
//            $transports = transport::where('branche_id',auth()->guard('hr')->user()->branches_id)->where('seats','!=',null)->whereIn('status',[1,null])->where('date','>=',Carbon::today()->format('Y-m-d'))->get();
//        }
        return view('hr.home',compact(['users']));
    }
//    public function sendmail(Request $request) {
//        $data = $this->validate($request,[
//            'subject' => 'required',
//            'contents' => 'required',
//            'emailto' => 'required',
//        ],[],[
//            'subject' => trans('admin.subject'),
//            'contents' => trans('admin.Message'),
//            'emailto' => trans('admin.Email_To'),
//        ]);
//        $from = auth()->guard('hr')->user()->email;
//        $subject = $request->subject;
//        $message = $request->contents;
//        $to = $request->emailto;
//
//        Mail::to($to)->send(new AdminMessage($from,$subject,$message));
//
//
//
//        return back();
//    }

}
