<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class MtsItmOthr extends Model
{
    protected $table = 'mtsitmothr';
    protected $primaryKey = 'ID_No';

    protected $fillable = [
        'Actvty_No',
        'Cmp_No',
        'Itm_No',
        'Itm_LengthSteel',
        'Itm_WidthSteel',
        'Itm_HeightSteel',
        'Itm_Durability',
        'Itm_WghtPaper',
        'Itm_LengthPaper',
        'Itm_WidthPaper',
        'Itm_TWeight',
        'Itm_NWeight',
        'Shelf_No',
        'Itm_Othr1',
        'Itm_Othr2',
        'Mdcn_Grup1',
        'Mdcn_Grup2',
        'Mdcn_Grup3',
        'Mdcn_Grup4',
        'Itm_Picture',
        'ItmRplc_No1',
        'ItmRplc_No2',
        'ItmRplc_No3',
        'ItmRplc_NmEn1',
        'ItmRplc_NmEn2',
        'ItmRplc_NmEn3',
    ];

    public function item()
    {
        return $this->belongsTo(MtsItmmfs::class, 'Itm_No', 'Itm_No');
    }
}
