<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class MtsClosAcc extends Model
{
    protected $table = 'MtsClosAcc';
    protected $primaryKey = 'ID_No';
    protected $fillable = [
        'Cmp_No',
        'CLsacc_No',
        'Parnt_Acc',
        'Level_Status',
        'Level_No',
        'Main_Rpt',
        'CLsacc_NmAr',
        'CLsacc_NmEn',
        'Prnt_YN',
        'Prnt_Sorc',
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
}
