<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Hrhldtrnsps extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hrhldtrnsps', function (Blueprint $table) {
            $table->increments('ID_NO');
            $table->smallInteger('HldTrnsp_No')->nullable();
            $table->string('HldTrnsp_Ar', 50)->nullable();
            $table->string('HldTrnsp_En', 50)->nullable();
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
        Schema::dropIfExists('hrhldtrnsps');
    }
}
