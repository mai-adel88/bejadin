<?php

namespace App\Models\Hr;

use Illuminate\Database\Eloquent\Model;

class DepmCmp extends Model
{
//جدول الاقسام
    protected $table = 'depm_cmp';
    public $timestamps = true;
    protected $primaryKey = 'ID_No';

    protected $fillable = [
        'Cmp_No', // رقم الشركة
        'Depm_Main', // 11 or 12 
        'Depm_NmAr', // اسم القسم عربى
        'Depm_NmEn' // اسم القسم انجليزى
    ]; 

    public function company()
    {
        return $this->belongsTo(HRMainCmpnam::class, 'Cmp_No', 'Cmp_No');
    }
    
    public function employees()
    {
        return $this->hasMany(HrEmpmfs::class, 'SubCmp_No','Depm_Main');
    }
}
