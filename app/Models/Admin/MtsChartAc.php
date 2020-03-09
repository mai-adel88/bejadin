<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class MtsChartAc extends Model
{
    protected $table = 'mtschartac';
    protected $primaryKey = 'ID_No';
    protected $fillable = [
        'Cmp_No',
        'Acc_No',
        'Parnt_Acc',
        'Acc_Typ',
        'Level_No',
        'Acc_Ntr',
        'Level_Status',
        'Acc_NmAr',
        'Acc_NmEn',
        'Clsacc_No1',
        'Clsacc_No2',
        'Clsacc_No3',
        'CostCntr_Flag',
        'Costcntr_No',
        'Fbal_DB',
        'Fbal_CR',
        'DB11',
        'CR11',
        'DB12',
        'CR12',
        'DB13',
        'CR13',
        'DB14',
        'CR14',
        'DB15',
        'CR15',
        'DB16',
        'CR16',
        'DB17',
        'CR17',
        'DB18',
        'CR18',
        'DB19',
        'CR19',
        'DB20',
        'CR20',
        'DB21',
        'CR21',
        'DB22',
        'CR22',
        'Acc_Dt',
        'Acc_DtAr',
        'Acc_Actv',
        'ComplxFbal_DB',
        'ComplxFbal_CR',
        'User_Id',
        'Updt_Time',
    ];

    public function parent(){
        return $this->hasOne(MtsChartAc::class, 'Acc_No','Parnt_Acc');
    }

    public function children(){
        return $this->hasMany(MtsChartAc::class, 'Parnt_Acc', 'Acc_No');
    }
     public function GLjrnTrs(){
            return $this->hasOne('App\Models\Admin\GLjrnTrs','Acc_No','Acc_No');
    }
    public function GLjrnTr(){
        return $this->hasMany('App\Models\Admin\GLjrnTrs','Acc_No','Sysub_Account');
    }
    public function MtsCostcntr(){
        return $this->hasone('App\Models\Admin\MtsCostcntr','Costcntr_No','Clsacc_No3');
    }
}
