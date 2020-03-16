<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGLjrnTrsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('GLjrnTrs', function (Blueprint $table) {
            $table->increments('ID_No');
            $table->integer('Cmp_No')->nullable();//الشركه
            $table->integer('Brn_No')->nullable();//الفروع
            $table->integer('Jr_Ty')->nullable(); //نوع القيد TransactionType Enum
            $table->enum('noti_Ty', [1,2])->nullable(); //نوع الاشعار
            $table->bigInteger('Tr_No')->nullable();//رقم القيد
            $table->integer('Ln_No')->nullable();//سطر
            $table->integer('Month_No')->nullable();//رقم الشهر
            $table->integer('Month_Jvno')->nullable();//رقم القيد\الشهر
            $table->datetime('Tr_Dt')->nullable();//تاريخ القيد
            $table->string('Tr_DtAr')->nullable();//تاريخ القيد هجرى
            $table->enum('Ac_Ty', [1,2,3,4,5,6,7])->nullable(); //نوع الحساب AccountType Enum
            $table->bigInteger('Sysub_Account')->nullable();//بيانات موظفين - بيانات موردين - بيانات عملاء - دليل حسابات
            $table->bigInteger('Acc_No')->nullable();//رقم الحساب
            $table->float('Tr_Db')->nullable();//الحركه مدين
            $table->float('Tr_Cr')->nullable();//الحركه دائن
            $table->string('Dc_No')->nullable();//رقم المستند
            $table->string('Tr_Ds', 200)->nullable();//البيان Ar
            $table->string('Tr_Ds1', 200)->nullable();//البيان En
            $table->bigInteger('Clsacc_no1')->nullable();//بند الميزانيه
            $table->bigInteger('Clsacc_no2')->nullable();//بند قائمة الدخل
            $table->bigInteger('Costcntr_No')->nullable();//رقم مركز التكلفه
            $table->enum('Doc_Type', [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16])->nullable();//نوع المستند
            $table->integer('Curncy_No')->nullable();//currency_type number
            $table->boolean('GL_Post')->nullable();//
            $table->boolean('JV_Post')->nullable();//
            $table->string('User_ID')->nullable();//
            $table->string('Entr_Dt')->nullable();//
            $table->string('Entr_Time')->nullable();//
            $table->integer('Acc_Type')->nullable();//
            $table->float('Rcpt_Value')->nullable();//
            $table->float('RetPur_Sal')->nullable();//
            $table->integer('Slm_No')->nullable();//مندوب المبيعات
            $table->float('FTot_Amunt', 50, 10)->nullable(); //المبلغ المطلوب بالعمله الاجنبيه
            $table->float('FTr_Db', 50, 10)->nullable();//الحركه مدين بالعمله الاجنبيه
            $table->float('FTr_Cr', 50, 10)->nullable();//الحركه دائن بالعمله الاجنبيه
//            $table->integer('Slm_No')->nullable();//مندوب المبيعات
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
        Schema::dropIfExists('GLjrnTrs');
    }
}
