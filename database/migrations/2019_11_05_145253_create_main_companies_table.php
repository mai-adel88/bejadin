<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMainCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('MainCompany', function (Blueprint $table) {
            $table->increments('ID_No');

            //ثوابت الشركه - tap
            $table->integer('Cmp_No')->nullable()->unique();//رقم الشركه و يتم انشاءه يدوي
            $table->integer('Local_Lang')->nullable()->default('0');// رقم اللغه
            $table->integer('Sys_SetupNo')->nullable();//النظام المستخدم
            $table->integer('Actvty_No')->nullable();//طبيعة النشاط
            $table->string('Cmp_ShrtNm')->nullable();//الاسم المختصر للشركه

            $table->integer('Start_Month')->nullable();//شهر البدايه للسنه الماليه
            $table->integer('Start_Year')->nullable();//سنة البدايه للسنه الماليه
            $table->integer('End_Month')->nullable();//شهر النهايه للسنه الماليه
            $table->integer('End_Year')->nullable();//سنة النهايه للسنه الماليه

            $table->integer('Start_MonthHij')->nullable();//شهر البدايه للسنه الماليه - هجرى
            $table->integer('Start_YearHij')->nullable();//سنة البدايه للسنه الماليه - هجرى
            $table->integer('End_MonthHij')->nullable();//شهر النهايه للسنه الماليه - هجرى
            $table->integer('End_YearHij')->nullable();//سنة النهايه للسنه الماليه - هجرى

            $table->string('Cmp_NmAr')->nullable();//اسم الشركه عربى
            $table->string('Cmp_NmAr2')->nullable();//اسم الشركه عربى 2
            $table->string('Cmp_NmEn')->nullable();//اسم الشركه انجليزى
            $table->string('Cmp_NmEn2')->nullable();//اسم الشركه انجليزى 2

            $table->string('Cmp_Tel')->nullable();//هاتف الشركه
            $table->string('Cmp_Fax')->nullable();//فاكس الشركه
            $table->string('Cmp_Email')->nullable();//ايميل الشركه
            $table->string('Cmp_AddAr')->nullable();//عنونا الشركه عربى
            $table->string('Cmp_AddEn')->nullable();//عنوان الشركه انجليزى
            $table->string('Picture')->nullable();//شعار الشركه

            $table->string('CR_No')->nullable();//رقم السجل التجارى
            $table->string('CC_No')->nullable();//رقم الغرفه التجاريه
            $table->string('License_No')->nullable();//رقم الترخيص
            $table->string('Tax_No')->nullable();//الرقم الضريبى
            $table->integer('TaxExtra_Prct')->nullable();//نسبة الضريبه المضافه

            $table->boolean('Itm_SrchRef')->nullable()->default(0);// البحث بالمرجع للصنف - 0 برقم الصنف - 1 برقم المرجع للصنف
            $table->boolean('Date_Status')->nullable()->default(0);//الحركه بالتاريخ الهجرى - 0 تاريخ ميلادى - تاريخ هجرى
            $table->boolean('JvAuto_Mnth')->nullable()->default(0);//تسلسل قيد اليوميه اليا حسب الشهر - 0 تسلسل متواصل - 1 حسب الشهر
            $table->boolean('Cshr_Status')->nullable()->default(0);//حساب الصندوق و البنوك
            $table->boolean('PhyTy_CostPrice')->nullable()->default(0);//الجرد الدورى بالتكلفه
            $table->boolean('PhyTy_SalePrice')->nullable()->default(0);//ترحيل العهده بسعر البيع
            $table->integer('Fraction_Cost')->nullable()->default(0);//تكلفة الصنف لاقرب 4 علامات عشريه
            $table->float('Fraction_Curncy')->nullable();//الارقام العشريه للعمله

            //الترحيل للحسابات - tap AccountPostingType enum
            $table->boolean('JVPst_SalCash')->nullable()->default(0);//ترحيل المبيعات النقديه للصندوق اليا
            $table->boolean('JVPst_PurCash')->nullable()->default(0);//ترحيل المشتريات النقديه للصندوق اليا
            $table->boolean('JVPst_NetSalCrdt')->nullable()->default(0);//ترحيل صافى المبيعات الاجله للحسابات
            $table->boolean('JVPst_NetPurCrdt')->nullable()->default(0);//ترحيل صافى المشتريات الاجله للحسابات
            $table->boolean('JVPst_TrnsferVch')->nullable()->default(0);//ترحيل سندات التحويل للحسابات
            $table->boolean('JVPst_AdjustVch')->nullable()->default(0);//ترحيل سندات التسويه للحسابات
            $table->boolean('JVPst_InvCost')->nullable()->default(0);//ترحيل المخازن بالتكلفه للحسابات
            $table->boolean('JVPst_InvSal')->nullable()->default(0);//ترحيل المخازن بالمبيعات للحسابات

            //النماذج الخاصه و الطبعات - tap
            $table->boolean('Spcrpt_Rcpt')->nullable()->default(0);//سند قبض
            $table->boolean('Spcrpt_Pymt')->nullable()->default(0);//سند صرف
            $table->boolean('Spcrpt_Sal')->nullable()->default(0);//فاتورة مبيعات
            $table->boolean('Spcrpt_Pur')->nullable()->default(0);//فاتورة مشتريات
            $table->boolean('Spcrpt_Trnf')->nullable()->default(0);//سند تحويل
            $table->boolean('Spcrpt_Adjust')->nullable()->default(0);//سند تسويه
            $table->boolean('Spcrpt_SRV')->nullable()->default(0);//سند ادخال بضاعه
            $table->boolean('Spcrpt_DNV')->nullable()->default(0);//سند تسليم بضاعه
            $table->boolean('PrintOrder_DNV')->nullable()->default(0);//طباعة سند التسليم مع فاتورة المبيعات
            $table->boolean('PrintOrder_SRV')->nullable()->default(0);//طباعة سند الاستلام مع فاتورة المشتريات
            $table->boolean('SelctNorm_Prntr1')->nullable()->default(0);//اختيار طابعة تقارير 1
            $table->boolean('SelctNorm_Prntr2')->nullable()->default(0);//اختيار طابعة تقارير 2
            $table->boolean('SelctNorm_Prntr3')->nullable()->default(0);//اختيار طابعة تقارير 3
            $table->boolean('SelctBarCod_Prntr1')->nullable()->default(0);//اختيار طابعة الباركود 1
            $table->boolean('SelctBarCod_Prntr2')->nullable()->default(0);//اختيار طابعة الباركود 2
            $table->boolean('SelctBarCod_Prntr3')->nullable()->default(0);//اختيار طابعة الباركود 3
            $table->boolean('SelctPosSlip_Prntr1')->nullable()->default(0);//اختيار طابعة نقاط البيع 1
            $table->boolean('SelctPosSlip_Prntr2')->nullable()->default(0);//اختيار طابعة نقاط البيع 2
            $table->boolean('SelctPosSlip_Prntr3')->nullable()->default(0);//اختيار طابعة نقاط البيع 3

            //اعدادات عامه
            $table->boolean('AllwItm_RepatVch')->nullable()->default(0);//سماحية بتكرارالصنف بنفس السند
            $table->boolean('AllwItmLoc_ZroBlnc')->nullable()->default(0);//سماحية اظهار المواقع للاصناف ذات الارصده الصفريه
            $table->boolean('AllwItmQty_CostCalc')->nullable()->default(0);//سماحية حساب التكلفه يعتمد على الكميه
            $table->boolean('AllwDisc1Pur_Dis1Sal')->nullable()->default(0);//سماحية خصم 1 بيع = خصم 1 شراء
            $table->boolean('AllwDisc2Pur_Dis2Sal')->nullable()->default(0);//سماحية خصم 2 بيع = خصم 2 شراء
            $table->boolean('AllwStock_Minus')->nullable()->default(0);//سماحية تسليم البضاعه بالسالب
            $table->boolean('AllwPur_Disc1')->nullable()->default(0);//سماحية بخصم شراء 1
            $table->boolean('AllwPur_Disc2')->nullable()->default(0);//سماحية بخصم شراء 2
            $table->boolean('AllwPur_Bouns')->nullable()->default(0);//سماحية بونص شراء
            $table->boolean('AllwSal_Disc1')->nullable()->default(0);//سماحية خصم بيع 1
            $table->boolean('AllwSal_Disc2')->nullable()->default(0);//سماحية خصم بيع 2
            $table->boolean('AllwSal_Bouns')->nullable()->default(0);//سماحية بونص بيع
            $table->boolean('AllwTrnf_Cost')->nullable()->default(0);//سماحية اصدار سندات التحويل بسعر التكلفه
            $table->boolean('AllwTrnf_Disc1')->nullable()->default(0);//سماحية خصم 1 بسندات التحويل بين الفروع
            $table->boolean('AllwTrnf_Bouns')->nullable()->default(0);//سماحية البونص بسندات التحويل بين الفروع
            $table->boolean('AllwBatch_No')->nullable()->default(0);//سماحية رقم التشغيله للادويه
            $table->boolean('AllwExpt_Dt')->nullable()->default(0);//سماحية تاريخ الصلاحيه
            $table->boolean('ActvDnv_No')->nullable()->default(0);//تفعيل سند تسليم بضاعه
            $table->boolean('ActvSRV_No')->nullable()->default(0);//تفعيل سند ادخال بضاعه
            $table->boolean('ActvTrnf_No')->nullable()->default(0);//تفعيل سندات تحويل بضاعه
            $table->boolean('TabOrder_Pur')->nullable()->default(0);//ترتيب خاص لشاشة المشتريات
            $table->boolean('TabOrder_SaL')->nullable()->default(0);//ترتيب خاص لشاشة المبيعات
            $table->boolean('Accredit_expens')->nullable()->default(0);//مصاريف الاعتماد
            $table->boolean('Foreign_Curncy')->nullable()->default(0);//متعدد العملات
            $table->boolean('Alw_slmacc')->nullable()->default(0);//متعدد العملات
            $table->integer('L_Curncy_No')->nullable();//العمله المحليه


            //اقفال الحركه الشهريه - شاشه منفصله
            $table->boolean('Month_Post1')->nullable()->default(0);//اقفال حركة شهر 1
            $table->boolean('Month_Post2')->nullable()->default(0);//اقفال حركة شهر 2
            $table->boolean('Month_Post3')->nullable()->default(0);//اقفال حركة شهر 3
            $table->boolean('Month_Post4')->nullable()->default(0);//اقفال حركة شهر 4
            $table->boolean('Month_Post5')->nullable()->default(0);//اقفال حركة شهر 5
            $table->boolean('Month_Post6')->nullable()->default(0);//اقفال حركة شهر 6
            $table->boolean('Month_Post7')->nullable()->default(0);//اقفال حركة شهر 7
            $table->boolean('Month_Post8')->nullable()->default(0);//اقفال حركة شهر 8
            $table->boolean('Month_Post9')->nullable()->default(0);//اقفال حركة شهر 9
            $table->boolean('Month_Post10')->nullable()->default(0);//اقفال حركة شهر 10
            $table->boolean('Month_Post11')->nullable()->default(0);//اقفال حركة شهر 11
            $table->boolean('Month_Post12')->nullable()->default(0);//اقفال حركة شهر 12
            //checkboxes end

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
        Schema::dropIfExists('MainCompany');
    }
}
