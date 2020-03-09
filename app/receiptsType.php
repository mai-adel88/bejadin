<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class receiptsType extends Model
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
    protected $table = 'receipts_type';
    protected $fillable = [
        'name_ar',
        'name_en',
        'tree_id',
        'operation_id',
        'cc_id',
        'relation_id',
        'debtor',
        'creditor',
        'note',
        'note_en',
        'status',
        'receipts_id',
        'invoice_id',
        'tax',
    ];

    public function receiptsData(){
        return $this->belongsToMany('App\receiptsData','receipts_data_types','receipts_type_id','receipts_data_id');
    }
    public function receipts(){
        return $this->hasOne('App\receipts','id','receipts_id');
    }
    public function operations(){
        return $this->hasOne('App\operation','id','operation_id');
    }
    public function glcc(){
        return $this->hasOne('App\glcc','id','cc_id');
    }
    public function departments(){
        return $this->hasOne('App\Department','id','tree_id');
    }

}
