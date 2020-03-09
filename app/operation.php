<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class operation extends Model
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
    protected $table= 'operations';
    protected $fillable =[
        'name_ar',
        'name_en',
    ];
    public function departments()
    {
        return $this->hasMany('App\Department','operation_id','id');
    }
    public function subscriber()
    {
        return $this->hasMany('App\subscription','operation_id','id');
    }
    public function suppliers()
    {
        return $this->hasMany('App\supplier','operation_id','id');
    }
    public function drivers()
    {
        return $this->hasMany('App\employee','operation_id','id');
    }
    public function subscribers()
    {
        return $this->hasMany('App\subscription','operation_id','id');
    }
    public function contractors()
    {
        return $this->hasMany('App\Contractors','operation_id','id');
    }
    public function projects()
    {
        return $this->hasMany('App\Project','operation_id','id');
    }
}
