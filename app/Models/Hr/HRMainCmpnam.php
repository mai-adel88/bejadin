<?php

namespace App\Models\Hr;

use Illuminate\Database\Eloquent\Model;

class HRMainCmpnam extends Model
{
    protected $table = 'hrmaincmpnam';
    public $timestamps = true; 
    protected $primaryKey = 'ID_NO';
    protected $fillable = [
        'Cmp_No',
        'Cmp_Activity',
        'Local_Lang',
        'Sys_SetupNo',
        'Cmp_ShrtNm',
        'Start_Month',
        'Start_Year',
        'End_Month',
        'End_year',
        'Start_MonthHij',
        'Start_YearHij',
        'End_MonthHij',
        'End_yearHij',
        'Cmp_NmAr',
        'Cmp_NmAr2',
        'Cmp_NmEn',
        'Cmp_NmEn2',
        'Cmp_Tel',
        'Cmp_Fax',
        'Cmp_Email',
        'Cmp_AddAr',
        'Cmp_AddEn',
        'Picture',
        'Activity_Type',
        'CR_No',
        'CC_No',
        'License_No',
        'Tax_No',
        'TaxExtra_Prct',
        'Prnt_Forms',
        'NofDay_SalryMnth',
        'NofDay_PationHldy',
        'HldIssue_Depend',
        'Hldestm_Depend',
        'Dep_Budge',
        'Emp_App',
        'Job_Under',
        'Nation_Effect',
        'Allw_RenewResidnc',
        'NofDys_RenewResidnc',
        'AllCmp_RenewResidnc',
        'CmpNo_RenewResidnc',
        'Allw_RenewPassport',
        'NofDys_RenewPassport',
        'AllCmp_RenewPassport',
        'CmpNo_RenewPassport',
        'Allw_RenewDrivLicns',
        'NofDys_RenewDrivLicns',
        'AllCmp_RenewDrivLicns',
        'CmpNo_RenewDrivLicns',
        'Allw_ReneWorkPermit',
        'NofDys_ReneWorkPermit',
        'AllCmp_ReneWorkPermit',
        'CmpNo_ReneWorkPermit',
        'Allw_RenewCarlicense',
        'NofDys_RenewCarlicense',
        'AllCmp_RenewCarlicense',
        'CmpNo_RenewCarlicense',
        'Allw_RenewCarInsurance',
        'NofDys_RenewCarInsurance',
        'AllCmp_RenewCarInsurance',
        'CmpNo_RenewCarInsurance',
        'Month_Post1',
        'Month_Post2',
        'Month_Post3',
        'Month_Post4',
        'Month_Post5',
        'Month_Post6',
        'Month_Post7',
        'Month_Post8',
        'Month_Post9',
        'Month_Post10',
        'Month_Post11',
        'Month_Post12',
    ];

    public function hrs(){
        return $this->hasMany(Hr::class, 'ID_NO', 'Cmp_ID');
    }
    
    public function departments()
    {
        return $this->hasMany(DepmCmp::class, 'Cmp_No', 'Cmp_No');
    }

    // address
    public function empAdr()
    {
        return $this->hasMany(HREmpadr::class, 'Cmp_No', 'Cmp_No');
    }
    // attaches
    public function attaches()
    {
        return $this->hasMany(HREmpAttach::class, 'Cmp_No', 'Cmp_No');
    }
}
