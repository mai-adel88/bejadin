<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHrDprtmntLoctnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hr_dprtmnt_loctns', function (Blueprint $table) {
            $table->increments('ID_No');
            $table->integer('Actv_No')->nullable();
            $table->integer('Cmp_No')->nullable();
            $table->integer('DepmLoc_No')->nullable();
            $table->integer('Parnt_DepmLoc')->nullable();
            $table->integer('Level_No')->nullable();
            $table->string('DepmLoc_NmAr')->nullable();
            $table->string('DepmLoc_NmEn')->nullable();
            $table->integer('Level_Status')->nullable();
            $table->integer('Ownr_No')->nullable();
            $table->integer('DepmLoc_Actv')->default(1); // فعال / غير فعال 
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
        Schema::dropIfExists('hr_dprtmnt_loctns');
    }
}
