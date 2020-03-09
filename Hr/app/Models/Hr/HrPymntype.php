<?php

namespace App\Models\Hr;

use Illuminate\Database\Eloquent\Model;

class HrPymntype extends Model
{
    protected $table = 'hrpymntypes';
    public $timestamps = true;
    protected $primaryKey = 'ID_NO';
    protected $fillable = ['Pymnt_No', 'Pymnt_NmAr', 'Pymnt_NmEn', 'Nof_Emp'];
}
