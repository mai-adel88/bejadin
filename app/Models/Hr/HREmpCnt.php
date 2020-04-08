<?php

namespace App\Models\Hr;

use Illuminate\Database\Eloquent\Model;

class HREmpCnt extends Model
{

    protected $table = 'hr_emp_cnt';
    protected $primaryKey = 'ID_No';
    public $timestamps = true;
    protected $fillable = [
        'Cmp_No',
        'Emp_Type',         //تصنيف العماله
        'Emp_No',           //رقم الموظف
        'SubCmp_No',        //القسم
        'Emp_SubNo',        //رقم الموظف بالقسم
        'Depm_No',          //الإدارة
        'Job_Stu',          //الحالة الوظيفيه
        'Job_No',           //الوظيفة
        'Job_Date',         //تاريخ الحالة الوظيفية
        'Shift_Type',       //نوع الدوام
        'Salary_Class_No',  //تصنيف الراتب
        'Huspym_No',        //دفع بدل السكن
        'HusTyp_No',        //تصنيف السكن
        'Gender',           //1=ذكر
        'Specl_Need',       //1= طبيعى 	2=احتياجات خاصة
        'Specl_NeedTyp',    //نوع الاحتياجات الخاصة
        'Cntry_No',         //الجنسية
        'Reljan',           //الديانه
        'Job_SubNo',        //تخصص الوظيفة للموظف
        'Pymnt_No',         //طريقة دفع الراتب
        'Cnt_Period',       //مدة العقد
        'Emp_NmAr',         //اسم الموظف -AR
        'Emp_NmEn',
        'Bsc_Salary',       //راتب اساسى
        'Hous_Alw',         //بدل سكن
        'Trnsp_Alw',        //بدل انتقال
        'Food_Alw',         //بدل طعام
        'Other_Alw',        //بدلات أخرى
        'Add_Alw',          //اضافى ثابت
        'ALw1',             //بدل تخصص
        'ALw2',             //بدل سلامه
        'ALw3',             //بدل  طبيعة عمل
        'ALw4',             //بدل سيارة
        'ALw5',             //بدل موبيل
        'Gross_Salary',     //اجمالى الراتب المستحق
        'Wrk_Hour',         //عدد ساعات العمل/يوم
        'Wrk_CostHour',     //ثابت /تكلفة ساعة العمل
        'Total_Wrk_CostHour',//إجمالي /تكلفة ساعة العمل
        'Wrk_OvrTime',      //يحسب له اضافى 	1 =له اضافى
        'OvrTime_Rate',      //معدل الاضافى
        'OvrTime_HR1',      //اضافى ثابت مقابل عدد ساعات /يوم
        'OvrTime_HR2',      //اضافى ثابت مقابل عدد  ساعات بالاسبوع
        'OvrTime_HR3',      //عدد ساعات العمل/أسبوع
        'Lunch_hour',       //ساعات الراحه
        'Cnt_Stdt',         //بداية التعاقد
        'Cnt_StdtHij',      //هـ
        'Cnt_Endt',         //نهاية التعاقد
        'Cnt_EndtHij',      //هـ
        'Cnt_Nwdt',         //تجديد التعاقد
        'Cnt_NwdtHij',      //هـ
        'Start_Date',       //تاريخ التعين
        'Start_DateHij',    //هـ
        'On_WorkDt',        //تاريخ مباشرة العمل
        'On_WorkDtHij',     //هـ
        'Dection_ExpireDt', //تاريخ زيادة الراتب التاليه
        'Bouns_Prct',       //بونص % للمبيعات
        'Car_No',           //رقم السيارة
        'Start_Paid',       //افتتاحى الاجازات المدفوعه/يوم
        'Start_UnPaid',     //افتتاحى الاجازات الغير مدفوعه/يوم
        'Fbal_Db',
        'Fbal_CR',
        'Acc_NoDb1',        //حساب ذمم الموظفين
        'Acc_Loans',        //حساب سلف الموظفين
        'Bnk_No',           //البنك للشركة
        'Sub_Bnk',          //البنك للموظف
        'BnkEmp_Acntno',    //رقم حساب الموظف بالبنك
        'Bnk_Acntno',       //رقم حساب  البنك
        'Prj_No',           //رقم المشروع (مكان العمل)
        'Loc_No',
        'PjLoc_No',         //مكان العمل بالمشروع(فرعى)
        'Gov_Cntrct',       //رقم العقد-الحكومى
        'DueDt_Hldy',       //تاريخ  استحاق الاجازة
        'HLd_Period',       //مدة الاجازه
        'DueDt_HldyHij',    //هـ
        'DueDt_Tkt',        //تاريخ  استحاق التذكرة
        'DueDt_TktHij',     //هـ
        'HLdy_Ty',          //نوع استحقاق الاجازة
        'HldTrnsp_No',      //وسلة السفر للموظف
        'Tkt_No',           //عدد التذاكر - للموظف
        'Tkt_Class',        //درجة التذكرة - للموظف
        'Tkt_Sector',       //إتجاه التذكرة - للموظف
        'HldTrnsp_No1',     //وسيلة السفر للزوجه
        'Tkt_No1',          //عدد تذاكر -الزوجه
        'Tkt_Class1',       //درجة التذكرة - الزوجه
        'Tkt_Sector1',      //اتجاه التذكرة -للزوجه
        'HldTrnsp_No2',     //وسيلة السفر للأولاد
        'Tkt_No2',          //عدد تذاكر -الأولاد
        'Tkt_Class2',       //درجة التذكرة - للأولاد
        'Tkt_Sector2',      //اتجاه  التذكرة  - للأولاد
        'Tkt_Ty1',          //وقت استحقاق التذكرة-عند الاستقدام
        'Tkt_Ty2',          //وقت استحقاق التذكرة-عند الاجازة السنوية
        'Tkt_Ty3',          //وقت استحقاق التذكرة-عند نهاية العقد
        'Tkt_Ty4',          //شروط إستحقاق التذاكر-لايتم تعويض التذكرة ان لم يكن السفر فعلى
        'Tkt_Ty5',          //شروط إستحقاق التذاكر-نصف تذكرة فى حالة السفر بالبر او البحر
        'Tkt_Ty6',          //شروط إستحقاق التذاكر-يحق لنا إختيار أرخص الخطوط سواء مباشر او غير مباشر
        'Tkt_Ty7',          //شروط إستحقاق التذاكر-السفر الفعلى لمحرم المتعاقد
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
    ];


    public function vacation()
    {
        return $this->hasOne(HREmphld::class, 'Emp_No', 'Emp_No');
    }

}
