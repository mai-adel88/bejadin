<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class MtsItmmfs extends Model
{
    protected $table = 'mtsitmmfs';
    protected $primaryKey = 'ID_No';

    protected $fillable = [
        'Cmp_No',
        'Itm_No',
        'Itm_Parnt',
        'Level_Status',
        'Level_No',
        'Measure_Grp',
        'Itm_Active',
        'Sale_Active',
        'Invt_Active',
        'Itm_Req',
        'Itm_Relation',
        'Itm_No_Main',
        'Ref_No',
        'Actvty_No',
        'Itm_NmAr',
        'Itm_NmEn',
        'Sup_No',
        'Unit_No',
        'UnitPur_No',
        'UnitSaL_No',
        'Pckng_Unit',
        'Pckng_Ratio',
        'Req_Limit',
        'Itm_Pur',
        'Itm_COst',
        'Itm_Sal1',
        'Itm_Sal2',
        'Itm_Sal3',
        'Item_BarCode',
        'Fctry_Barcode',
        'Fctry_Barcode2',
        'Fctry_Barcode3',
        'MaxQty_SaL',
        'Prct_SalBouns',
        'Chk_SalBouns',
        'Chk_Discount',
        'Prct_Discount',
        'Chk_SalComsion',
        'Chk_ExpDate',
        'Chk_Batch',
        'Chk_Qty2',
        'Chk_Qty3',
        'Taxp_Extra',
        'Tax_Allow',
        'Label_No',
        'Opn_Date',
        'Opn_Time',
        'User_ID',
        'Updt_Date',
    ];

    public function parent(){
        return $this->belongsTo(MtsItmmfs::class, 'Itm_No','Itm_Parnt');
    }

    public function children(){
        return $this->hasMany(MtsItmmfs::class, 'Itm_Parnt','Itm_No');
    }

    public function units()
    {
        return $this->hasMany(MtsItmfsunit::class, 'Itm_No', 'Itm_No');
    }


    public function others()
    {
        return $this->hasMany(MtsItmOthr::class, 'Itm_No', 'Itm_No');
    }
}
