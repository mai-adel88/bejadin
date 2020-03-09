<?php

namespace App;

use App\ContractorType;
use App\country;
use Illuminate\Database\Eloquent\Model;

class Contractors extends Model
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
    protected $table = 'contractors';
    protected $fillable=[
        'id',
        'name_ar',
        'name_en',
        'tree_id',
        'contractor_type_id',
        'address',
        'country_id',
        'currency',
        'credit_limit',
        'account_number',
        'debtor',
        'creditor',
        'operation_id',
    ];
    public function contractortype(){
        return $this->belongsTo('App\ContractorType','contractor_type_id','id');
    }
    public function country(){
        return $this->belongsTo('App\country','country_id','id');
    }
    public function departments(){
        return $this->hasOne('App\Department','id','tree_id');
    }
}
