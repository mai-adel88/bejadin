<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MtsItmcatgry extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mtsitmcatgry', function (Blueprint $table) {
            $table->increments('ID_No');
            $table->integer('Actvty_No')->nullable();
            $table->smallInteger('Cmp_No')->nullable();
            $table->bigInteger('Itm_No')->nullable();
            $table->bigInteger('Parent_Itm')->nullable();
            $table->smallInteger('Level_Status')->nullable();
            $table->smallInteger('Level_No')->nullable();
            $table->smallInteger('Itm_Active')->nullable();
            $table->string('Itm_NmAr', 20)->nullable();
            $table->string('Itm_NmEn', 20)->nullable();
            $table->bigInteger('Sup_No')->nullable();
            $table->smallInteger('Dpm_No')->nullable();
           // $table->smallInteger('Sales_Kind')->nullable();
            $table->string('Opn_Date', 10)->nullable();
            $table->string('Opn_Time', 10)->nullable();
            $table->string('User_ID', 50)->nullable();
            $table->date('Updt_Date')->nullable();
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
        Schema::dropIfExists('mtsitmcatgry');
    }
}
