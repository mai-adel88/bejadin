<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class levels extends Model
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
    protected $table = 'levels';
    protected $fillable = [
        'type',
        'name_ar',
        'name_en',
        'format',
        'length',
        'levelId',
        'parent_id'
    ];
    public function parents(){
        return $this->hasMany('App\levels','id','parent_id');
    }
}
