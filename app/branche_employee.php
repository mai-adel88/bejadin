<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class branche_employee extends Model
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
    protected $table = 'branche_employee';
    protected $fillable = [
        'employee_id',
        'branche_id',
    ];
    public function drivers(){
        return $this->belongsTo('App\employee','employee_id','id');
    }
    public function branches(){
        return $this->belongsTo('App\Branches','branche_id','id');
    }
}
