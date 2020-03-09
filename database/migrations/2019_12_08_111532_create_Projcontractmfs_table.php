<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjcontractmfsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projcontractmfs', function (Blueprint $table) {
            $table->increments('ID_No');
            $table->integer('Cmp_No')->nullable()->unsigned()->index();//رقم الشركه
            $table->bigInteger('Cntrct_No')->nullable();//رقم العقد
            $table->integer('Rvisd_No')->nullable();// نسخة العقد
            $table->boolean('Cntrct_Actv')->nullable(); //العقد فعال 1 فعال    ---   2 غير فعال
            $table->dateTime('Tr_Dt')->nullable();//تاريخ العقد
            $table->dateTime('Tr_DtAr')->nullable();//التاريخ بالهجرى
            $table->bigInteger('Prj_No')->nullable();//  رقم المشروع
            $table->integer('Prj_Year')->nullable();// سنة المشروع
            $table->integer('Prj_Stus')->nullable();//حالة المشروع
            $table->bigInteger('Cstm_No')->nullable();//رقم العميل
            $table->string('Cnt_Refno')->nullable();//المرجع للعقد
            $table->string('Cnt_Dt')->nullable();//تاريخ التعاقد
            $table->string('CntStrt_Dt')->nullable(); // بداية العقد
            $table->string('CntCompl_Dt')->nullable();//نهاية العقد
            $table->string('CntCompL_Priod')->nullable();//مدة العقد/شهر
            $table->string('Inst_Dt')->nullable();//بدء التنفيذ
            $table->string('Comisn_Dt')->nullable();//إنتهاء التنفيذ
            $table->string('Wrntstrt_dt')->nullable();//بدء الضمان
            $table->string('Wrntend_Dt')->nullable();//انتهاء الضمان
            $table->float('Acc_DB')->nullable();//حساب المصاريف للمشاريع
            $table->float('Acc_CR')->nullable();//حساب الإيرادات  للمشاريع
            $table->float('Comitd_Cost', 50, 10)->nullable();//حد التكلفة
            $table->float('Actul_Cost', 50, 10)->nullable();//تكلفة فعليه
            $table->float('Cnt_Vl', 50, 10)->nullable();//قيمة العقد
            $table->float('Cnt_Bdgt', 50, 10)->nullable();//القيمة التقديرية للعقد
            $table->float('Cntrb_VL', 50, 10)->nullable();//نسبة الانحراف
            $table->float('Cntrb_Prct', 50, 10)->nullable();// نسبة الانحراف %
            $table->float('Gnrlovhd_VaL', 50, 10)->nullable();//مصاريف الإدارة
            $table->float('Gnrlovhd_Prct', 50, 10)->nullable();//% مصاريف الإدارة
            $table->float('Dprtmovhd_Vl', 50, 10)->nullable();//مصاريف الأقسام
            $table->float('Dprtmovhd_Prct', 50, 10)->nullable();//% مصاريف الأقسام
            $table->float('Wrnt_Prct', 50, 10)->nullable();//% فترة الضمان
            $table->float('Fince_Prct', 50, 10)->nullable();//% مصاريف المالية
            $table->float('Subtot_VaL', 50, 10)->nullable();//إجمالي فرعى
            $table->float('Subtot_Prct', 50, 10)->nullable();//% الاجمالى الفرعى
            $table->float('Netcntrib_VaL', 50, 10)->nullable();//صافى الانحراف
            $table->float('Netcntrib_Prct', 50, 10)->nullable();//% صافى الانحراف
            $table->float('Tot_Rcpt', 50, 10)->nullable();//اجمالى التحصيل
            $table->float('Balance', 50, 10)->nullable();//الرصيد  الحالي
            $table->string('Bnkgrnt_No')->nullable();//رقم الضمان البنكى
            $table->string('Bnkgrnt_IsudByAr')->nullable();//الضمان صادر من AR
            $table->string('Bnkgrnt_IsudByEn')->nullable();//الضمان صادر من en

            $table->float('Bnkgrnt_Amount', 50, 10)->nullable();//مبلغ الضمان
            $table->float('Insurnc_Comprehensive', 50, 10)->nullable();//تأمين شامل ضدر المسؤلية العامة
            $table->float('Insurnc_Contractors', 50, 10)->nullable();//تأمين المقاول ضد كل الاخطار
            $table->float('DwnPym', 50, 10)->nullable();//الدفعة الأولى
            $table->float('Dposit', 50, 10)->nullable();//الوديعة(الضمان)
            $table->float('AdtionalWk', 50, 10)->nullable();//أعمال اضافيه
            $table->float('WkDedction', 50, 10)->nullable();//خصم العمل
            $table->float('SitDedction', 50, 10)->nullable();//خصم الموقع
            $table->string('NofEmp' )->nullable();//عدد الموظفين
            $table->float('Emp_Hur', 50, 10)->nullable();//ساعة /للموظف
            $table->float('NofMonths', 50, 10)->nullable();//عدد الشهور
            $table->float('Mnthly_Pyment', 50, 10)->nullable();//الدفعة الشهرية
            $table->string('Cnt_DscAr')->nullable();//وصف العقد Ar
            $table->string('Cnt_DscEn')->nullable();//وصف العقد En
            $table->string('Brn_No')->nullable();//رقم الفرع
            $table->string('Tr_Post')->nullable();//
            $table->string('Opn_Date')->nullable();//تاريخ تسجيل
            $table->string('Opn_Time')->nullable();//وقت تسجيل
            $table->integer('User_ID')->nullable();//مين اللى سجل
            $table->datetime('Updt_Date')->nullable();// تاريخ اتلعديل
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
        Schema::dropIfExists('mts_costcntrs');
    }
}
