<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateDepmCmpTable extends Migration {

	public function up()
	{
		Schema::create('depm_cmp', function(Blueprint $table) {
			$table->increments('ID_No');
			$table->timestamps();
			$table->integer('Cmp_No')->nullable();
			$table->integer('Depm_Main')->nullable();
			$table->string('Depm_NmAr')->nullable();
			$table->string('Depm_NmEn')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('depm_cmp');
	}
}
