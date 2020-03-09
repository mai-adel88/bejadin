<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MtsItmunit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mtsitmunit', function (Blueprint $table) {
            $table->increments('ID_No');
            $table->smallInteger('Actvty_No')->nullable();
            $table->smallInteger('Cmp_No')->nullable();
            $table->smallInteger('Unit_No')->nullable();
            $table->string('Unit_NmAr', 20)->nullable();
            $table->string('Unit_NmEn', 20)->nullable();
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
        Schema::dropIfExists('mtsitmunit');
    }
}
