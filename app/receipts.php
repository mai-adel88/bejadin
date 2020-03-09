<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class receipts extends Model
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
    protected $table = 'receipts';
    protected $fillable = [
        'receiptId',
        'branche_id',
        'date',
        'receiptsType_id',
        'invoice_id',
        'operation_id',
        'status',
        'created_at',
    ];

    public function receiptsData(){
        return $this->belongsTo('App\receiptsData','id','receipts_id');
    }
    public function receipts_type(){
        return $this->hasMany('App\receiptsType','receipts_id','id');
    }
    public function limitationReceipts(){
        return $this->hasOne('App\limitationReceipts','id','receiptsType_id');
    }
    public function branches(){
        return $this->hasOne('App\Branches','id','branche_id');
    }
}
