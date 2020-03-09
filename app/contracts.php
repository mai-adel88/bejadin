<?php

namespace App;

use App\Branches;
use App\Project;
use App\Contractors;
use App\subscription;
use Illuminate\Database\Eloquent\Model;

class contracts extends Model
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
    protected $table = 'contracts';
    protected $fillable=[
        'section_id',
        'date',
        'higri_date',
        'project_id',
        'contractor_id',
        'Contract_reference',
        'contract_number',
        'subscriber_id',
        'statement_ar',
        'statement_en',
        'contract_date',
        'contract_start',
        'contract_end',
        'contract_period',
        'implementation_start',
        'implementation_end',
        'warranty_start',
        'warranty_end',
        'employees_number',
        'employee_hour_work',
        'months_number',
        'monthly_payment',
        'contract_value',
        'estimated_value',
        'deviation_value',
        'downpayment',
        'warranty_expenses',
        'insurance_value',
        'contract_value_customer',
        'subcontracts_value',
        'total_payments',
        'current_balance',
    ];
    public function branshe(){
        return $this->hasMany('App\Branches','id','section_id');
    }
    public function project(){
        return $this->hasMany('App\Project','id','project_id');
    }
    public function contractor(){
        return $this->hasMany('App\Contractors','id','contractor_id');
    }
    public function subscriber(){
        return $this->hasMany('App\subscription','id','subscriber_id');
    }
}
