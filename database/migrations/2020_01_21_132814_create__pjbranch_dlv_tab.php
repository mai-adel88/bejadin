<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePjbranchDlvTab extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pjbranchdlv', function (Blueprint $table) {
            $table->increments('ID_No');
            $table->integer('Brn_No')->nullable();
            $table->integer('Dlv_Stor')->nullable();
            $table->string('Dlv_NmAr', 50)->nullable();
            $table->string('Dlv_NmEn', 50)->nullable();
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
        Schema::dropIfExists('pjbranchdlv');
    }
}
