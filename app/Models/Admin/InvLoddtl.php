<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class InvLoddtl extends Model
{
    protected $table = 'invloddtl';
    protected $primaryKey = 'ID_No';

    protected $fillable = [
            'Brn_No',
            'Doc_Ty',
            'Cmp_No',
            'Actvty_No',
            'Doc_No',
            'Ln_No',
            'Dlv_Stor',
            'Doc_Dt',
            'Doc_DtAr',
            'Custm_Inv',
            'Reftyp_No',
            'Ref_No',
            'Pym_No',
            'To_BrNO',
            'To_Store',
            'Mrkt_No',
            'Period_Time',
            'Slm_No',
            'Ac_Ty',
            'City_No',
            'Cstm_No',
            'Sup_No',
            'Catg_No',
            'Kind_No',
            'Itm_No',
            'Loc_No',
            'Itm_RefNo',
            'Unit_No',
            'UnitLn_No',
            'Unit_ratio',
            'Qty',
            'Dlv_Qty',
            'Exp_Date',
            'Batch_No',
            'Itm_Cost',
            'Itm_Sal',
            'Itm_Pur',
            'Titm_Cost',
            'Titm_Sal',
            'Titm_Pur',
            'Tot_Expens',
            'Disc1_Val',
            'Disc2_Val',
            'Othr_Disc',
            'Disc1_Prct',
            'Disc2_Prct',
            'Itm_SalSubUnt',
            'Itm_SalSubUnt2',
            'Itm_SalSubUnt3',
            'Bonus_Qty',
            'Bonus_Val',
            'Bonus_Prct',
            'BonusPur_Qty',
            'BonusPur_Val',
            'BonusPur_Prct',
            'DiscSal_Prct',
            'DiscSal2_prct',
            'BonusSalCrdt_Prct',
            'BonusSalCash_Prct',
            'Itm_Rcpt_Hold',
            'Customs_Prct',
            'Customs',
            'FcItm_Sal',
            'FcItm_Pur',
            'FcTitm_Cost',
            'FcTitm_Sal',
            'FcTitm_Pur',
            'SExpens',
            'Pur_Exp',
            'Ret_Qty',
            'Ret_Val',
            'Ret_Uprice',
            'Lc_No',
            'SpecialDiscount',
            'Taxp_ExtraDtl',
            'Taxv_ExtraDtl',
            'Doc_Post',
            'updt_date',
            'User_Id',

    ];

    public function header() 
    {
        return $this->belongsTo(InvLodhdr::class, 'Doc_No', 'Doc_No');
    }
}
