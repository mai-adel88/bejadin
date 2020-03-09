<?php

namespace App\Models\Admin;
use App\Models\Admin\MainCompany;
use App\Models\Admin\AstSalesman;
use App\Models\Admin\AstMarket;
use App\Models\Admin\AstNutrbusn;
use App\Models\Admin\Astsupctg;

use Illuminate\Database\Eloquent\Model;

class MTsCustomer extends Model
{

    protected $table = 'mtscustomer';
    protected $primaryKey = 'ID_No';
    public $timestamps = true;
    protected $fillable = [
        'Cmp_No',
        'Brn_No',
        'Cstm_No',
        'Cstm_Active',  //
        'Cstm_Ctg',
        'Cstm_Refno',
        'Internal_Invoice',//
        'Acc_No',
        'Cstm_NmEn',
        'Cstm_NmAr',
        'Catg_No',
        'Slm_No',
        'Mrkt_No',
        'Nutr_No',
        'Cntry_No',
        'City_No',
        'Area_No',
        'Credit_Value',
        'Credit_Days',
        'Cstm_Adr',
        'Cstm_POBox',
        'Cstm_ZipCode',
        'Cstm_Rsp',
        'Cstm_Othr',
        'Cstm_Email',
        'Cstm_Tel',
        'Cstm_Fax',
        'Cntct_Prsn1',
        'Cntct_Prsn2',
        'Cntct_Prsn3',
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
        'Tel1',
        'Tel2',
        'Tel3',
        'Mobile',
        'Fbal_Db',
        'Fbal_CR',
        'CR11',
        'CR12',
        'CR13',
        'CR14',
        'CR15',
        'CR16',
        'CR17',
        'CR18',
        'CR19',
        'CR20',
        'CR21',
        'CR22',
        'DB11',
        'DB12',
        'DB13',
        'DB14',
        'DB15',
        'DB16',
        'DB17',
        'DB18',
        'DB19',
        'DB20',
        'DB21',
        'DB22',
        'Opn_Date',
        'Opn_Time',
        'User_ID',
        'Updt_Date',
        'Cstm_Agrmnt',
        'Disc_prct',
        'Itm_Sal',
        'Linv_No',
        'Linv_Dt',
        'Linv_Net',
        'LRcpt_No',
        'LRcpt_Dt',
        'LRcpt_Db',
        'Notes',
        'Tax_No',
        'AgeNot_Calculate',
        'Deserve_Discount'
    ];

    public function branch()
    {
        return $this->belongsTo('App\Models\Admin\MainBranch','Brn_No','ID_No');
    }

    public function company(){
        return $this->belongsTo(MainCompany::class, 'Cmp_No', 'Cmp_No');
    }

    public function country()
    {
        return $this->belongsTo('App\country','Cntry_No', 'id');
    }

    public  function  delegate()
    {
        return $this->belongsTo('App\Models\Admin\AstSalesman', 'Slm_No', 'ID_No');
    }

    public  function  supervisor()
    {
        return $this->belongsTo('App\Models\Admin\AstMarket', 'Mrkt_No', 'ID_No');
    }

    public  function  activity()
    {
        return $this->belongsTo('App\Models\Admin\AstNutrbusn', 'Nutr_No', 'ID_No');
    }

    public  function  cstmCatg()
    {
        return $this->belongsTo('App\Models\Admin\Astsupctg', 'Cstm_Ctg', 'ID_No');
    }
    public function resposiblePerson()
    {
        return $this->belongsTo('App\Models\Admin\MainCompany', 'Cstm_Rsp', 'ID_No');
    }

    public function invoices()
    {
        return $this->hasMany(InvLodhdr::class, 'Cstm_No', 'Cstm_No');
    }


}
