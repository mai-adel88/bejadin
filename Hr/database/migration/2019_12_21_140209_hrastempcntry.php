<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Hrastempcntry extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hrastempcntry', function (Blueprint $table) {
            $table->increments('ID_NO');
            $table->smallInteger('Cntry_No')->nullable();
            $table->string('Cntry_NmAr', 50)->nullable();
            $table->string('Cntry_NmEn', 50)->nullable();
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
        Schema::dropIfExists('hrastempcntry');
    }
}
