<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class limitations extends Model
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
    protected $table = 'limitations';
    protected $fillable = [
        'limitationId',
        'branche_id',
        'date',
        'limitationsType_id',
        'invoice_id',
        'status',
        'created_at',
    ];
    public function limitationsData(){
        return $this->hasMany('App\limitationsData','limitations_id','id');
    }
    public function limitations_type(){
        return $this->hasMany('App\limitationsType','limitations_id','id');
    }
    public function limitationReceipts(){
        return $this->hasOne('App\limitationReceipts','id','limitationsType_id');
    }
}
