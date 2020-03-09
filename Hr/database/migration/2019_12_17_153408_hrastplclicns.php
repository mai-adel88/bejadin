<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Hrastplclicns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hrastplclicns', function (Blueprint $table) {
            $table->increments('ID_NO');
            $table->smallInteger('State_No');
            $table->string('State_NmAr', 50)->nullable();
            $table->string('State_NmEn', 50)->nullable();
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
        Schema::dropIfExists('hrastplclicns');
    }
}
