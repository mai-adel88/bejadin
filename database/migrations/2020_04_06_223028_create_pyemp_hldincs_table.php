<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePyempHldincsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pyemp_hldincs', function (Blueprint $table) {
            $table->increments('ID_No');
            $table->integer('Emp_No');
            $table->smallInteger('Work_Yer');
            $table->smallInteger('Increase_Days');
            $table->string('Notes');
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
        Schema::dropIfExists('pyemp_hldincs');
    }
}
