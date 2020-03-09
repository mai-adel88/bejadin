<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAstSalesmanTable extends Migration {

	public function up()
	{
		Schema::create('AstSalesman', function(Blueprint $table) {
			$table->increments('ID_No');
			$table->timestamps();
			$table->integer('Slm_No')->nullable();  //رقم المندوب
			$table->integer('Cmp_No')->nullable();  //الشركه
			$table->integer('Brn_No')->nullable();
            $table->integer('Mark_No')->nullable(); //رقم الممشرف
            $table->integer('StoreNo')->nullable();  //رقم المستودع
			$table->string('Slm_NmEn')->nullable();
			$table->string('Slm_NmAr')->nullable();
			$table->decimal('Target')->nullable();
			$table->string('Slm_Tel', 20)->nullable();
			$table->boolean('Slm_Active')->nullable();
			$table->date('Opn_Date')->nullable();
			$table->datetime('Opn_Time')->nullable();
			$table->string('User_ID')->nullable();    //مين اللى سجل العميل
			$table->date('Updt_Date')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('AstSalesman');
	}
}
