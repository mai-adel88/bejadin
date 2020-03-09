<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Hrcmplictype extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hrcmplictype', function (Blueprint $table) {
            $table->increments('ID_NO');
            $table->smallInteger('CmplicTyp_No')->nullable();
            $table->string('CmplicTyp_NmAr', 50)->nullable();
            $table->string('CmplicTyp_NmEn', 50)->nullable();
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
        Schema::dropIfExists('hrcmplictype');
    }
}
