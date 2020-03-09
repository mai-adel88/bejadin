<?php

namespace App\Http\Controllers\admin_2;

use App\Branches;
use App\bus;
use App\drivers;
use App\Mail\AdminMessage;
use App\schedule;
use App\subscription;
use App\subtransport;
use App\transport;
use App\User;
use App\visitor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Khill\Lavacharts\Lavacharts;

class DashboardController extends Controller
{
    public function home(User $users){
        $branches = Branches::all();
        $branche_id = Branches::all()->first()->id;
        $lava = new Lavacharts;
        $popularity = $lava->DataTable();
        $data = visitor::select('country as 0', 'users as 1')
            ->get()
            ->toArray();
        $popularity->addStringColumn('country')
            ->addNumberColumn('users')
            ->addRows($data);
        $lava->GeoChart('Popularity', $popularity, [
            'backgroundColor'=> '#3c8dbc',
            'colors' => ['#8dbdda'],
            'datalessRegionColor' => '#edf4f9',
            'colorAxis' => ['#edf4f9','#8dbdda'],
        ]);
        return view('admin.home',compact('users','lava','branches'));
    }
    public function sendmail(Request $request) {
        $data = $this->validate($request,[
            'subject' => 'required',
            'contents' => 'required',
            'emailto' => 'required',
        ],[],[
            'subject' => trans('admin.subject'),
            'contents' => trans('admin.Message'),
            'emailto' => trans('admin.Email_To'),
        ]);
        $from = auth()->guard('admin')->user()->email;
        $subject = $request->subject;
        $message = $request->contents;
        $to = $request->emailto;

        Mail::to($to)->send(new AdminMessage($from,$subject,$message));



        return back();
    }

}
