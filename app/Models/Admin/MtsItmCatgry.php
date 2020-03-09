<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class MtsItmCatgry extends Model
{
    protected $table = 'mtsitmcatgry';
    protected $primaryKey = 'ID_No';

    protected $fillable = [
        'Cmp_No',
        'Actvty_No',
        'Itm_No',
        'Parent_Itm',
        'Level_Status',
        'Level_No',
        'Itm_Active',
        'Sale_Active',
        'Itm_NmAr',
        'Itm_NmEn',
        'Sup_No',
        'Dpm_No',
        'Opn_Date',
        'Opn_Time',
        'User_ID',
        'Updt_Date',
    ];
}
