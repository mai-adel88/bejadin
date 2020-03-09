<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class receiptsData extends Model
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
    protected $table = 'receipts_data';
    protected $fillable = [
        'debtor',
        'creditor',
        'receipt_number',
        'check',
        'checkDate',
        'person',
        'taken',
        'invoice_id',
        'receipts_id',
        'tree_id',
        'operation_id',
        'note',
        'note_en',
    ];

    public function receiptsType(){
        return $this->belongsToMany('App\receiptsType','receipts_data_types','receipts_data_id','receipts_type_id');
    }
    public function departments(){
        return $this->hasOne('App\Department','id','tree_id');
    }
    public function receipts(){
        return $this->hasOne('App\receipts','id','receipts_id');
    }
    public function operations(){
        return $this->hasOne('App\operation','id','operation_id');
    }
}
