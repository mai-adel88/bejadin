<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGLJrnalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('GLJrnal', function (Blueprint $table) {
            $table->increments('ID_No');
            $table->integer('Cmp_No')->nullable();//الشركه
            $table->integer('Brn_No')->nullable();//الفرع
            $table->integer('Jr_Ty')->nullable();//نوع القيد
            // $table->enum('noti_Ty', [1,2])->nullable(); //نوع الاشعار
            $table->bigInteger('Tr_No')->nullable();//رقم القيد
            $table->integer('Month_No')->nullable();//رقم الشهر
            $table->integer('Month_Jvno')->nullable();//رقم القيد\الشهر
            $table->enum('Doc_Type', [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16])->nullable();//نوع المستند
            $table->datetime('Tr_Dt')->nullable();//تاريخ القيد
            $table->string('Tr_DtAr')->nullable();//تاريخ القيد هجرى
            $table->string('Chq_no')->nullable();//رقم الشيك
            $table->string('Bnk_Nm')->nullable();//اسم البنك
            $table->datetime('Issue_Dt')->nullable();//تاريخ استحقاق الشيك
            $table->datetime('Due_Issue_Dt')->nullable();//تاريخ استلام الشيك
            $table->bigInteger('Acc_No')->nullable();//  رقم الحساب الفرعى - عملاء - موردين - موظفين - حسابات
            $table->string('Rcpt_By')->nullable();//المستلم
            $table->string('Pymt_To')->nullable();//ادفعوا لامر
            $table->string('Pymt_By')->nullable();//منصرف لواسطة
            $table->boolean('Jv_Post')->nullable();//تم اقفال الحركه او لا
            $table->string('User_ID')->nullable();//
            $table->string('Entr_Dt')->nullable();//
            $table->string('Entr_Time')->nullable();//
            $table->integer('Ac_Ty')->nullable();//نوع الحساب
            $table->bigInteger('Cstm_No')->nullable();//رقم العميل
            $table->bigInteger('Sup_No')->nullable();//رقم المورد
            $table->bigInteger('Emp_No')->nullable();//رقم الموظف
            $table->bigInteger('Chrt_No')->nullable();//رقم الحساب فى حالة كان نوع الحساب حسابات
            $table->float('Tr_Db', 50, 10)->nullable();//الحركه مدين
            $table->float('Tr_Cr', 50, 10)->nullable();//الحركه دائن
            $table->integer('Curncy_No')->nullable();//العمله
            $table->integer('Slm_No')->nullable();//مندوب المبيعات
            $table->float('Curncy_Rate', 50, 10)->nullable();//سعر الصرف
            $table->float('Taxp_Extra', 50, 10)->nullable();//الضريبه
            $table->float('Taxv_Extra', 50, 10)->nullable();//قيمة الضريبه
            $table->float('Tot_Amunt', 50, 10)->nullable();//المبلغ المطلوب
            // $table->float('Crnt_Blnc', 50, 10)->nullable();//الرصيد الحالى
            $table->string('Tr_Ds', 200)->nullable();//البيان Ar
            $table->string('Tr_Ds1', 200)->nullable();//البيان EN
            $table->integer('Dc_No')->nullable();//رقم المستند
            $table->boolean('status')->default(0);//حالة السند -  1 محذوف -  0 غير محذوف
            $table->float('FTot_Amunt', 50, 10)->nullable(); //المبلغ المطلوب بالعمله الاجنبيه
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
        Schema::dropIfExists('GLJrnal');
    }
}
