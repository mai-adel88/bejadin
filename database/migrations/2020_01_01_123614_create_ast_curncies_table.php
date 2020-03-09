<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAstCurnciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('astcurncy', function (Blueprint $table) {
            $table->increments('ID_No');
            $table->integer('Curncy_No')->nullable();//رقم العمله
            $table->string('Curncy_NmAr', 15)->nullable();//اسم العمله عربى
            $table->string('Curncy_NmEn', 15)->nullable();//اسم العمله انجليزى
            $table->float('Curncy_Rate')->nullable();//سعر الصرف
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
        Schema::dropIfExists('astcurncy');
    }
}
