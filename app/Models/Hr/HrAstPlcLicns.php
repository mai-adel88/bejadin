<?php

namespace App\Models\Hr;

use Illuminate\Database\Eloquent\Model;

class HrAstPlcLicns extends Model
{
    // مكان إصدار الرخص والمدن
    protected $table = 'hrastplclicns';
    public $timestamps = true;
    protected $primaryKey = 'ID_NO';
    protected $fillable = [
        'State_No',
        'State_NmAr',
        'State_NmEn',
        'cty_client', // عملاء
        'cty_resident', // اقامة
        'cty_drivlic', // رخصة القيادة
        'cty_jobactv',  // رخصة مزاولة المهنة
        'cty_Nat_id',  // الهوية الوطنية
        'cty_address',  // العنوان
        'cty_actv',  // فعال او لا
    ];
}
