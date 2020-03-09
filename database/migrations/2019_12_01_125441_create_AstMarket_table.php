<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAstMarketTable extends Migration {

	public function up()
	{
		Schema::create('AstMarket', function(Blueprint $table) {
			$table->increments('ID_No');
			$table->timestamps();
			$table->integer('Mrkt_No')->nullable();    //رقم المشرف
            $table->integer('Cmp_No')->nullable();  //الشركه
            $table->integer('Brn_No')->nullable();      //رقم الفرع
			$table->string('Mrkt_NmEn')->nullable();     //الاسم
			$table->string('Mrkt_NmAr')->nullable();
			$table->boolean('Mrkt_Active')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('AstMarket');
	}
}
