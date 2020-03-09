<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Hrpyhoustyps extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hrpyhoustyps', function (Blueprint $table) {
            $table->increments('ID_NO');
            $table->smallInteger('HusTyp_No')->nullable();
            $table->string('HusTyp_NmAr', 50)->nullable();
            $table->string('HusTyp_NmEn', 50)->nullable();
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
        Schema::dropIfExists('hrpyhoustyps');
    }
}
