<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class city extends Model
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
    protected $table = 'cities';
    protected $fillable=[
        'city_name_ar',
        'city_name_en',
        'country_id',
    ];

    public function country(){
        return $this->hasOne('App\country','id','country_id');
    }

    public function address(){
        return $this->hasMany('App\Models\Hr\HREmpadr','Stat_No','id');
    }
}
