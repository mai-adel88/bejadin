<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use App\Admin;
use App\Models\Admin\MainBranch;

class MainCompany extends Model
{
    protected $table = 'maincompany';
    protected $primaryKey = 'ID_No';
    protected $fillable = [
        'Cmp_No',
        'Cmp_NmAr',
        'Cmp_NmEn',
        'Cmp_Email',
        'Cmp_Adrs',
        'Cmp_Tel',
        'Actvty_No',
        'Picture',
        'Accredit_expens',
        'Foreign_Curncy',
        'Alw_slmacc',
        'L_Curncy_No',
    ];

    public function admin(){
        return $this->belongsTo(Admin::class, 'id', 'ID_No');
    }


    public function branches(){
        return $this->hasMany(MainBranch::class, 'Cmp_No', 'Cmp_No');
    }

    public function activity()
    {
        return $this->belongsTo(ActivityTypes::class, 'Actvty_No', 'Actvty_No');
    }

    public function customers()
    {
        return $this->hasMany(MTsCustomer::class, 'Cmp_No', 'Cmp_No');
    }

    public function salesMan()
    {
        return $this->hasMany(AstSalesman::class, 'Cmp_No', 'ID_No');
    }

    public function invoices()
    {
        return $this->hasMany(InvLodhdr::class, 'Cmp_No', 'Cmp_No');
    }
    public function employeeData()
    {
        return $this->hasMany(HrEmpmfs::class, 'Cmp_No', 'Cmp_No');
    }

}
