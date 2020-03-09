<?php

namespace App\Models\Hr;

use Illuminate\Database\Eloquent\Model;

class HrPyhousTyp extends Model
{
    protected $table = 'hrpyhoustyps';
    public $timestamps = true;
    protected $primaryKey = 'ID_NO';
    protected $fillable = ['HusTyp_No', 'HusTyp_NmAr', 'HusTyp_NmEn'];
}
