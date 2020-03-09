<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHrcmplicplcTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hrcmplicplc', function (Blueprint $table) {
            $table->increments('ID_NO');
            $table->smallInteger('CmpLicplc_No')->nullable();
            $table->string('CmpLicplc_NmAr', 50)->nullable();
            $table->string('CmpLicplc_NmEn', 50)->nullable();
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
        Schema::dropIfExists('hrcmplicplc');
    }
}
