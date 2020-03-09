<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Http\Controllers\Controller;
use App\Mail\AdminReserPassword;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Models\Admin\MainCompany;
use App\Models\Admin\MainBranch;
use App\Models\Admin\ActivityTypes;

class AdminAuth extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin')->except('a_logout', 'getCompanies');
    }

    public function login( Request $request){

        if (auth('admin')->check()){
            return redirect()->route('admin.home');
        }

        //connect to DB according to the selected company
        if($request->id == 1){
            $envFile = app()->environmentFilePath();
            $str = file_get_contents($envFile);
            $str .= "\n"; // In case the searched variable is in the last line without \n
            $keyPosition = strpos($str, 'DB_CONNECTION=');
            $endOfLinePosition = strpos($str, "\n", $keyPosition);
            $oldLine = substr($str, $keyPosition, $endOfLinePosition - $keyPosition);
            $str = str_replace($oldLine, "DB_CONNECTION=mysql", $str);
            $str = substr($str, 0, -1);
            file_put_contents($envFile, $str);
            $env = app()->loadEnvironmentFrom($envFile);
            \Artisan::call('config:clear');

        }else if($request->id == 2 ){
            $envFile = app()->environmentFilePath();
            $str = file_get_contents($envFile);
            $str .= "\n"; // In case the searched variable is in the last line without \n
            $keyPosition = strpos($str, 'DB_CONNECTION=');
            $endOfLinePosition = strpos($str, "\n", $keyPosition);
            $oldLine = substr($str, $keyPosition, $endOfLinePosition - $keyPosition);
            $str = str_replace($oldLine, "DB_CONNECTION=mysql2", $str);
            $str = substr($str, 0, -1);
            file_put_contents($envFile, $str);
            $env = app()->loadEnvironmentFrom($envFile);
            \Artisan::call('config:clear');
        }else if($request->id == 3 ){
            $envFile = app()->environmentFilePath();
            $str = file_get_contents($envFile);
            $str .= "\n"; // In case the searched variable is in the last line without \n
            $keyPosition = strpos($str, 'DB_CONNECTION=');
            $endOfLinePosition = strpos($str, "\n", $keyPosition);
            $oldLine = substr($str, $keyPosition, $endOfLinePosition - $keyPosition);
            $str = str_replace($oldLine, "DB_CONNECTION=mysql3", $str);
            $str = substr($str, 0, -1);
            file_put_contents($envFile, $str);
            $env = app()->loadEnvironmentFrom($envFile);
            \Artisan::call('config:clear');
        }else if($request->id == 4 ){
            $envFile = app()->environmentFilePath();
            $str = file_get_contents($envFile);
            $str .= "\n"; // In case the searched variable is in the last line without \n
            $keyPosition = strpos($str, 'DB_CONNECTION=');
            $endOfLinePosition = strpos($str, "\n", $keyPosition);
            $oldLine = substr($str, $keyPosition, $endOfLinePosition - $keyPosition);
            $str = str_replace($oldLine, "DB_CONNECTION=mysql4", $str);
            $str = substr($str, 0, -1);
            file_put_contents($envFile, $str);
            $env = app()->loadEnvironmentFrom($envFile);
            \Artisan::call('config:clear');
        }else if($request->id == 5 ){
            $envFile = app()->environmentFilePath();
            $str = file_get_contents($envFile);
            $str .= "\n"; // In case the searched variable is in the last line without \n
            $keyPosition = strpos($str, 'DB_CONNECTION=');
            $endOfLinePosition = strpos($str, "\n", $keyPosition);
            $oldLine = substr($str, $keyPosition, $endOfLinePosition - $keyPosition);
            $str = str_replace($oldLine, "DB_CONNECTION=mysql5", $str);
            $str = substr($str, 0, -1);
            file_put_contents($envFile, $str);
            $env = app()->loadEnvironmentFrom($envFile);
            \Artisan::call('config:clear');
        }

        //return a list of all company actitvity types to enable user to select
        $acts = ActivityTypes::get(['Actvty_No', 'Name_'.ucfirst(session('lang'))]);
        $companies = MainCompany::get(['Cmp_No', 'Cmp_Nm'.ucfirst(session('lang'))]);
        return view('admin.login', compact('companies', 'acts'));
    }

    public function dologin(Request $request){
        if($request->Cmp_No === null || $request->Actvty_No == null){
            return redirect(aurl('/'))->with(session()->flash('message', trans('admin.select_cmp')));
        }
        session(['Cmp_No' => $request->Cmp_No]);
        session(['Actvty_No' => $request->Actvty_No]);

        $rememberme = $request->remmberme == 1 ? true : false;
        if (admin()->attempt(['email'=>$request->email,'password'=>$request->password],$rememberme)){
            return redirect('admin/dashboard');
        }else{
            return redirect(aurl('/'));
        }
    }

    public function a_logout(){
        session()->forget('Cmp_No');
        admin()->logout();
        return redirect('/');
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

    public function getCompanies(Request $request){
        if($request->ajax()){
            if($request->Actvty_No == -1){
                $companies = MainCompany::get(['Cmp_No', 'Cmp_Nm'.ucfirst(session('lang'))]);
                return view('admin.companies', compact('companies'));
            }
            else{
                $companies = MainCompany::where('Actvty_No', $request->Actvty_No)->get(['Cmp_No', 'Cmp_Nm'.ucfirst(session('lang'))]);
                return view('admin.companies', compact('companies'));
            }
        }
    }

}
