<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MtsItmMfs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mtsitmmfs', function (Blueprint $table) {
            $table->increments('ID_No');
            $table->smallInteger('Actvty_No')->nullable();
            $table->smallInteger('Cmp_No')->nullable();
            $table->bigInteger('Itm_No')->nullable();
            $table->bigInteger('Itm_Parnt')->nullable();
            $table->smallInteger('Level_Status')->nullable();
            $table->smallInteger('Level_No')->nullable();
            $table->integer('Measure_Grp')->nullable();
            $table->smallInteger('Itm_Active')->nullable();
            $table->smallInteger('Sale_Active')->nullable();
            $table->smallInteger('Invt_Active')->nullable();
            $table->smallInteger('Itm_Req')->nullable();
            $table->smallInteger('Itm_Relation')->nullable();
            $table->bigInteger('Itm_No_Main')->nullable();
            $table->string('Ref_No', 20)->nullable();
            $table->string('Itm_NmAr', 20)->nullable();
            $table->string('Itm_NmEn', 20)->nullable();
            $table->bigInteger('Sup_No')->nullable();
            $table->smallInteger('Unit_No')->nullable();
            $table->smallInteger('UnitPur_No')->nullable();
            $table->smallInteger('UnitSaL_No')->nullable();
            $table->smallInteger('Pckng_Unit')->nullable();
            $table->smallInteger('Pckng_Ratio')->nullable();
            $table->integer('Req_Limit')->nullable();
            $table->float('Itm_Pur')->nullable();
            $table->float('Itm_COst')->nullable();
            $table->float('Itm_Sal1')->nullable();
            $table->float('Itm_Sal2')->nullable();
            $table->float('Itm_Sal3')->nullable();
            $table->string('Item_BarCode', 15)->nullable();
            $table->string('Fctry_Barcode', 15)->nullable();
            $table->string('Fctry_Barcode2', 15)->nullable();
            $table->string('Fctry_Barcode3', 15)->nullable();
            $table->smallInteger('MaxQty_SaL')->nullable();
            $table->float('Prct_SalBouns')->nullable();
            $table->smallInteger('Chk_SalBouns')->nullable();
            $table->smallInteger('Chk_Discount')->nullable();
            $table->float('Prct_Discount')->nullable();
            $table->smallInteger('Chk_SalComsion')->nullable();
            $table->smallInteger('Chk_ExpDate')->nullable();
            $table->smallInteger('Chk_Batch')->nullable();
            $table->smallInteger('Chk_Qty2')->nullable();
            $table->smallInteger('Chk_Qty3')->nullable();
            $table->float('Taxp_Extra')->nullable();
            $table->smallInteger('Tax_Allow')->nullable();
            $table->smallInteger('Label_No')->nullable();
            $table->string('Opn_Date', 10)->nullable();
            $table->string('Opn_Time', 10)->nullable();
            $table->integer('User_ID')->nullable();
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
        Schema::dropIfExists('mtsitmmfs');
    }
}
