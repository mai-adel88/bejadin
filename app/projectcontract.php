<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class projectcontract extends Model
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
    protected  $table = 'projectcontracts';
    protected $fillable = [
        'branche_id',
        'project_id',
        'date_hijri',
        'date',
        'note',
        'note_en',
        'Date_contract',
        'beginning_contract',
        'End_contract',
        'period_contract',
        'start_implementation',
        'end_implementation',
        'start_warranty',



        'end_warranty',
        'number_employees',
        'Hour_employee',
        'number_months',
        'monthly_payment',
        'revenue_measurement',
        'expenses_measurement',
        'cost_limit',
        'actual_cost',
        'Estimated_value',
        'contract_value',
        'deviation_value',

        'Bank_guarantee_number',
        'warranty_history',
        'amount_guarantee',
        'warranty_issued',
        'warranty_issued_en',

        'comprehensive_insurance',
        'contractor_insurance',
        'reference_retirement',
        'subscriber_id',
        'management_expenses_percentage',
        'management_expenses',
        'department_expenses_percentage',

        'department_expenses',
        'warranty_period_percentage',
        'warranty_period',


        'financial_expenses_percentage',
        'financial_expenses',
        'subtotal_percentage',
        'subtotal',
        'net_deviation_percentage',
        'net_deviation',
        'total_collection',

        'current_balance',

    ];
    public function branshe(){
        return $this->hasMany('App\Branches','id','branche_id');
    }
    public function project(){
        return $this->hasMany('App\Project','id','project_id');
    }
    public function subscriber(){
        return $this->hasMany('App\subscription','id','subscriber_id');
    }
}
