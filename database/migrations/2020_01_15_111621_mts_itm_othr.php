<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MtsItmOthr extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mtsitmothr', function (Blueprint $table) {
            $table->increments('ID_No');
            $table->integer('Actvty_No')->nullable();
            $table->smallInteger('Cmp_No')->nullable();
            $table->bigInteger('Itm_No')->nullable();
            $table->string('Itm_LengthSteel', 20)->nullable();
            $table->string('Itm_WidthSteel', 20)->nullable();
            $table->string('Itm_HeightSteel', 20)->nullable();
            $table->string('Itm_Durability', 20)->nullable();
            $table->float('Itm_WghtPaper')->nullable();
            $table->float('Itm_LengthPaper')->nullable();
            $table->float('Itm_WidthPaper')->nullable();
            $table->float('Itm_TWeight')->nullable();
            $table->float('Itm_NWeight')->nullable();
            $table->string('Shelf_No', 20)->nullable();
            $table->string('Itm_Othr1', 250)->nullable();
            $table->string('Itm_Othr2', 250)->nullable();
            $table->smallInteger('Mdcn_Grup1')->nullable();
            $table->smallInteger('Mdcn_Grup2')->nullable();
            $table->smallInteger('Mdcn_Grup3')->nullable();
            $table->smallInteger('Mdcn_Grup4')->nullable();
            $table->string('Itm_Picture', 250)->nullable();
            $table->bigInteger('ItmRplc_No1')->nullable();
            $table->bigInteger('ItmRplc_No2')->nullable();
            $table->bigInteger('ItmRplc_No3')->nullable();
            $table->string('ItmRplc_NmEn1', 250)->nullable();
            $table->string('ItmRplc_NmEn2', 250)->nullable();
            $table->string('ItmRplc_NmEn3', 250)->nullable();
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
        Schema::dropIfExists('mtsitmothr');
    }
}
