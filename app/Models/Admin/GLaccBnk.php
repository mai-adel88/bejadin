<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class GLaccBnk extends Model
{
    protected $table = 'GLaccBnk';
    protected $primaryKey = 'ID_No';
    protected $fillable = [
        'Cmp_No',
        'Ln_No',
        'Acc_No',
        'Acc_NmAr',
        'Acc_NmEn',
        'Acc_Bank_No',
        'RcpCsh_Voucher',
        'RcpChk_Voucher',
        'PymCsh_voucher',
        'PymChk_Voucher',
        'Cash_Rpt',
        'Bank_No',
        'DB_Note',
        'CR_Note',
    ];
}
