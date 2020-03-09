<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class InvLodhdr extends Model
{
    protected $table = 'invlodhdr';
    protected $primaryKey = 'ID_No';

    protected $fillable = [
            'Brn_No',
            'Doc_Ty',
            'Doc_No',
            'Cmp_No',
            'Actvty_No',
            'Dlv_Stor',
            'Doc_Dt',
            'Doc_DtAr',
            'status',
            'RcvngPur_Dt',
            'Pym_Dt',
            'Custm_Inv',
            'Reftyp_No',
            'Ref_No',
            'Ref_No2',
            'To_BrNO',
            'To_Store',
            'Mrkt_No',
            'Period_Time',
            'Pym_No',
            'Slm_No',
            'City_No',
            'Cstm_No',
            'Sup_No',
            'Sup_Inv',
            'SubCstm_Filno',
            'Notes',
            'Curncy_No',
            'ExchangeRate',
            'Tot_Sal',
            'Tot_Pur',
            'Tot_Cost',
            'Tot_Disc',
            'Tot_Prct',
            'Tot_ODisc',
            'Tot_OPrct',
            'Tot_Disc2',
            'Tot_Prct2',
            'Tot_customs',
            'Tot_Expens',
            'Tot_Exp',
            'Net',
            'Paid',
            'Credit',
            'Return_Mony',
            'Bonus_val',
            'FcTot_Sal',
            'FcTot_Pur',
            'FcTot_Cost',
            'FcTot_Disc',
            'FcTot_ODisc',
            'FcNet',
            'SExpens',
            'Expens1',
            'Expens2',
            'Expens3',
            'Expens4',
            'Expens5',
            'Expens6',
            'Expens7',
            'Sup_VchrNo',
            'Credit_Days',
            'Dlv_Ord_No',
            'Ret_Status',
            'JV_No',
            'Ac_Ty',
            'Doc_Procs',
            'Doc_Post',
            'Rcpt_Value',
            'Print_No',
            'Tpur_Exp',
            'Tothr_Price',
            'Acc_InvAdj',
            'SpecialDiscount',
            'CashInvoice',
            'SpecialDiscountInvoice',
            'Notes1',
            'Taxp_ExtraHdr',
            'Taxv_ExtraHdr',
            'Tax_Allow',
            'AfterDiscount',
            'Tax_Acc',
            'User_Id',
            'Doc_Time',
            'updt_date',

    ];

    public function details()
    {
        return $this->hasMany(InvLoddtl::class, 'Doc_No', 'Doc_No');
    }

    public function customer()
    {
        return $this->belongsTo(MTsCustomer::class, 'Cstm_No', 'Cstm_No');
    }

    public function branch()
    {
        return $this->belongsTo(MainBranch::class, 'Brn_No', 'Brn_No');
    }

    public function company()
    {
        return $this->belongsTo(MainCompany::class, 'Cmp_No', 'Cmp_No');
    }

    public function store()
    {
        return $this->belongsTo(PjbranchDlv::class, 'Dlv_Stor', 'ID_No');
    }
}
