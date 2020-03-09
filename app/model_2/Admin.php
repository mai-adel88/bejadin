<?php

namespace App\model_2;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;
use DB;
class Admin extends Authenticatable
{

//    public function __construct()
//    {
//        DB::connection('bejadin_operation_2');
//    }

protected $connection = 'mysql2';

    use HasApiTokens,Notifiable;
    use HasRoles;
    protected $guard_name = 'admins_2';


    protected $table = 'admins';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','image','branches_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function branches(){
        return $this->hasOne('App\Branches','id','branches_id');
    }


}
