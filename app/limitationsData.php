<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class limitationsData extends Model
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
    protected $table = 'limitations_datas';
    protected $fillable = [
        'debtor',
        'creditor',
        'status',
        'invoice_id',
        'limitations_id',
    ];
    public function buses(){
        return $this->hasOne('App\bus','id','bus_id');
    }
    public function limitationsType(){
        return $this->belongsToMany('App\limitationsType','limitations_data_types','limitations_data_id','limitations_type_id');
    }
}
