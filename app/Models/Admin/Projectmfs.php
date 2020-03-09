<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Projectmfs extends Model
{

    protected $table = 'projectmfs';
    protected $primaryKey ='ID_No';
    public $timestamps = true;
    protected $fillable = [
        'Cmp_No',
        'Prj_No',
        'Prj_Parnt',    //المشروع الرئيسى
        'Level_Status', //رئيسى /فرعى
        'Level_No',     //رقم المستوى
        'Costcntr_No',  //رقم مركز التكلفه
        'Prj_Actv',     //المشروع  فعال
        'Prj_Year',     //سنة المشروع
        'Prj_Status',   //وضع المشروع
        'Tr_Dt',        //تاريخ المشروع
        'Tr_DtAr',      //هجري
        'Prj_NmAr',     //وصف المشروع AR
        'Prj_NmEn',
        'Prj_Refno',    //المرجع للمشروع
        'Prj_Categ',    //فئة المشروع
        'Prj_Value',    //قيمة المشروع
        'Cstm_No',      //رقم العميل
        'Slm_No',       //مندوب المبيعات
        'Country_No',   //
        'City_No',
        'Area_No',
        'Acc_DB',       //حساب المصاريف للمشاريع
        'Acc_CR',       //حساب الايرادات للمشاريع
        'FBal_DB',      //اول المدة مدين
        'FBal_CR',      //اول المدة دائن
        'DB11',
        'DB12',
        'DB13',
        'DB14',
        'DB15',
        'DB16',
        'DB17',
        'DB18',
        'DB20',
        'DB21',
        'DB22',
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
        'Brn_No',       //رقم الفرع للمشروع
        'Dlv_Stor',     //رقم المستودع للمشروع
        'Ordr_Value',   //قيمة التوريد
        'Ordr_No',      //امر التوريد
        'Ordr_Dt',      //تاريخ التعميد
        'Prj_Adr',      //عنوان المشروع
        'Prj_Tel',      //هاتف المشروع
        'Prj_Mobile',   //موبيل المشروع
        //'Prj_Mobile1',  //موبيل المشروع
        //'Nxt_Vst',      //الزيارة القادمة
        'Mnth_Year',    //سنة/شهر
        'Cntct_Prsn1',  //الشخص المسئول
        'Cntct_Prsn2',
        'TitL1',        //الوظيفه
        'TitL2',
        'Mobile1',      //الموبايل
        'Mobile2',
        'Email1',       //البريد الالكتروني
        'Email2',
        'Opn_Date',     //تاريخ تسجيل
        'Opn_Time',     //وقت تسجيل
        'User_ID',      //مين اللى سجل
        'Updt_Date'     //تاريخ التعديل

    ];

    public function parent(){
        return $this->hasOne(Projectmfs::class, 'Prj_No','Prj_Parnt');
    }

    public function children(){
        return $this->hasMany(Projectmfs::class, 'Prj_Parnt', 'Prj_No');
    }
    public function country()
    {
        return $this->belongsTo('App\country','Country_No', 'id');
    }

    public function city()
    {
        return $this->belongsTo('App\city','City_No', 'id');
    }

    public function branch()
    {
        return $this->belongsTo('App\Models\Admin\MainBranch','Brn_No','ID_No');
    }

    public function costCenter()
    {
        return $this->belongsTo('App\Models\Admin\MtsCostcntr','Costcntr_No','ID_No');
    }

}
