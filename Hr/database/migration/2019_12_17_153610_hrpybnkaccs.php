<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Hrpybnkaccs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hrpybnkaccs', function (Blueprint $table) {
            $table->increments('ID_NO');
            $table->integer('Bnk_No')->nullable();
            $table->string('Bnk_NmAr', 50)->nullable();
            $table->string('Bnk_NmEn', 50)->nullable();
            $table->string('Bnk_Acc', 20)->nullable();
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
        Schema::dropIfExists('hrpybnkaccs');
    }
}
