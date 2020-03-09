<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branches extends Model
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
    protected $table ='branches';
    protected $fillable =[
        'name_ar',
        'name_en',
        'addriss',
        'type',
        'mini_charge',
    ];
    public function employees(){
        return $this->belongsToMany('App\employee','branche_employee','branche_id','employee_id')->withPivot('branche_id','employee_id');
    }
    public function subscribers(){
        return $this->hasMany('App\subscription','branches_id','id');
    }
}
