<?php

namespace App\Models\Hr;

use Illuminate\Database\Eloquent\Model;

class HrPybnkAcc extends Model
{
    protected $table = 'hrpybnkaccs';
    public $timestamps = true;
    protected $primaryKey = 'ID_NO';
    protected $fillable = ['Bnk_No', 'Bnk_NmAr', 'Bnk_NmEn', 'Bnk_Acc'];
}
