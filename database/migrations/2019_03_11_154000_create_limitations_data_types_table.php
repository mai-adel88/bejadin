<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLimitationsDataTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('limitations_data_types', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('limitations_type_id')->nullable();
            $table->foreign('limitations_type_id')->references('id')->on('limitations_type');
            $table->unsignedInteger('limitations_data_id')->nullable();
            $table->foreign('limitations_data_id')->references('id')->on('limitations_datas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('limitations_data_types');
    }
}
