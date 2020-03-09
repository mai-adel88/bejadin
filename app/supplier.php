<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class supplier extends Model
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
    protected $table ='suppliers';
    protected $fillable =[
        'name_ar',
        'name_en',
        'addriss',
        'responsible',
        'email',
        'credit_limit',
        'debtor',
        'creditor',
        'country_id',
        'branches_id',
        'currency',
        'phone1',
        'phone2',
        'fax',
        'account_num',
        'tax_num',
        'tree_id',
        'operation_id',
    ];

    public function country(){
        return $this->hasOne('App\country','id','country_id');
    }
    public function departments(){
        return $this->hasOne('App\Department','id','tree_id');
    }
}
