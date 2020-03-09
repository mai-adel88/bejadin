<?php

namespace App\Models\Admin;

use App\Models\Admin\MainCompany;
use Illuminate\Database\Eloquent\Model;
use App\Admin;

class MainBranch extends Model
{
    protected $table = 'mainbranch';
    protected $primaryKey = 'ID_No';
    protected $fillable = [
        'Cmp_No',
        'Brn_No',
        'Main_Brn',
        'Dlv_Stor',
        'Actvty_No',
        'Isue_Alinvc',
        'Allow_StoreTrs',
        'Br_Ty',
        'Brn_NmEn',
        'Brn_NmAr',
        'Brn_Tel',
        'Brn_Adrs',
        'Brn_Email',
        'Acc_Cashier',
        'Acc_Customer',
        'Acc_Customer1',
        'Acc_Suplier',
        'Acc_Suplier1',
        'Acc_Suplier2',
        'Acc_Sales',
        'Acc_RetSal',
        'Csh_SalAcc',
        'Csh_RetsalAcc',
        'Csh_CshSalDiscAcc',
        'Cmp_PurchaseAcc',
        'Cmp_RetPurchAcc',
        'Cmp_CshPurDiscAcc',
        'Agnt_PurchaseAcc',
        'Agnt_RetPurchAcc',
        'Agnt_CshPurDiscAcc',
        'DlyPst_CshSal',
        'DlyPst_CshPur',
        'Adv_SalAcc',
        'Adv_RetSalAcc',
        'Acc_Invtry',
        'Csh_PurAcc',
        'Inv_Prdctn',
        'Inv_Undprs',
        'Inv_RM',
        'Cost_INVt',
        'Cost_SalInvt',
        'Csh_RetPurAcc',
        'Acc_InvAdj',
        'Acc_Cashier1',
        'Acc_Cashier2',
        'Acc_Cashier3',
        'Acc_TaxExtraDb',
        'Acc_TaxExtraCR',
    ];

    public function admin(){
        return $this->hasMany(Admin::class, 'id', 'ID_No');
    }

    public function company(){
        return $this->belongsTo(MainCompany::class, 'Cmp_No', 'Cmp_No');
    }

    public function stores(){
        return $this->hasMany(PjbranchDlv::class, 'Brn_No', 'ID_No');
    }

    public function invoices()
    {
        return $this->hasMany(InvLodhdr::class, 'Brn_No', 'Brn_No');
    }
}
