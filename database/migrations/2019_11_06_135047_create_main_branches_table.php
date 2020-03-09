<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMainBranchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('MainBranch', function (Blueprint $table) {
            $table->increments('ID_No');
            $table->integer('Cmp_No')->nullable()->index(); //رقم الشركه
            $table->foreign('Cmp_No')->references('Cmp_No')->on('maincompany')->onDelete('cascade');
            $table->integer('Brn_No')->nullable(); //رقم الفرع
            $table->integer('Cmp_Actvty_No')->nullable(); //طبيعة النشاط
            $table->integer('Main_Brn')->nullable(); //الفرع الرئيسى
            $table->integer('Dlv_Stor')->nullable();//مستودع التسليم للفرع
            $table->boolean('Actvty_No')->nullable();//الفرع فعال - غير فعال
            $table->boolean('Isue_Alinvc')->nullable();//الفرع له حق اصدار فواتير - ليس له حق اصدار فواتير
            $table->boolean('Br_Ty')->nullable();//نوع الفرع : نقطة بيع - اداره - مستودع رئيسى
            $table->string('Brn_NmEn')->nullable();//اسم الفرع انجليزى
            $table->string('Brn_NmAr')->nullable();//اسم الفرع عربى
            $table->string('Brn_Tel')->nullable();//تليفون الفرع
            $table->string('Brn_Adrs')->nullable();//عنوان الفرع
            $table->string('Brn_Email')->nullable();//ايميل الفرع
            $table->string('Brn_Fax')->nullable();//فاكس الفرع
            $table->bigInteger('Acc_Cashier')->nullable();//حساب الصندوق
            $table->bigInteger('Acc_Customer')->nullable();//حساب ذمم العملاء
            $table->bigInteger('Acc_Suplier')->nullable();//حساب ذمم الموردين
            $table->bigInteger('Acc_CrdSal')->nullable();//المبيعات الاجله
            $table->bigInteger('Acc_CshSal')->nullable();//المبيعات النقديه
            $table->bigInteger('Acc_RetSal')->nullable();//مرتجع المبيعات
            $table->bigInteger('Acc_DiscSal')->nullable();//خصم المبيعات
            $table->bigInteger('Acc_CrdPur')->nullable();//المشتريات الاجله
            $table->bigInteger('Acc_CshPur')->nullable();//المشتريات النقديه
            $table->bigInteger('Acc_RetPur')->nullable();//مرتجع المشتريات
            $table->bigInteger('Acc_DiscPur')->nullable();//خصم المشتريات

            //PostEnum enum
            $table->boolean('DlyPst_CshSal')->nullable()->default(0);//ترحيل المبيعات النقديه اوتماتيك للحسابات
            $table->boolean('DlyPst_CshPur')->nullable()->default(0);//ترحيل المشتريات النقديه اوتماتيك للحسابات

            $table->bigInteger('Adv_SalAcc')->nullable();//حساب الدفعات المقدمه للمبيعات
            $table->bigInteger('Adv_RetSalAcc')->nullable();//حساب الدفعات المقدمه لمرتجع المبيعات
            $table->float('Inv_Prdctn')->nullable();//حساب المخزون تحت الانتاج
            $table->float('Inv_Undprs')->nullable();//حساب المخزون تحت التشغيل
            $table->float('Inv_RM')->nullable();//حساب مخزون المواد الخام
            $table->bigInteger('Cost_INVt')->nullable();//تكلفة المخزون
            $table->bigInteger('Cost_SalInvt')->nullable();//تكلفة المبيعات
            $table->bigInteger('Acc_Invtry')->nullable();//حساب المخزون
            $table->bigInteger('Acc_InvAdj')->nullable();//تسوية المخزون - ارباح غير محققه
            $table->bigInteger('Acc_TaxExtraDb')->nullable();//حساب الضريبه المضافه للمصروفات
            $table->bigInteger('Acc_TaxExtraCR')->nullable();//حساب الضريبه المضافه للايرادات
            $table->bigInteger('Acc_DBEmp')->nullable();// ذمم الموظفين
            $table->bigInteger('Acc_LonesEmp')->nullable();// سلف الموظفين

            //DocType enum
            $table->boolean('Rcpt_Flg')->nullable()->default(0);//سماحيةادخال سندات قبض
            $table->boolean('Pymt_Flg')->nullable()->default(0);//سماحيةادخال سندات صرف
            $table->boolean('Jv_Flg')->nullable()->default(0);//سماحيةادخال قيود يوميه
            $table->boolean('Sal_Flg')->nullable()->default(0);//سماحية التعامل مع المبيعات
            $table->boolean('Pur_Flg')->nullable()->default(0);//سماحية التعامل مع المشتريات
            $table->boolean('Inv_Flg')->nullable()->default(0);//سماحية التعامل مع المخازن

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
        Schema::dropIfExists('MainBranch');
    }
}
