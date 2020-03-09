<?php

namespace App\Http\Controllers\Admin_2;

use App\model_2\Admin;
use App\Http\Controllers\Controller;
use App\Mail\AdminReserPassword;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class AdminAuth extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin')->except('a_logout');
    }

    public function login(){
        return view('admin_2.login');
    }

    public function dologin(Request $request){

        $rememberme = $request->remmberme == 1 ? true : false;
        if (admin_2()->attempt(['email'=>$request->email,'password'=>$request->password],$rememberme)){
            return redirect('admin_2/dashboard');
        }else{
            return redirect(aurl('/'));
        }
    }

    public function a_logout(){
        admin()->logout();
        return redirect('admin');
    }
    public function forgetPassword(){
        return view('admin.forgetPassword');
    }
    public function forgetPasswordPost(Request $request){
        $admin =Admin::where('email',$request->email)->first();
        if(!empty($admin)){
            $token = app('auth.password.broker')->CreateToken($admin);
            DB::table('password_resets')->insert([
                'email'=>$admin->email,
                'token'=>$token,
                'created_at' => Carbon::now()
            ]);
            Mail::to($admin->email)->send(new AdminReserPassword(['data'=>$admin,'token'=>$token]));
            session()->flash('message',trans('admin.the_link_reset_sent'));
            return back();
        }
        return back();
    }
    public function reset_password($token){
        $csrf_token = DB::table('password_resets')->where('token',$token)->where('created_at','>',Carbon::now()->subHours(2))->first();
        if(!empty($csrf_token)){
            return view('admin.reset_password',compact('csrf_token'));
        }else{
            return redirect(aurl('forgetPassword'));
        }
    }
    public function reset_password_post(Request $request,$token){
        $this->validate($request,[
            'password' => 'required|confirmed',
            'password_confirmation'=>'required'
        ],[],[
            'password' => trans('admin.password'),
            'password_confirmation' => trans('admin.password_Confirmation')
        ]);
        $csrf_token = DB::table('password_resets')->where('token',$token)->where('created_at','>',Carbon::now()->subHours(2))->first();
        if(!empty($csrf_token)){
            $admin = Admin::where('email' , $csrf_token->email )->update(['email'=>$csrf_token->email,'password'=>bcrypt($request->password)]);
            DB::table('password_resets')->where('email',$request->email)->delete();
            admin()->attempt(['email'=>$csrf_token->email,'password'=>$request->password]);
            return redirect('admin');
        }else{
            return redirect(aurl('forget/password'));
        }
    }

}
