<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class AstMarket extends Model
{

    protected $table = 'AstMarket';
    protected $primaryKey = 'ID_No';
    public $timestamps = true;
    protected $fillable = [
        'Mrkt_No',
        'Brn_No',
        'Mrkt_NmEn',
        'Mrkt_NmAr',
        'Cmp_No',
        'Mrkt_Active',
    ];

    public function branch()
    {
        return $this->belongsTo('App\Models\Admin\MainBranch','Brn_No','ID_No');
    }

    public function company(){
        return $this->belongsTo('App\Models\Admin\MainCompany', 'Cmp_No', 'ID_No');
    }

}
