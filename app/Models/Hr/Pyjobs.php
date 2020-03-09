<?php

namespace App\Models\Hr;

use Illuminate\Database\Eloquent\Model;

class Pyjobs extends Model
{
    //جدول الوظيفه
    protected $table = 'pyjobs';
    public $timestamps = true;
    protected $primaryKey = 'ID_No';

    protected $fillable = [
        'Job_No',
        'Job_NmAr',
        'Job_NmEn',
        'Job_Typ',
        'job_cmpny',
        'job_gov',
        'job_desc',
        'job_tech'
    ];
    // public function employees()
    // {
    //     return $this->hasMany(HrEmpmfs::class, 'Job_No','Job_No');
    // }
}
