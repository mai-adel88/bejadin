<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Hrastempstuts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hrastempstuts', function (Blueprint $table) {
            $table->increments('ID_NO');
            $table->integer('Emp_stu');
            $table->string('Emp_StunmAr', 15)->nullable();
            $table->string('Emp_StunmEn', 15)->nullable();
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
        Schema::dropIfExists('hrastempstuts');
    }
}
