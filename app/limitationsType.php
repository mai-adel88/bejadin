<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class limitationsType extends Model
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
    protected $table = 'limitations_type';
    protected $fillable = [
        'name_ar',
        'name_en',
        'tree_id',
        'operation_id',
        'limitations_id',
        'cc_id',
        'relation_id',
        'debtor',
        'creditor',
        'note',
        'note_en',
        'status',
        'invoice_id',
        'month_for',
        'receipt_number',
    ];

    public function limitationsData(){
        return $this->belongsToMany('App\limitationsData','limitations_data_types','limitations_type_id','limitations_data_id');
    }
    public function limitations(){
        return $this->hasOne('App\limitations','id','limitations_id');
    }
    public function glcc(){
        return $this->hasOne('App\glcc','id','cc_id');
    }
    public function departments(){
        return $this->hasOne('App\Department','id','tree_id');
    }
}
