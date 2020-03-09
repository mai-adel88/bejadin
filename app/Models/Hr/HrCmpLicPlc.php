<?php

namespace App\Models\Hr;

use Illuminate\Database\Eloquent\Model;

class HrCmpLicPlc extends Model
{ 
    
    protected $table = 'hrcmplicplc';
    public $timestamps = true;
    protected $primaryKey = 'ID_NO';
    protected $fillable = [
        'CmpLicplc_No',
        'CmpLicplc_NmAr',
        'CmpLicplc_NmEn',
    ];
}
