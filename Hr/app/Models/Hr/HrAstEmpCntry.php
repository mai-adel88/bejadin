<?php

namespace App\Models\Hr;

use Illuminate\Database\Eloquent\Model;

class HrAstEmpCntry extends Model
{
    protected $table = 'hrastempcntry';
    public $timestamps = true;
    protected $primaryKey = 'ID_NO'; 
    protected $fillable = ['Cntry_No', 'Cntry_NmAr', 'Cntry_NmEn'];
}
