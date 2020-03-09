<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocClassTable extends Migration {

	public function up()
	{
		Schema::create('loc_class', function(Blueprint $table) {
			$table->increments('ID_No');
			$table->timestamps();
			$table->integer('Cmp_No')->nullable();
			$table->integer('Class_No')->nullable();
			$table->string('Class_NmAr')->nullable();
			$table->string('Class_NmEn')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('loc_class');
	}
}
