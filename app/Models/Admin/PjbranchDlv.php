<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class PjbranchDlv extends Model
{
    protected $table = 'pjbranchdlv';
    protected $primaryKey = 'ID_No';

    protected $fillable = ['Brn_No', 'Dlv_Stor', 'Dlv_NmAr', 'Dlv_NmEn'];

    public function branch(){
        return $this->belongsTo(MainBranch::class, 'Brn_No', 'Brn_No');
    }

    public function invoices()
    {
        return $this->hasMany(InvLodhdr::class, 'Dlv_Stor', 'ID_No');
    }
}
