<?php

namespace App\Models\Hr;

use Illuminate\Database\Eloquent\Model;

class LocClass extends Model
{
    //جدول الاداره
    protected $table = 'loc_class';
    public $timestamps = true;
    protected $primaryKey = 'ID_NO';

    protected $fillable = [
        'Cmp_No',
        'Class_No',
        'Class_NmAr',
        'Class_NmEn'
    ];

    // public function employees()
    // {
    //     return $this->hasMany(HrEmpmfs::class, 'Depm_No','Class_No');
    // }
}
