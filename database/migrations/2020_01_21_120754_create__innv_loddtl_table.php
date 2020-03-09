<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInnvLoddtlTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invloddtl', function (Blueprint $table) {
            $table->increments('ID_No');
            $table->smallInteger('Brn_No')->nullable();
            $table->smallInteger('Cmp_No')->nullable();
            $table->smallInteger('Actvty_No')->nullable();
            $table->smallInteger('Doc_Ty')->nullable();
            $table->bigInteger('Doc_No')->nullable();
            $table->smallInteger('Ln_No')->nullable();
            $table->smallInteger('Dlv_Stor')->nullable();
            $table->date('Doc_Dt')->nullable();
            $table->string('Doc_DtAr', 10)->nullable();
            $table->bigInteger('Custm_Inv')->nullable();
            $table->smallInteger('Reftyp_No')->nullable();
            $table->bigInteger('Ref_No')->nullable();
            $table->smallInteger('Pym_No')->nullable();
            $table->smallInteger('To_BrNO')->nullable();
            $table->smallInteger('To_Store')->nullable();
            $table->smallInteger('Mrkt_No')->nullable();
            $table->smallInteger('Period_Time')->nullable();
            $table->smallInteger('Slm_No')->nullable();
            $table->smallInteger('Ac_Ty')->nullable();
            $table->smallInteger('City_No')->nullable();
            $table->bigInteger('Cstm_No')->nullable();
            $table->bigInteger('Sup_No')->nullable();
            $table->bigInteger('Catg_No')->nullable();
            $table->integer('Kind_No')->nullable();
            $table->bigInteger('Itm_No')->nullable();
            $table->smallInteger('Loc_No')->nullable();
            $table->string('Itm_RefNo', 10)->nullable();
            $table->smallInteger('Unit_No')->nullable();
            $table->integer('UnitLn_No')->nullable();
            $table->integer('Unit_ratio')->nullable();
            $table->float('Qty', 8)->nullable();
            $table->float('Dlv_Qty', 8)->nullable();
            $table->string('Exp_Date', 20)->nullable();
            $table->string('Batch_No', 30)->nullable();
            $table->float('Itm_Cost', 8)->nullable();
            $table->float('Itm_Sal', 8)->nullable();
            $table->float('Itm_Pur', 8)->nullable();
            $table->float('Titm_Cost', 8)->nullable();
            $table->float('Titm_Sal', 8)->nullable();
            $table->float('Titm_Pur', 8)->nullable();
            $table->float('Tot_Expens', 8)->nullable();
            $table->float('Disc1_Val', 8)->nullable();
            $table->float('Disc2_Val', 8)->nullable();
            $table->float('Othr_Disc', 8)->nullable();
            $table->float('Disc1_Prct', 8)->nullable();
            $table->float('Disc2_Prct', 8)->nullable();
            $table->float('Itm_SalSubUnt', 8)->nullable();
            $table->float('Itm_SalSubUnt2', 8)->nullable();
            $table->float('Itm_SalSubUnt3', 8)->nullable();
            $table->float('Bonus_Qty', 8)->nullable();
            $table->float('Bonus_Val', 8)->nullable();
            $table->float('Bonus_Prct', 8)->nullable();
            $table->float('BonusPur_Qty', 8)->nullable();
            $table->float('BonusPur_Val', 8)->nullable();
            $table->float('BonusPur_Prct', 8)->nullable();
            $table->float('DiscSal_Prct', 8)->nullable();
            $table->float('DiscSal2_prct', 8)->nullable();
            $table->float('BonusSalCrdt_Prct', 8)->nullable();
            $table->smallInteger('BonusSalCash_Prct')->nullable();
            $table->smallInteger('Itm_Rcpt_Hold')->nullable();
            $table->float('Customs_Prct', 8)->nullable();
            $table->float('Customs', 8)->nullable();
            $table->float('FcItm_Sal', 8)->nullable();
            $table->float('FcItm_Pur', 8)->nullable();
            $table->float('FcTitm_Cost', 8)->nullable();
            $table->float('FcTitm_Sal', 8)->nullable();
            $table->float('FcTitm_Pur', 8)->nullable();
            $table->float('SExpens', 8)->nullable();
            $table->float('Pur_Exp', 8)->nullable();
            $table->float('Ret_Qty', 8)->nullable();
            $table->float('Ret_Val', 8)->nullable();
            $table->float('Ret_Uprice', 8)->nullable();
            $table->string('Lc_No', 50)->nullable();
            $table->float('SpecialDiscount', 8)->nullable();
            $table->float('Taxp_ExtraDtl', 8)->nullable();
            $table->float('Taxv_ExtraDtl', 8)->nullable();
            $table->string('Doc_Post', 10)->nullable();
            $table->string('updt_date', 10)->nullable();
            $table->smallInteger('User_Id')->nullable();



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
        Schema::dropIfExists('invloddtl');
    }
}
