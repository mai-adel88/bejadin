<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class MtsItmfsunit extends Model
{
    protected $table = 'mtsitmfsunit';
    protected $primaryKey = 'ID_No';

    protected $fillable = [
        'Actvty_No',
        'Cmp_No',
        'Cstm_Agrmnt',
        'Itm_No',
        'Ln_No',
        'Unit_No',
        'Unit_Ratio',
        'Unit_Pur',
        'Unit_Cost',
        'Unit_Sal1',
        'Unit_Sal2',
        'Unit_Sal3',
        'Unit_Sal4',
        'Unit_Discval',
        'Unit_DiscPrct',
        'Updt_Date',
        'Label_No',
    ];

    public function item()
    {
        return $this->belongsTo(MtsItmmfs::class, 'Itm_No', 'Itm_No');
    }
}
