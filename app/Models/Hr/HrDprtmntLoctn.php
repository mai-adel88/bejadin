<?php

namespace App\Models\Hr;

use Illuminate\Database\Eloquent\Model;

class HrDprtmntLoctn extends Model
{
    protected $table = 'hr_dprtmnt_loctns';
    public $timestamps = true;
    protected $primaryKey = 'ID_No';
    protected $fillable = [
        'Actv_No', 'Cmp_No', 
        'DepmLoc_No',  //رقم الجهة- الإدارة
        'Parnt_DepmLoc', //الرئيسي
        'Level_No', 
        'DepmLoc_NmAr',
        'DepmLoc_NmEn', 
        'Level_Status', 
        'Ownr_No', 
        'DepmLoc_Actv',
    ];



    public function parent(){
        return $this->hasOne(HrDprtmntLoctn::class, 'DepmLoc_No','Parnt_DepmLoc');
    }

    public function children(){
        return $this->hasMany(HrDprtmntLoctn::class, 'Parnt_DepmLoc', 'DepmLoc_No');
    }

}
