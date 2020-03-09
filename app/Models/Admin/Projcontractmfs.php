<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\MainBranch;
use App\Models\Admin\Projectmfs;
use App\Models\Admin\MTsCustomer;

class Projcontractmfs extends Model
{
    protected $table = 'projcontractmfs';
    protected $primaryKey = 'ID_No';
    protected $fillable = [
        'Cmp_No',
        'Cntrct_No',
        'Rvisd_No',
        'Cntrct_Actv',
        'Tr_Dt',
        'Tr_DtAr',
        'Prj_No',
        'Prj_Year',
        'Prj_Stus',
        'Cstm_No',
        'Cnt_Refno',
        'Cnt_Dt',
        'CntStrt_Dt',
        'CntCompl_Dt',
        'CntCompL_Priod',
        'Inst_Dt',
        'Comisn_Dt',
        'Wrntstrt_dt',
        'Wrntend_Dt',
        'Acc_DB',
        'Acc_CR',
        'Comitd_Cost',
        'Comitd_Cost',
        'Actul_Cost',
        'Cnt_Vl',
        'Cnt_Bdgt',
        'Cntrb_VL',
        'Cntrb_Prct',
        'Gnrlovhd_VaL',
        'Gnrlovhd_Prct',
        'Dprtmovhd_Vl',
        'Dprtmovhd_Prct',
        'Wrnt_Prct',
        'Wrnt_Prct',
        'Fince_Prct',
        'Subtot_VaL',
        'Subtot_Prct',
        'Netcntrib_VaL',
        'Netcntrib_Prct',
        'Tot_Rcpt',
        'Balance',
        'Bnkgrnt_No',
        'Bnkgrnt_IsudByAr',
        'Bnkgrnt_IsudByEn',
        'Bnkgrnt_Amount',
        'Insurnc_Comprehensive',
        'Insurnc_Contractors',
        'DwnPym',
        'Dposit',
        'AdtionalWk',
        'WkDedction',
        'SitDedction',
        'NofEmp',
        'Emp_Hur',
        'NofMonths',
        'Mnthly_Pyment',
        'Cnt_DscAr',
        'Cnt_DscEn',
        'Brn_No',
        'Tr_Post',
        'Opn_Date',
        'Opn_Time',
        'User_ID',
        'Updt_Date',
    ];

    public function branshe(){
        return $this->hasMany('App\Models\Admin\MainBranch','ID_No','Brn_No');
    }
    public function project(){
        return $this->hasMany('App\Models\Admin\Projectmfs','ID_No','Prj_No');
    }
    public function subscriber(){
        return $this->hasMany('App\Models\Admin\MTsCustomer','ID_No','Cstm_No');
    }
}
