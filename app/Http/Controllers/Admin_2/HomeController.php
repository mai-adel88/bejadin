<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Enums\TypeType;
use App\Notifications\subscriber;
use App\state;
use App\subscription;
use App\subsystem;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Up;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function profile(){
        $user = User::findOrFail(auth()->user()->id);
        $data =[];
        foreach ($user->notifications as $notification) {
            $data[] = $notification->type;
        }
        $subscriber = subscription::where('user_id',auth()->user()->id)->where('status','=',1)->where('price','!=',null)->get();
        $count = subscription::where('user_id',auth()->user()->id)->where('status','=',1)->where('price','!=',null)->get()->count();
        $desubscriber = subscription::where('user_id',auth()->user()->id)->where('status','=',0)->get();
//        dd($desubscriber->count());
        return view('web.index.profile',compact('user','subscriber','desubscriber','count','data'));
    }
    public function create(Request $request,subscription $subscription){
        $data = $this->validate($request,[
            'name_ar' => 'required',
            'name_en' => 'required',
            'email' => 'required|unique:subscriptions',
            'image' => validate_image(),
            'addriss' => 'required',
            'depart_id' => 'sometimes',
            'desname_id' => 'sometimes',
            'subsystem_id' => 'sometimes',
            'start' => 'required|date',
            'end' => 'required|date',
            'phone_1' => 'required|numeric',
            'phone_2' => 'sometimes',
            'per_status' => 'required',
            'age' => 'sometimes',
            'gender' => 'sometimes',
            'facebook' => 'sometimes',
            'twitter' => 'sometimes',
            'cr_num' => 'sometimes',
            'tax_num' => 'sometimes',
            'type' =>  'required',
            'user_id'=>'sometimes'
        ],[],[
            'name_ar' => trans('admin.arabic_name'),
            'name_en' => trans('admin.english_name'),
            'email' => trans('admin.email'),
            'image' => trans('admin.image'),
            'addriss' => trans('admin.addriss'),
            'depart_id' => trans('admin.depart'),
            'desname_id' => trans('admin.desname'),
            'subsystem_id' => trans('admin.subsystem'),
            'start' => trans('admin.startsub'),
            'end' => trans('admin.endsub'),
            'phone_1' => trans('admin.mob'),
            'phone_2' => trans('admin.phone'),
            'per_status' => trans('admin.statuserror'),
            'age' => trans('admin.age'),
            'gender' => trans('admin.gender'),
            'facebook' => trans('admin.facebook'),
            'twitter' => trans('admin.twitter'),
            'cr_num' => trans('admin.cr_num'),
            'tax_num' => trans('admin.tax_num'),
            'type' => trans('admin.type'),
            'user_id'=> trans('admin.subscriper')
        ]);
        if($request->hasFile('image')){
            $data['image'] = Up::upload([
                'request' => 'image',
                'path'=>'subscription',
                'upload_type' => 'single'
            ]);
        }
        $sub = $subscription->create($data);
        $admins = Admin::all();
        foreach ($admins as $admin){
        $admin->notify(new subscriber($sub->id,$data['name_en'],$data['name_ar'],Carbon::today()));
        }
        return redirect(url('profile'))->with(session()->flash('message',trans('admin.success_add')));

    }
    public function select(state $state,subsystem $subsystem,Request $request)
    {
        if($request->ajax()){
            if($request->type){

                if(TypeType::getDescription($request->type) == "single" || TypeType::getDescription($request->type) == "فردي"){
                    $count = subscription::where('user_id',auth()->user()->id)->where('type','=',2)->get()->count();
                    $contents = view('web.profile.subcreate_single', ['state'=>$state,'subsystem'=>$subsystem,'count'=>$count])->render();
                    // do some other manipulation?
                    return $contents;

                }elseif (TypeType::getDescription($request->type) == "company" || TypeType::getDescription($request->type) == "شركة"){
                    $count = subscription::where('user_id',auth()->user()->id)->where('type','=',3)->get()->count();
                    $contents = view('web.profile.subcreate_company', ['state'=>$state,'subsystem'=>$subsystem,'count'=>$count])->render();
                    // do some other manipulation?
                    return $contents;
                }elseif(TypeType::getDescription($request->type) == "student" || TypeType::getDescription($request->type) == "طالب"){
                    $contents = view('web.profile.subcreate_student', ['state'=>$state,'subsystem'=>$subsystem])->render();
                    // do some other manipulation?
                    return $contents;
                };
            }
        }

    }
    public function update($id,Request $request){
        $user = User::findOrFail($id);
        $user->phone = $request->phone;
        $user->save();
        return back();
    }
    public function noticount(Request $request){
        if($request->ajax()) {


                $contents = view('web.profile.noticount')->render();
                // do some other manipulation?
                return $contents;


        }
    }
    public function notinfo(Request $request){
        if($request->ajax()) {


                $contents = view('web.profile.notiinfo')->render();
                // do some other manipulation?
                return $contents;


        }
    }
}
