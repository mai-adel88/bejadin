<?php

namespace App\Models\Hr;

use Illuminate\Database\Eloquent\Model;

class HrCmpLicType extends Model
{
    protected $table = 'hrcmplictype';
    public $timestamps = true;
    protected $primaryKey = 'ID_NO';
    protected $fillable = ['CmplicTyp_No', 'CmplicTyp_NmAr', 'CmplicTyp_NmEn'];
}
