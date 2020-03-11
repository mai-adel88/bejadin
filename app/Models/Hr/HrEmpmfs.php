<?php

namespace App\Models\Hr;

use Illuminate\Database\Eloquent\Model;

class HrEmpmfs extends Model
{
    protected $table = 'hrempmfs';
    public $timestamps = true;
    protected $primaryKey = 'ID_NO';
    protected $guarded = [];
    // protected $fillable = [
    //     'Cmp_No',
    //     'Emp_Type', // CompanyEmployeeClass
    //     'Emp_No',
    //     'SubCmp_No',
    //     'Emp_SubNo',
    //     'Ownr_No',
    //     'Cntry_No',
    //     'Reljan',
    //     'Educt_Type',
    //     'Status_Type',
    //     'Gender',
    //     'Depm_No',
    //     'Loc_No',
    //     'Job_Stu',
    //     'Job_SubNo',
    //     'Job_Date',
    //     'MJob_No', 
    //     'Job_No', 
    //     'EmpType_No',
    //     'Ensurans_No',
    //     'Int_Ext',
    //     'Specl_Need',
    //     'Specl_NeedTyp',
    //     'Cnt_Period',
    //     'Blood_Type',
    //     'Emp_NmAr',
    //     'Emp_NmEn',
    //     'Emp_BarCode',
    //     'Emp_NmAr1',
    //     'Emp_NmAr2',
    //     'Emp_NmAr3',
    //     'Emp_NmAr4',
    //     'Emp_NmAr5',
    //     'Emp_NmEn1',
    //     'Emp_NmEn2',
    //     'Emp_NmEn3',
    //     'Emp_NmEn4',
    //     'Emp_NmEn5',
    //     'Birth_Plac',
    //     'Birth_Date',
    //     'Budg_typ',
    //     'Start_Date',
    //     'Start_DateHij',
    //     'On_WorkDt',
    //     'On_WorkDtHij',
    //     'Work_Expyer',
    //     'Residn_No',
    //     'Residn_Ty',
    //     'Residn_Chld',
    //     'Residn_Sdt',
    //     'Residn_Edt',
    //     'Civl_No',
    //     'Civl_Plc',
    //     'CivL_StDt',
    //     'Work_Lic',
    //     'Work_PLC',
    //     'Work_CardNo',
    //     'Work_Period',
    //     'Work_StDt',
    //     'Month_Salry',
    //     'Lic_Typ',
    //     'Lic_Sdt',
    //     'Lic_Edt',
    //     'Psprt_Rcv',  //   الجواز موجود
    //     'Pasprt_No',
    //     'Pasprt_Ty', // نوع جواز السفر enum PassportType
    //     'Pasprt_Plc', // مكان اصدار جواز السفر
    //     'Pasprt_Nt', //  جنسية جواز السفر
    //     'Pasprt_Sdt', // تاريخ اصدار جواز السفر
    //     'Pasprt_Edt', // تاريخ اصدار جواز السفر
    //     'In_Job', // وظيفة تاشيرة القدوم
    //     'In_VisaNo',
    //     'In_VisaDt',
    //     'Cnt_Endt',
    //     'Work_Endt',
    //     'In_Date',
    //     'In_EntrNo',
    //     'Out_VisaNo',
    //     'Out_VisaDt',
    //     'Out_Port',  // منفذ المغادرة
    //     'Out_Date',
    //     'Trnsfer_Dt',
    //     'Trnsfer_OLdNm',
    //     'Rcrd_LicNo',
    //     'Rcrd_LicNo1',
    //     'Rcrd_LicTyp',
    //     'Rcrd_LicTyp1',
    //     'Rcrd_Stdt',
    //     'Rcrd_Endt',
    //     'Residn_Plc',
    //     'Rcrd_EndtHij',
    //     'Rcrd_Rnwdt',
    //     'JobPLc_No',
    //     'Jobknd_No',
    //     'JobCtg_No',
    //     'JobCtg_No1',
    //     'Prev_Blnc',
    //     // 'Photo',
    //     'Notes',
    //     'Gov_Cntrct',
    //     'Under_Test',
    //     'End_Tstdt',
    //     'End_TstdtHij',
    //     'Bsc_Salary', // الراتب الاساسى
    //     'HLdy_Ty' ,// نوع الاجازة AstcHldyEarn
    //     'DueDt_HldyHij', // هجرى تاريخ استحقاق الاجازة
    //     'DueDt_Hldy', // تاريخ استحقاق الاجازة 
    //     'DueDt_Tkt', // تاريخ استحقاق التذكرة 
    //     'DueDt_TktHij', // تاريخ استحقاق التذكرة هجرى 
    //     'Start_Paid', // افتتاحى الاجازات المدفوعة يوم
    //     'Start_UnPaid', // افتتاحى الاجازات غير المدفوعة يوم
    //     // وقت استحقاق التذاكر
    //     'Tkt_Ty1', // عند الاستقدام
    //     'Tkt_Ty2', // عند الاجازة السنوية
    //     'Tkt_Ty3', // عند نهاية العقد
    //     // شروط إستحقاق التذاكر
    //     'Tkt_Ty4', // لايتم تعويض التذكرة ان لم يكن السفر فعلى 
    //     'Tkt_Ty5', // نصف تذكرة فى حالة السفر بالبر او البحر
    //     'Tkt_Ty6', // حق لنا إختيار أرخص الخطوط سواء مباشر او غير مباشر
    //     'Tkt_Ty7', // السفر الفعلى لمحرم المتعاقد 
    //     // وسيلة السفر للموظف
    //     'HldTrnsp_No', // وسلة السفر للموظف
    //     'Tkt_No', // عدد التذاكر - للموظف
    //     'Tkt_Class', // درجة التذكرة - للموظف
    //     'Tkt_Sector', // إتجاه التذكرة - للموظف
    //     // وسيلة السفر للموظف
    //     'HldTrnsp_No1', // وسلة السفر للزوجة
    //     'Tkt_No1', // عدد التذاكر - للزوجة
    //     'Tkt_Class1', // درجة التذكرة - للزوجة
    //     'Tkt_Sector1', // إتجاه التذكرة - للزوجة
    //     // وسيلة السفر للاولاد
    //     'HldTrnsp_No2', // وسلة السفر للاولاد
    //     'Tkt_No2', // عدد التذاكر - للاولاد
    //     'Tkt_Class2', // درجة التذكرة - للاولاد
    //     'Tkt_Sector2', // إتجاه التذكرة - للاولاد
    // ];

    public function company()
    {
        return $this->belongsTo(HRMainCmpnam::class, 'Cmp_No', 'Cmp_No');
    }
    public function attaches()
    {
        return $this->hasMany(HREmpAttach::class, 'Emp_No', 'Emp_No');
    }
    public function empCnt()
    {
        return $this->belongsTo(HREmpCnt::class, 'Emp_No', 'Emp_No');
    }
    public function empAdr()
    {
        return $this->belongsTo(HREmpadr::class, 'Emp_No', 'Emp_No');
    }
    public function department()
    {
        return $this->belongsTo(DepmCmp::class, 'SubCmp_No','Depm_Main');
    }
    public function country()
    {
        return $this->belongsTo(country::class, 'Cntry_No','id');
    }
    // LocClass الادارة
    public function adminstartion()
    {
        return $this->belongsTo(LocClass::class, 'Depm_No','Class_No');
    }
    //jobs الوظائف
    public function job()
    {
        return $this->belongsTo(Pyjobs::class, 'Job_No','Job_No');
    }
    //owners الكفيل
    public function owner()
    {
        return $this->belongsTo(HrOwnrmf::class, 'Ownr_No','Ownr_No');
    }
    
    
}
