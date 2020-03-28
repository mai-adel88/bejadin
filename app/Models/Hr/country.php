<?php

namespace App\Models\Hr;

use Illuminate\Database\Eloquent\Model;

class country extends Model
{
    // protected $connection;
    // public function __construct(){
    //     $envFile = app()->environmentFilePath();
    //     $str = file_get_contents($envFile);
    //     $str .= "\n";
    //     $keyPosition = strpos($str, 'DB_CONNECTION=');
    //     $endOfLinePosition = strpos($str, "\n", $keyPosition);
    //     $oldLine = substr($str, $keyPosition, $endOfLinePosition - $keyPosition);
    //     $str_arr = explode("=", $oldLine);
    //     // dd($str_arr);
    //     // dd(\App\database::where('id',1)->first()->name);
    //     $this->connection = $str_arr[1];
    // }
    protected $table = 'countries';
    protected $fillable =[
        'country_name_ar',
        'country_name_en',
        'mob',
        'code',
        'logo',
        // added for hr
        'cntry_cst', // عملاء
        'cntry_sub',// موردين
        'cntry_emp', // موظفين
        'cntry_cmp', // شركات
    ];

    public function project()
    {
        return $this->hasMany('App\Admin\Projectmfs','Country_No', 'id');
    }

    public function address(){
        return $this->hasMany('App\Models\Hr\HREmpadr','Stat_No','id');
    }

}
