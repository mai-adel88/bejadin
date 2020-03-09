<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMtsClosAccsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('MtsClosAcc', function (Blueprint $table) {
            $table->increments('ID_No');
            $table->integer('Cmp_No');
            $table->bigInteger('CLsacc_No');
            $table->bigInteger('Parnt_Acc');
            $table->integer('Level_Status');
            $table->integer('Level_No');
            $table->integer('Main_Rpt');
            $table->string('CLsacc_NmAr', 200);
            $table->string('CLsacc_NmEn', 200);
            $table->integer('Prnt_YN');
            $table->string('Prnt_Sorc', 100);
            $table->float('Fbal_DB', 50, 10);
            $table->float('Fbal_CR', 50, 10);
            $table->float('DB11', 50, 10);
            $table->float('CR11', 50, 10);
            $table->float('DB12', 50, 10);
            $table->float('CR12', 50, 10);
            $table->float('DB13', 50, 10);
            $table->float('CR13', 50, 10);
            $table->float('DB14', 50, 10);
            $table->float('CR14', 50, 10);
            $table->float('DB15', 50, 10);
            $table->float('CR15', 50, 10);
            $table->float('DB16', 50, 10);
            $table->float('CR16', 50, 10);
            $table->float('DB17', 50, 10);
            $table->float('CR17', 50, 10);
            $table->float('DB18', 50, 10);
            $table->float('CR18', 50, 10);
            $table->float('DB19', 50, 10);
            $table->float('CR19', 50, 10);
            $table->float('DB20', 50, 10);
            $table->float('CR20', 50, 10);
            $table->float('DB21', 50, 10);
            $table->float('CR21', 50, 10);
            $table->float('DB22', 50, 10);
            $table->float('CR22', 50, 10);

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
        Schema::dropIfExists('MtsClosAcc');
    }
}
