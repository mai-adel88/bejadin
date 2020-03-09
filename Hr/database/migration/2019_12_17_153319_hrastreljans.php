<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Hrastreljans extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hrastreljans', function (Blueprint $table) {
            $table->increments('ID_NO');
            $table->smallInteger('Reljan_No')->nullable();
            $table->string('Reljan_NmAr', 15)->nullable();
            $table->string('Reljan_NmEn', 15)->nullable();
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
        Schema::dropIfExists('hrastreljans');
    }
}
