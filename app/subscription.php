<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class subscription extends Model
{
    use SoftDeletes;
    protected $connection;
    public function __construct(){
        $envFile = app()->environmentFilePath();
        $str = file_get_contents($envFile);
        $str .= "\n";
        $keyPosition = strpos($str, 'DB_CONNECTION=');
        $endOfLinePosition = strpos($str, "\n", $keyPosition);
        $oldLine = substr($str, $keyPosition, $endOfLinePosition - $keyPosition);
        $str_arr = explode("=", $oldLine);
        // dd($str_arr);
        // dd(\App\database::where('id',1)->first()->name);
        $this->connection = $str_arr[1];
    }


    protected $dates = ['deleted_at'];
    protected $table = 'subscriptions';
    protected $fillable = [
        'name_ar',
        'name_en',
        'email',
        'address',
        'branches_id',
        'status',
        'phone_1',
        'phone_2',
        'phone_3',
        'phone_4',
        'per_status',
        'facebook',
        'twitter',
        'tax_num',
        'Discounts',
        'Commissions',
        'note',
        'debtor',
        'creditor',
        'user_id',
        'admin_id',
        'operation_id',
        'countries_id',
        'city_id',
        'employee_id',
        'activity_type_id',
        'cc_id',
        'cc_type',
        'state_id',
        'tree_id',
        'credit_limit',
        'repayment_period',
        'discount',
    ];

    public function users(){
        return $this->hasone('App\User','id','user_id');
    }
    public function countries(){
        return $this->hasone('App\country','id','countries_id');
    }
    public function cities(){
        return $this->hasone('App\city','id','city_id');
    }
    public function state(){
        return $this->hasone('App\state','id','state_id');
    }
    public function activity_type(){
        return $this->hasone('App\activity_type','id','activity_type_id');
    }
    public function cc(){
        return $this->hasone('App\glcc','id','cc_id');
    }
    public function employee(){
        return $this->hasone('App\employee','id','employee_id');
    }
    public function admins(){
        return $this->hasone('App\Admin','id','admin_id');
    }
    public function parents(){
        return $this->belongsToMany('App\parents','sub_parents','subscription_id','parent_id');
    }
    public function branches(){
        return $this->hasOne('App\Branches','id','branches_id');
    }
    public function operations(){
        return $this->hasOne('App\operation','id','operation_id');
    }
    public function departments()
    {
        return $this->hasOne('App\Department','id','tree_id');
    }
//    public function departments(){
//        return $this->hasManyThrough('App\Department', 'App\operation','id','operation_id');
//    }

}
