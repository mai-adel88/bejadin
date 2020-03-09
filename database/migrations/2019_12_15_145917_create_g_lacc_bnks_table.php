<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGLaccBnksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('GLaccBnk', function (Blueprint $table) {
            $table->increments('ID_No');
            $table->integer('Cmp_No')->nullable();//رقم الشركه
            $table->integer('Ln_No')->nullable();//رقم السطر
            $table->bigInteger('Acc_No')->nullable();//رقم الحساب
            $table->string('Acc_NmAr', 50)->nullable();//اسم الحساب عربى
            $table->string('Acc_NmEn', 50)->nullable();//اسم الحساب انجليزى
            $table->string('Acc_Bank_No', 15)->nullable();//رقم حساب البنك
            // appearance falgs البيانات دى هتظهر معايا فى صفحات ايه؟ 1 - يظهر 0 يختفى
            // مثال: لو اخترت سند قبض نقدى يبقى البيانات هتظهر معايا فى صفحة اذافه سند قبض نقدى
            $table->boolean('RcpCsh_Voucher')->nullable()->default(0);//سند قبض نقدى 
            $table->boolean('RcpChk_Voucher')->nullable()->default(0);//سند قبض شيك
            $table->boolean('PymCsh_voucher')->nullable()->default(0);//صرف نقدى
            $table->boolean('PymChk_Voucher')->nullable()->default(0);//صرف شيك
            $table->boolean('Cash_Rpt')->nullable()->default(0);//مجمع النقديه
            $table->boolean('Bank_No')->nullable()->default(0);//بنوك
            $table->boolean('DB_Note')->nullable()->default(0);//اشعار مدين
            $table->boolean('CR_Note')->nullable()->default(0);//اشعار دائن
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
        Schema::dropIfExists('GLaccBnk');
    }
}
