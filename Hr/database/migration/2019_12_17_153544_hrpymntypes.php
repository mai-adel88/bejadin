<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Hrpymntypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hrpymntypes', function (Blueprint $table) {
            $table->increments('ID_NO');
            $table->integer('Pymnt_No')->nullable();
            $table->string('Pymnt_NmAr', 50)->nullable();
            $table->string('Pymnt_NmEn', 50)->nullable();
            $table->smallInteger('Nof_Emp')->nullable();
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
        Schema::dropIfExists('hrpymntypes');
    }
}
