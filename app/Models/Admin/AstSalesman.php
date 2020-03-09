<?php

namespace App\Models\Admin;
use App\Models\Admin\AstMarket;
use Illuminate\Database\Eloquent\Model;

class AstSalesman extends Model
{

    protected $table = 'astsalesman';
    protected $primaryKey = 'ID_No';
    public $timestamps = true;
    protected $fillable = [
        'Slm_No',
        'Cmp_No',
        'Brn_No',
        'Mark_No',   //المشرف
        'StoreNo',
        'Slm_NmEn',
        'Slm_NmAr',
        'Target',
        'Slm_Tel',
        'Slm_Active',
        'Opn_Date',
        'Opn_Time',
        'User_ID',
        'Updt_Date'
    ];

    public function supervisor()
    {
        return $this->belongsTo('App\Models\Admin\AstMarket', 'Mark_No', 'ID_No');
    }

    public function branch()
    {
        return $this->belongsTo('App\Models\Admin\MainBranch','Brn_No','ID_No');
    }

    public function company(){
        return $this->belongsTo('App\Models\Admin\MainCompany', 'Cmp_No', 'ID_No');
    }


}
