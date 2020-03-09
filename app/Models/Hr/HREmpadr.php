<?php

namespace App\Models\Hr;

use Illuminate\Database\Eloquent\Model;

class HREmpadr extends Model
{
    protected $table = 'hr_empadrs';
    protected $primaryKey = 'ID_No';
    public $timestamps = true;
    protected $fillable = [
        'Cmp_No',
        'Emp_No',
        'Cntry_No',
        'Phon_Cntry',
        'Emp_Adrs',
        'Name_Nerst',
        'Phon_nerst',
        'Adrs_Nerst',
        'Notes',
        'Emp_City',
        'Emp_Street',
        'Stat_No',
        'Emp_Phon',
        'Emp_Mobile',
        'E_Email',
        'RefPerson_Nm',
        'RefPerson_Mobile',
        'Emp_Adrsno',
        'Blck',
        'Buld_Typ',
        'Lane',
        'Divsn_No',
        'Flor_No',
        'Hous_No',
        'Hous_Entry',
        'Hous_Adrs',
        'Hous_Phon',
        'Park_Buldno',
        'Park_Cardno',
        'ParkSt_DT',
        'ParkEn_Dt',
        'ParkBuld_Nm',
        'Park_Florno',
    ];
}
