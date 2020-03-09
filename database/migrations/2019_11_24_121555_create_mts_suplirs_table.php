<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMtsSuplirsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mts_suplirs', function (Blueprint $table) {

            $table->increments('ID_No');
            $table->integer('Cmp_No')->nullable();               // رقم الشركه
            $table->integer('Brn_No')->nullable();               // رقم الفرع
            $table->integer('Sup_No')->nullable();               // رقم المورد
            $table->boolean('Sup_Active')->nullable();               //  الحالة

            $table->string('Cstm_POBox')->nullable();             //  صندوق البريد
            $table->string('Cstm_ZipCode')->nullable();             //  رقم البريد
            $table->string('Sup_Refno')->nullable();             //رقم المرجع للمورد
            $table->integer('SupCtg_No')->nullable();// تصنيف المورد
            $table->integer('Cntry_No')->nullable();             // رقم الدول
            $table->string('Sup_NmEn')->nullable();// اسم المورد بالانجليزى
            $table->string('Sup_NmAr')->nullable();// الاسم المورد بالعربى
            $table->string('Sup_Adr')->nullable();//  عنوان المورد
            $table->string('Sup_Rsp')->nullable();//الشخص المسؤل
            $table->string('Sup_Othr')->nullable();//ملاحظات المورد
            $table->integer('Curncy_No')->nullable();//العمله
            $table->string('Sup_Email')->nullable();// ايميل المورد

            $table->string('note')->nullable();//  نوووت

            $table->string('Sup_Tel1')->nullable();// تليفون 1
            $table->string('Sup_Tel2')->nullable();// تليفون 2
            $table->string('Mobile')->nullable();//موبايل
            $table->string('Sup_Fax')->nullable();//فاكس
            $table->bigInteger('Acc_No')->nullable();//رقم حساب الموردين

            $table->float('Credit_Value')->nullable();//قيمة حد الائتمان

            $table->integer('Credit_Days')->nullable();//عدد الايام للائتمان

            $table->float('Fbal_Db')->nullable();//اول المده مدين

            $table->float('Fbal_CR')->nullable();//اول المده دائن


            $table->string('Cntct_Prsn1')->nullable();// شخص مسؤل 1
            $table->string('Cntct_Prsn2')->nullable();// شخص مسؤل 2
            $table->string('Cntct_Prsn3')->nullable();// شخص مسؤل 3
            $table->string('Cntct_Prsn4')->nullable();// شخص مسؤل 4
            $table->string('Cntct_Prsn5')->nullable();// شخص مسؤل 5

            $table->string('TitL1')->nullable();// عنوان مسؤل 1
            $table->string('TitL2')->nullable();
            $table->string('TitL3')->nullable();
            $table->string('TitL4')->nullable();
            $table->string('TitL5')->nullable();

            $table->string('Mobile1')->nullable();// موبايل مسؤل 1
            $table->string('Mobile2')->nullable();
            $table->string('Mobile3')->nullable();
            $table->string('Mobile4')->nullable();
            $table->string('Mobile5')->nullable();

            $table->string('Email1')->nullable();// ايميل مسؤل 1
            $table->string('Email2')->nullable();
            $table->string('Email3')->nullable();
            $table->string('Email4')->nullable();
            $table->string('Email5')->nullable();


            $table->string('Linv_No')->nullable();  //رقم اخر فاتوره للمورد
            $table->string('Linv_Dt')->nullable();  //تاريخ اخر فاتوره
            $table->float('Linv_Net')->nullable(); //صافى اخر فاتوره
            $table->string('LRcpt_No')->nullable(); //رقم اخر سند صرف
            $table->string('LRcpt_Dt')->nullable(); //تاريخ اخر سند صرف
            $table->float('LRcpt_Db')->nullable(); // قيمة اخر سند صرف

            $table->float('CBal')->nullable(); // قيمة اخر سند صرف
            $table->string('TradeOffer')->nullable(); // قيمة اخر سند صرف




            $table->float('CR11')->nullable();//حركة يناير دائن
            $table->float('CR12')->nullable();//
            $table->float('CR13')->nullable();//
            $table->float('CR14')->nullable();//
            $table->float('CR15')->nullable();//
            $table->float('CR16')->nullable();//
            $table->float('CR17')->nullable();//
            $table->float('CR18')->nullable();//
            $table->float('CR19')->nullable();//
            $table->float('CR20')->nullable();//
            $table->float('CR21')->nullable();//
            $table->float('CR22')->nullable();//

            $table->float('DB11')->nullable();//حركة ياناير مدين
            $table->float('DB12')->nullable();//
            $table->float('DB13')->nullable();//
            $table->float('DB14')->nullable();//
            $table->float('DB15')->nullable();//
            $table->float('DB16')->nullable();//
            $table->float('DB17')->nullable();//
            $table->float('DB18')->nullable();//
            $table->float('DB19')->nullable();//
            $table->float('DB20')->nullable();//
            $table->float('DB21')->nullable();//
            $table->float('DB22')->nullable();//

            $table->dateTime('Updt_Date')->nullable();// تاريخ التعديل
            $table->integer('User_ID')->nullable();// رقم المستخدم
            $table->integer('Tax_No')->nullable(); //البطاقة الضريبيه للمورد

            $table->string('Opn_Date')->nullable(); //تاريخ تسجيل العميل

            $table->string('Opn_Time')->nullable(); //وقت تسجيل العميل


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
        Schema::dropIfExists('mts_suplirs');
    }
}
