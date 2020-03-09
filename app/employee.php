<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class employee extends Model
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
    protected $table = 'employees';
    protected $fillable =[
        'name_ar',
        'name_en',
        'beginning_date',
        'end_date',
        'renew_date',
        'salary_type',
        'salary',
        'transition_allowance',
        'housing_allowance',
        'food_allowance',
        'other_allowances',
        'work_type',
        'number_rest',
        'work_status',
        'payment_methods',
        'workhour_count',
        'hour_payment',
        'employee_ticket',
        'ticket_class',
        'children_ticket',
        'sales_officer',
        'sales_number',
        'percentage',
        'branches_id',
        'companybanks_id',
        'company_banks_num',
        'employeebanks_id',
        'employee_banks_num',
        'employee_banks_branches',
        'debtor',
        'creditor',
        'accounts_receivable',
        'tree_id',
        'cc_id',
        'cc_type',
        'operation_id',
        'status',
        'statusreport',
    ];
    public function branches(){
        return $this->belongsToMany('App\Branches','branche_employee','employee_id','branche_id')->withPivot('branche_id','employee_id');
    }
    public function project()
    {
        return $this->belongsTo('App\Project','customer_id','id');
    }
    public function departments(){
        return $this->hasOne('App\Department','id','tree_id');
    }
}
