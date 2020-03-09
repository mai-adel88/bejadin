<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class state extends Model
{
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
    protected $table = 'states';
    protected $fillable=[
        'state_name_ar',
        'state_name_en',
        'city_id',
        'country_id'
    ];

    public function city(){
        return $this->hasOne('App\city','id','city_id');
    }
    public function country(){
        return $this->hasOne('App\country','id','country_id');
    }
//    public function subscriptions(){
//        return $this->hasMany('App\subscription','depart_id','id');
//    }
}
