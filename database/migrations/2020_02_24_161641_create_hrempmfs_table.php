<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHrempmfsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hrempmfs', function (Blueprint $table) {
            $table->increments('ID_NO');
            $table->smallInteger('Cmp_No')->nullable();
            $table->enum('Emp_Type',[1,2,3])->nullable(); // CompanyEmployeeClass
            $table->bigInteger('Emp_No')->nullable();
            $table->smallInteger('SubCmp_No')->nullable();
            $table->bigInteger('Emp_SubNo')->nullable();
            $table->smallInteger('Ownr_No')->nullable();
            $table->smallInteger('Cntry_No')->nullable();
            $table->enum('Reljan',[1,2,3,4])->nullable(); // HrReligion
            $table->enum('Educt_Type',[1,2,3,4,5,6,7,8,9,10])->nullable();
            $table->enum('Status_Type',[1,2,3,4,5])->nullable();
            $table->enum('Gender',[1,2])->nullable(); // النوع
            $table->smallInteger('Depm_No')->nullable();
            $table->bigInteger('Loc_No')->nullable();
            $table->enum('Job_Stu',[1,2,3,4,5,6,7])->nullable();
            $table->smallInteger('Job_SubNo')->nullable();
            $table->string('Job_Date')->nullable();
            $table->smallInteger('MJob_No')->nullable(); // enum
            $table->enum('EmpType_No',[1,2,3,4,5,6])->nullable(); // enum
            $table->bigInteger('Ensurans_No')->nullable();
            $table->smallInteger('Int_Ext')->nullable();
            $table->smallInteger('Specl_Need')->nullable();
            $table->enum('Specl_NeedTyp',[1,2,3])->nullable();
            $table->smallInteger('Cnt_Period')->nullable();
            $table->string('Blood_Type', 6)->nullable();
            $table->string('Emp_NmAr', 100)->nullable();
            $table->string('Emp_NmEn', 100)->nullable();
            $table->string('Emp_BarCode', 20)->nullable();
            $table->string('Emp_NmAr1', 20)->nullable();
            $table->string('Emp_NmAr2', 20)->nullable();
            $table->string('Emp_NmAr3', 20)->nullable();
            $table->string('Emp_NmAr4', 20)->nullable();
            $table->string('Emp_NmAr5', 20)->nullable();
            $table->string('Emp_NmEn1', 20)->nullable();
            $table->string('Emp_NmEn2', 20)->nullable();
            $table->string('Emp_NmEn3', 20)->nullable();
            $table->string('Emp_NmEn4', 20)->nullable();
            $table->string('Emp_NmEn5', 20)->nullable();
            $table->string('Birth_Plac', 15)->nullable();
            $table->string('Birth_Date', 10)->nullable();
            $table->smallInteger('Budg_typ')->nullable();
            $table->string('Start_Date', 10)->nullable(); // تاريخ التعيين
            $table->string('Start_DateHij', 10)->nullable(); // تاريخ التعيين هجرى
            $table->string('On_WorkDt', 10)->nullable();
            $table->string('On_WorkDtHij', 10)->nullable();
            $table->string('Work_Expyer', 6)->nullable();
            $table->string('Residn_No', 15)->nullable();
            $table->enum('Residn_Ty',[1,2,3,4,5])->nullable();
            $table->string('Residn_Chld', 2)->nullable();
            $table->string('Residn_Sdt', 10)->nullable();
            $table->string('Residn_Edt', 10)->nullable();
            $table->string('Civl_No', 20)->nullable();
            $table->smallInteger('Civl_Plc')->nullable();
            $table->string('CivL_StDt', 10)->nullable();
            $table->string('Work_Lic', 15)->nullable(); // ملف مكتب العمل
            $table->smallInteger('Work_PLC')->nullable();
            $table->string('Work_CardNo', 20)->nullable();
            $table->string('Work_Period', 20)->nullable();
            $table->string('Work_StDt', 10)->nullable();
            $table->integer('Month_Salry')->nullable();
            //$table->integer('Bsc_Salary')->nullable();
            $table->smallInteger('Lic_Typ')->nullable(); // enum
            $table->string('Lic_Sdt', 10)->nullable();
            $table->string('Lic_Edt', 10)->nullable();
            $table->smallInteger('Psprt_Rcv')->nullable();
            $table->string('Pasprt_No', 15)->nullable();
            $table->enum('Pasprt_Ty',[1,2,3,4,5])->nullable(); // enum HrAstTypPasprt
            $table->string('Pasprt_Plc', 50)->nullable();
            $table->string('Pasprt_Nt', 10)->nullable();
            $table->string('Pasprt_Sdt', 10)->nullable();
            $table->string('Pasprt_Edt', 10)->nullable();
            $table->smallInteger('In_Job')->nullable();
            $table->string('In_VisaNo', 20)->nullable();
            $table->string('In_VisaDt', 10)->nullable();
            $table->string('In_Date',10)->nullable();
            $table->string('In_EntrNo',20)->nullable();
            $table->string('Out_VisaNo',20)->nullable();
            $table->string('Out_VisaDt',10)->nullable();
            $table->smallInteger('Out_Port')->nullable(); //منفذ المغادرة 
            $table->string('Out_Date',10)->nullable();
            $table->string('Trnsfer_Dt',10)->nullable();
            $table->string('Trnsfer_OLdNm',100)->nullable();
            $table->string('Rcrd_LicNo',50)->nullable();
            $table->string('Rcrd_LicNo1',20)->nullable();
            $table->string('Rcrd_LicTyp',20)->nullable();
            $table->string('Rcrd_LicTyp1',20)->nullable();
            $table->string('Rcrd_Stdt',10)->nullable();
            $table->string('Rcrd_Endt',10)->nullable();
            $table->string('Rcrd_EndtHij',10)->nullable();
            $table->string('Rcrd_Rnwdt',10)->nullable();
            $table->smallInteger('JobPLc_No')->nullable();
            $table->smallInteger('Jobknd_No')->nullable();
            $table->smallInteger('JobCtg_No')->nullable();
            $table->smallInteger('JobCtg_No1')->nullable();
            $table->integer('Prev_Blnc')->nullable();
            // $table->string('Photo')->nullable();
            $table->string('Notes')->nullable();
            $table->integer('Gov_Cntrct')->nullable();
            $table->string('Under_Test', 2)->nullable();
            $table->string('End_Tstdt', 10)->nullable();
            $table->string('End_TstdtHij', 10)->nullable();
            // // الاجازات HREmphld
            // $table->integer('HLdy_Ty')->nullable(); // AstcHldyEarn نوع استحقاق الاجازة
            // $table->integer('DueDt_Hldy')->nullable(); //  تاريخ استحقاق الاجازة
            // $table->integer('DueDt_HldyHij')->nullable(); //  تاريخ استحقاق الاجازة هجرى
            // $table->integer('DueDt_Tkt')->nullable(); //  تاريخ استحقاق التذكرة
            // $table->integer('DueDt_TktHij')->nullable(); //   هجرى تاريخ استحقاق التذكرة
            // // وقت استحقاق التذاكر
            // $table->integer('Tkt_Ty1')->nullable(); //   عند الاجازة السنوية
            // $table->integer('Tkt_Ty2')->nullable(); //   عند الاستقدام
            // $table->integer('Tkt_Ty3')->nullable(); //   عند نهاية العقد
            // // شروط إستحقاق التذاكر
            // $table->integer('Tkt_Ty4')->nullable(); //   لايتم تعويض التذكرة ان لم يكن السفر فعلى
            // $table->integer('Tkt_Ty5')->nullable(); //   نصف تذكرة فى حالة السفر بالبر او البحر
            // $table->integer('Tkt_Ty6')->nullable(); //   حق لنا إختيار أرخص الخطوط سواء مباشر او غير مباشر
            // $table->integer('Tkt_Ty7')->nullable(); //   السفر الفعلى لمحرم المتعاقد
            // // HrHldTrnsp وسلة السفر
            // // للموظف وسلة السفر
            // $table->smallInteger('HldTrnsp_No')->nullable(); // وسلة السفر للموظف
            // $table->smallInteger('Tkt_No')->nullable(); // عدد التذاكر - للموظف
            // $table->string('Tkt_Class', 15)->nullable(); // درجة التذكرة - للموظف
            // $table->string('Tkt_Sector', 50)->nullable(); // إتجاه التذكرة - للموظف
            // // HldTrnsp_No1 وسلة السفر للزوجة
            // $table->smallInteger('HldTrnsp_No1')->nullable(); // وسلة السفر للزوجة
            // $table->smallInteger('Tkt_No1')->nullable(); // عدد التذاكر - الزوجة
            // $table->string('Tkt_Class1', 5)->nullable(); // درجة التذكرة - للزوجة
            // $table->string('Tkt_Sector1', 30)->nullable(); // إتجاه التذكرة - للزوجة
            // // HldTrnsp_No1 وسلة السفر للاولاد
            // $table->smallInteger('HldTrnsp_No2')->nullable(); // وسلة السفر للزوجة
            // $table->smallInteger('Tkt_No2')->nullable(); // عدد التذاكر - الزوجة
            // $table->string('Tkt_Class2', 5)->nullable(); // درجة التذكرة - للزوجة
            // $table->string('Tkt_Sector2', 30)->nullable(); // إتجاه التذكرة - للزوجة
            // // التعاقد
            // $table->integer('Bsc_Salary')->nullable(); // Bsc_Salary الراتب الاساسى
            // $table->integer('Add_Alw')->nullable(); // اضافى ثابت
            $table->string('Cnt_Endt')->nullable();
            $table->integer('Job_No')->nullable(); // pyjobs [Job_No] الوظيفة
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hrempmfs');
    }
}
