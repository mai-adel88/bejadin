<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:191'],
            'name_en' => ['required', 'string', 'max:191'],
            'email' => ['required', 'string', 'email', 'max:191', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'addriss' => ['required', 'string', 'max:191'],
            'phone' => ['required', 'min:20','numeric','unique:users'],
            'gender' => ['required'],
            'city_id' => ['sometimes'],
            'state_id' => ['required']
        ],[],[
            'name' => trans('auth.arabic_name'),
            'name_en' => trans('auth.english_name'),
            'email' => trans('auth.email'),
            'password' => trans('auth.Password'),
            'addriss' => trans('auth.Addriss'),
            'phone' => trans('auth.phone'),
            'gender' => trans('auth.gender'),
            'city_id' => trans('auth.cities'),
            'state_id' => trans('auth.state')
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'name_en' => $data['name_en'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'addriss' => $data['addriss'],
            'phone' => $data['phone'],
            'gender' => $data['gender'],
            'city_id' => $data['city_id'],
            'state_id' => $data['state_id']
        ]);
    }
}
