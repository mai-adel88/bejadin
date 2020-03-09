<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MtsItmfsunit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mtsitmfsunit', function (Blueprint $table) {
            $table->increments('ID_No');
            $table->integer('Actvty_No')->nullable();
            $table->smallInteger('Cmp_No')->nullable();
            $table->integer('Cstm_Agrmnt')->nullable();
            $table->bigInteger('Itm_No')->nullable();
            $table->smallInteger('Ln_No')->nullable();
            $table->smallInteger('Unit_No')->nullable();
            $table->smallInteger('Label_No')->nullable();
            $table->float('Unit_Ratio')->nullable();
            $table->float('Unit_Pur')->nullable();
            $table->float('Unit_Cost')->nullable();
            $table->float('Unit_Sal1')->nullable();
            $table->float('Unit_Sal2')->nullable();
            $table->float('Unit_Sal3')->nullable();
            $table->float('Unit_Sal4')->nullable();
            $table->float('Unit_Discval')->nullable();
            $table->float('Unit_DiscPrct')->nullable();
            $table->string('Updt_Date', 10)->nullable();
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
        Schema::dropIfExists('mtsitmfsunit');
    }
}
