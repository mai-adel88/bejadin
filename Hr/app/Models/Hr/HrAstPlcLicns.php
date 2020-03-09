<?php

namespace App\Models\Hr;

use Illuminate\Database\Eloquent\Model;

class HrAstPlcLicns extends Model
{
    protected $table = 'hrastplclicns';
    public $timestamps = true;
    protected $primaryKey = 'ID_NO';
    protected $fillable = ['State_No', 'State_NmAr', 'State_NmEn'];
}
