<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class MtsCostcntr extends Model
{
    protected $table = 'mts_costcntrs';
    protected $primaryKey = 'ID_No';
    protected $fillable = [
        'Cmp_No',
        'Costcntr_No',
        'Parnt_Acc',
        'Level_Status',
        'Level_No',
        'Costcntr_Nmar',
        'Costcntr_Nmen',
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
    ];


    public function parent(){
        return $this->hasOne(MtsCostcntr::class, 'Costcntr_No','Parnt_Acc');
    }

    public function children(){
        return $this->hasMany(MtsCostcntr::class, 'Parnt_Acc', 'Costcntr_No');
    }

}
