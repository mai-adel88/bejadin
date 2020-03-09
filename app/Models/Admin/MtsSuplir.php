<?php

namespace App\Models\Admin;

use App\country;
use Illuminate\Database\Eloquent\Model;

class MtsSuplir extends Model
{
    protected $table = 'mts_suplirs';
    protected $primaryKey = 'ID_No';
    protected $fillable = [
        'Cmp_No',
        'Brn_No',
        'Sup_No',
        'Sup_Refno',
        'SupCtg_No',
        'Cntry_No',
        'Sup_NmEn',
        'Sup_NmAr',
        'Sup_Adr',
        'Sup_Rsp',
        'Sup_Othr',
        'Curncy_No',
        'Sup_Email',
        'Sup_Tel1',
        'Sup_Tel2',
        'Mobile',
        'Sup_Fax',
        'Acc_No',
        'Credit_Value',
        'Credit_Days',
        'Fbal_Db',
        'Fbal_CR',
        'TradeOffer',
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
        'Updt_Date',
        'User_ID',
        'Tax_No',
        'Opn_Date',
        'Opn_Time',
        'note',

        'Cntct_Prsn1',
        'Cntct_Prsn2',
        'Cntct_Prsn3',
        'Cntct_Prsn4',
        'Cntct_Prsn5',

        'TitL1',
        'TitL2',
        'TitL3',
        'TitL4',
        'TitL5',

        'Mobile1',
        'Mobile2',
        'Mobile3',
        'Mobile4',
        'Mobile5',

        'Email1',
        'Email2',
        'Email3',
        'Email4',
        'Email5',

        'Linv_No',
        'Linv_Dt',
        'Linv_Net',
        'LRcpt_No',
        'LRcpt_Dt',
        'LRcpt_Db',

        'Sup_Active',
        'CBal',
        'TradeOffer',

        'Cstm_POBox',
        'Cstm_ZipCode',

    ];

    public function branches(){
        return $this->belongsTo(MainBranch::class, 'Brn_No', 'ID_No');
    }
    public function company(){
        return $this->belongsTo(MainCompany::class, 'Cmp_No', 'ID_No');
    }
    public function country(){
        return $this->belongsTo(country::class, 'Cntry_No', 'id');
    }
    public function SupCtg(){
        return $this->belongsTo(Astsupctg::class, 'SupCtg_No', 'ID_No');
    }
}
