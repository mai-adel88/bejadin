<?php

namespace App\Models\Hr;

use Illuminate\Database\Eloquent\Model;

class HrAstCmpLicIsu extends Model
{
    protected $table = 'hrastcmplicisu';
    public $timestamps = true;
    protected $primaryKey = 'ID_NO';
    protected $fillable = ['CmpLicisu_No', 'CmpLicisu_NmAr', 'CmpLicisu_NmEn'];
}
