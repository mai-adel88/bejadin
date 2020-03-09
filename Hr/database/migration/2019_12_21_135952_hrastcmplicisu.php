<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Hrastcmplicisu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hrastcmplicisu', function (Blueprint $table) {
            $table->increments('ID_NO');
            $table->smallInteger('CmpLicisu_No')->nullable();
            $table->string('CmpLicisu_NmAr', 100)->nullable();
            $table->string('CmpLicisu_NmEn', 100)->nullable();
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
        Schema::dropIfExists('hrastcmplicisu');
    }
}
