<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMTScustomerTable extends Migration {

	public function up()
	{
		Schema::create('mtscustomer', function(Blueprint $table) {
			$table->increments('ID_No');
			$table->timestamps();
			$table->integer('Cmp_No')->nullable();  //رقم الشركه
			$table->integer('Brn_No')->nullable();       //رقم الفرع
			$table->bigInteger('Cstm_No')->nullable();   //رقم العميل
			$table->boolean('Cstm_Active')->nullable();  //فعالية العميل
			$table->integer('Cstm_Ctg')->nullable();     //تصنيف العميل
			$table->string('Cstm_Refno', 20)->nullable();//رقم المرجع للعميل
			$table->boolean('Internal_Invoice')->nullable();//الفاتوره الداخليه للعميل (0 مبيعملش / 1 بيعمل)
			$table->bigInteger('Acc_No')->nullable();       //رقم الحساب للعملاء
			$table->string('Cstm_NmEn', 200)->nullable();
			$table->string('Cstm_NmAr', 200);
			$table->integer('Catg_No')->nullable();     //الراجل بيسدد فى مواعيده - بصنف الناس حسب التعاملات
			$table->integer('Slm_No')->nullable(); //رقم  مندوب البيع
			$table->integer('Mrkt_No')->nullable();     //رقم مشرف المبيعات
			$table->integer('Nutr_No')->nullable();     //رقم طبيعة النشاط
			$table->integer('Cntry_No')->nullable();    //الدوله
			$table->integer('City_No')->nullable();     //المدينه
			$table->integer('Area_No')->nullable();  //المنطقه
			$table->decimal('Credit_Value')->nullable(); //قيمة حد الائتمان - هبيعله كام ع المكشوف
			$table->integer('Credit_Days')->nullable(); //مدة الائتمان (لما ابيع على المكشوف هيسدد على اد ايه)
			$table->string('Cstm_Adr', 200)->nullable();        //العنوان
			$table->string('Cstm_POBox', 40)->nullable();    //صندوق البريد
			$table->string('Cstm_ZipCode')->nullable();  //منطقة البريد
			$table->string('Cstm_Rsp', 100)->nullable(); //الشخص المسئول  (المدير اللى هتعامل معاه مباشر عن الشركه كلها)
			$table->string('Cstm_Othr', 40)->nullable(); //ملاحظات اخرى
			$table->string('Cstm_Email')->nullable();    //الايميل
			$table->string('Cstm_Tel', 50)->nullable();         //الهاتف
			$table->string('Cstm_Fax', 15)->nullable();         //الفاكس
			$table->string('Cntct_Prsn1', 50)->nullable();   //الشخص المسئول1 عن قسم واحد
			$table->string('Cntct_Prsn2', 50)->nullable();
			$table->string('Cntct_Prsn3', 50)->nullable();
			$table->string('Cntct_Prsn4', 50)->nullable();
			$table->string('Cntct_Prsn5', 50)->nullable();
			$table->string('TitL1', 50)->nullable();     //1وظيفة المسئول
			$table->string('TitL2', 50)->nullable();
			$table->string('TitL3', 50)->nullable();
			$table->string('TitL4', 50)->nullable();
			$table->string('TitL5', 50)->nullable();
			$table->string('Mobile1', 15)->nullable();
			$table->string('Mobile2', 15)->nullable();
			$table->string('Mobile3', 15)->nullable();
			$table->string('Mobile4', 15)->nullable();
			$table->string('Mobile5', 15)->nullable();
			$table->string('Email1', 50)->nullable();
			$table->string('Email2', 50)->nullable();
			$table->string('Email3', 50)->nullable();
			$table->string('Email4', 50)->nullable();
			$table->string('Email5', 50)->nullable();
			$table->string('Tel1', 15)->nullable();          //هاتف الشركه 1
			$table->string('Tel2', 50)->nullable();
			$table->string('Tel3', 50)->nullable();
            $table->string('Mobile', 15)->nullable();       //الهاتف الرئيسي للشركة
			$table->decimal('Fbal_Db')->nullable();	                //رصيد اول المده مدين
			$table->decimal('Fbal_CR')->nullable();                 //رصيد اول المده دائن
			$table->decimal('CR11')->nullable();                //حركة يناير مدين
			$table->decimal('CR12')->nullable();
			$table->decimal('CR13')->nullable();
			$table->decimal('CR14')->nullable();
			$table->decimal('CR15')->nullable();
			$table->decimal('CR16')->nullable();
			$table->decimal('CR17')->nullable();
			$table->decimal('CR18')->nullable();
			$table->decimal('CR19')->nullable();
			$table->decimal('CR20')->nullable();
			$table->decimal('CR21')->nullable();
			$table->decimal('CR22')->nullable();
			$table->decimal('DB11')->nullable();
			$table->decimal('DB12')->nullable();
			$table->decimal('DB13')->nullable();
			$table->decimal('DB14')->nullable();
			$table->decimal('DB15')->nullable();
			$table->decimal('DB16')->nullable();
			$table->decimal('DB17')->nullable();
			$table->decimal('DB18')->nullable();
			$table->decimal('DB19')->nullable();
			$table->decimal('DB20')->nullable();
			$table->decimal('DB21')->nullable();
			$table->decimal('DB22')->nullable();
			$table->date('Opn_Date')->nullable();    //تاريخ تسجيل العميل
			$table->time('Opn_Time')->nullable();    //وقت تسجيل العميل
			$table->integer('User_ID')->nullable();     //مين ال سجل العميل
			$table->datetime('Updt_Date')->nullable();//تاريخ التعديل
			$table->integer('Cstm_Agrmnt')->nullable();//رقم الاتفاقيه للعملاء
			$table->integer('Disc_prct')->nullable();    //نسبة الخصم
			$table->integer('Itm_Sal')->nullable();       //سعر البيع
			$table->bigInteger('Linv_No')->nullable();    //رقم اخر فاتوره للعميل
			$table->string('Linv_Dt')->nullable();        //تاريخ اخر فاتور
			$table->decimal('Linv_Net')->nullable();     //صافي اخر فاتوره
			$table->bigInteger('LRcpt_No')->nullable();   //رقم اخر سند قبض (اخر مره حصلت من العميل)
			$table->string('LRcpt_Dt', 10)->nullable();  //تاريخ اخر سند قبض
			$table->decimal('LRcpt_Db')->nullable();        //قيمة اخر سند قبض
			$table->string('Notes', 40)->nullable();
			$table->string('Tax_No', 20)->nullable();    //رقم البطاقه الضريبيه للعميل
            $table->string('AgeNot_Calculate')->nullable(); //العميل لايدخل في حساب العمولة
            $table->string('Deserve_Discount')->nullable();    //العميل لايستحق اى خصومات

        });
	}

	public function down()
	{
		Schema::drop('mtscustomer');
	}
}
