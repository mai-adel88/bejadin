<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInnvLodhdrTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invlodhdr', function (Blueprint $table) {
            $table->increments('ID_No');
            $table->smallInteger('Brn_No')->nullable();
            $table->smallInteger('Cmp_No')->nullable();
            $table->smallInteger('Actvty_No')->nullable();
            $table->smallInteger('Doc_Ty')->nullable();
            $table->smallInteger('Doc_No')->nullable();
            $table->smallInteger('Dlv_Stor')->nullable();
            $table->date('Doc_Dt')->nullable();
            $table->string('Doc_DtAr', 20)->nullable();
            $table->boolean('status')->default(1);
            $table->date('RcvngPur_Dt')->nullable();
            $table->date('Pym_Dt')->nullable();
            $table->bigInteger('Custm_Inv')->nullable();
            $table->smallInteger('Reftyp_No')->nullable();
            $table->bigInteger('Ref_No')->nullable();
            $table->bigInteger('Ref_No2')->nullable();
            $table->smallInteger('To_BrNO')->nullable();
            $table->smallInteger('To_Store')->nullable();
            $table->smallInteger('Mrkt_No')->nullable();
            $table->smallInteger('Period_Time')->nullable();
            $table->smallInteger('Pym_No')->nullable();
            $table->smallInteger('Slm_No')->nullable();
            $table->smallInteger('City_No')->nullable();
            $table->bigInteger('Cstm_No')->nullable();
            $table->bigInteger('Sup_No')->nullable();
            $table->string('Sup_Inv', 20)->nullable();
            $table->string('SubCstm_Filno', 20)->nullable();
            $table->string('Notes', 100)->nullable();
            $table->smallInteger('Curncy_No')->nullable();
            $table->float('ExchangeRate', 8)->nullable();
            $table->float('Tot_Sal', 8)->nullable();
            $table->float('Tot_Pur', 8)->nullable();
            $table->float('Tot_Cost', 8)->nullable();
            $table->float('Tot_Disc', 8)->nullable();
            $table->float('Tot_Prct', 8)->nullable();
            $table->float('Tot_ODisc', 8)->nullable();
            $table->float('Tot_OPrct', 8)->nullable();
            $table->float('Tot_Disc2', 8)->nullable();
            $table->float('Tot_Prct2', 8)->nullable();
            $table->float('Tot_customs', 8)->nullable();
            $table->float('Tot_Expens', 8)->nullable();
            $table->float('Tot_Exp', 8)->nullable();
            $table->float('Net', 8)->nullable();
            $table->float('Paid', 8)->nullable();
            $table->float('Credit', 8)->nullable();
            $table->float('Return_Mony', 8)->nullable();
            $table->float('Bonus_val', 8)->nullable();
            $table->float('FcTot_Sal', 8)->nullable();
            $table->float('FcTot_Pur', 8)->nullable();
            $table->float('FcTot_Cost', 8)->nullable();
            $table->float('FcTot_Disc', 8)->nullable();
            $table->float('FcTot_ODisc', 8)->nullable();
            $table->float('FcNet', 8)->nullable();
            $table->float('SExpens', 8)->nullable();
            $table->float('Expens1', 8)->nullable();
            $table->float('Expens2', 8)->nullable();
            $table->float('Expens3', 8)->nullable();
            $table->float('Expens4', 8)->nullable();
            $table->float('Expens5', 8)->nullable();
            $table->float('Expens6', 8)->nullable();
            $table->float('Expens7', 8)->nullable();
            $table->string('Sup_VchrNo', 20)->nullable();
            $table->integer('Credit_Days')->nullable();
            $table->string('Dlv_Ord_No', 20)->nullable();
            $table->smallInteger('Ret_Status')->nullable();
            $table->bigInteger('JV_No')->nullable();
            $table->smallInteger('Ac_Ty')->nullable();
            $table->smallInteger('Doc_Procs')->nullable();
            $table->string('Doc_Post', 8)->nullable();
            $table->float('Rcpt_Value', 8)->nullable();
            $table->smallInteger('Print_No')->nullable();
            $table->float('Tpur_Exp', 8)->nullable();
            $table->float('Tothr_Price', 8)->nullable();
            $table->bigInteger('Acc_InvAdj')->nullable();
            $table->float('SpecialDiscount', 8)->nullable();
            $table->boolean('CashInvoice')->nullable();
            $table->boolean('SpecialDiscountInvoice')->nullable();
            $table->string('Notes1', 100)->nullable();
            $table->float('Taxp_ExtraHdr', 8)->nullable();
            $table->float('Taxv_ExtraHdr', 8)->nullable();
            $table->float('AfterDiscount', 8)->nullable();
            $table->smallInteger('Tax_Allow')->nullable();
            $table->bigInteger('Tax_Acc')->nullable();
            $table->smallInteger('User_Id')->nullable();
            $table->string('Doc_Time', 20)->nullable();
            $table->string('updt_date', 10)->nullable();

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
        Schema::dropIfExists('invlodhdr');
    }
}
