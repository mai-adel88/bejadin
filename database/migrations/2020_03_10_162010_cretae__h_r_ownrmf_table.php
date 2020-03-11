<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CretaeHROwnrmfTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('HROwnrmf', function (Blueprint $table) {
            $table->increments('ID_No');
            $table->smallInteger('Ownr_No')->nullable();
            $table->smallInteger('Cntry_No')->nullable();
            $table->smallInteger('Cmp_Typ')->nullable();
            $table->smallInteger('Main_Cmp')->nullable();
            $table->string('Ownr_ID',15)->nullable();
            $table->string('Ownr_Nm',100)->nullable();
            $table->string('Ownr_Nm1',50)->nullable();
            $table->string('Ownr_Nm2',50)->nullable();
            $table->string('Ownr_Nm3',50)->nullable();
            $table->string('Ownr_Nm4',50)->nullable();
            $table->string('Ownr_Nm5',50)->nullable();
            $table->string('Ownr_Sign',50)->nullable();
            $table->string('Trad_Nm',200)->nullable();
            $table->string('Trad_NmEn',200)->nullable();
            $table->smallInteger('Trdtyp_No')->nullable();
            $table->string('Busn_File',40)->nullable();
            $table->string('Busn_Nm',200)->nullable();
            $table->string('Work_File',14)->nullable();
            $table->string('Unq_No',15)->nullable();
            $table->string('Cnt_No',15)->nullable();
            $table->smallInteger('Stat_No')->nullable();
            $table->string('City',15)->nullable();
            $table->string('Blck',20)->nullable();
            $table->string('Strt',20)->nullable();
            $table->string('Buld_Nm',20)->nullable();
            $table->string('Buld_Typ',10)->nullable();
            $table->string('Lane',20)->nullable();
            $table->string('Divsn_No',20)->nullable();
            $table->string('Flor_No',20)->nullable();
            $table->string('Hous_No',10)->nullable();
            $table->string('Hous_Entry',10)->nullable();
            $table->string('Zip_Nm',10)->nullable();
            $table->string('Zip_No',15)->nullable();
            $table->string('Pbox',10)->nullable();
            $table->string('Biger_Tel',15)->nullable();
            $table->string('Fax_Tel',15)->nullable();
            $table->string('Mobil_Tel',15)->nullable();
            $table->string('Tel',200)->nullable();
            $table->string('Wrok_Tel',200)->nullable();
            $table->string('Licen_Endt',200)->nullable();
            $table->string('Civl_No',15)->nullable();
            $table->string('Licen_No',20)->nullable();
            $table->string('Busn_No',15)->nullable();
            $table->string('Licen_Stdt',200)->nullable();
            $table->string('Ownr_Nme1',50)->nullable();
            $table->string('Ownr_Nme2',50)->nullable();
            $table->string('Ownr_Nme3',50)->nullable();
            $table->string('Ownr_Nme4',50)->nullable();
            $table->string('Ownr_Nme5',50)->nullable();
            $table->string('Ownr_Adrs',200)->nullable();
            $table->string('Ownr_Birthdt',10)->nullable();
            $table->string('Sign_Dt',10)->nullable();
            $table->string('Sign_No',10)->nullable();
            $table->string('Civl_Sdt',10)->nullable();
            $table->string('Champ_No',50)->nullable();
            $table->string('Champ_StDt',200)->nullable();
            $table->string('Champ_EdDt',200)->nullable();
            $table->string('Fax',20)->nullable();
            $table->string('Cmp_Aprv',50)->nullable();
            $table->integer('Int_Emp')->nullable();
            $table->integer('Ext_Emp')->nullable();
            $table->integer('Cmp_Status')->nullable();
            $table->integer('Cmp_Place')->nullable();
            $table->string('Ownd_By',100)->nullable();
            $table->string('CmpLicPlc',100)->nullable();
            $table->string('Cmp_Clasfic',100)->nullable();
            $table->smallInteger('cmp_Mngr')->nullable();
            $table->smallInteger('Cmp_ActvType')->nullable();
            $table->string('Cmp_Adrs',200)->nullable();
            $table->string('Cmp_Type',200)->nullable();
            $table->smallInteger('Cmp_Cntry_No')->nullable();
            $table->string('Tot_Capital',200)->nullable();
            $table->string('Cash_Capital',200)->nullable();
            $table->string('Soild_Capital',200)->nullable();
            $table->smallInteger('Creator_No')->nullable();
            $table->smallInteger('Start_Paid')->nullable();
            $table->smallInteger('Stocks_Val')->nullable();
            $table->smallInteger('Stocks_Num')->nullable();
            $table->string('Cmp_Cost')->nullable();
            $table->integer('Cmp_Br')->nullable();
            $table->integer('no_of_prtnr')->nullable();
            $table->integer('Budg_Extra_Ownr')->nullable();
            $table->integer('Budg_Extra_cnt')->nullable();
            $table->integer('Budg_Other_Ownr')->nullable();
            $table->integer('Sub_Cost_Ratio')->nullable();
            $table->string('Cmp_Email',100)->nullable();
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
        Schema::dropIfExists('HROwnrmf');
    }
}
