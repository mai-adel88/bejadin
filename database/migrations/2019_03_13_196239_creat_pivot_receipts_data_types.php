<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatPivotReceiptsDataTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receipts_data_types', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('receipts_type_id')->nullable();
            $table->foreign('receipts_type_id')->references('id')->on('receipts_type');
            $table->unsignedInteger('receipts_data_id')->nullable();
            $table->foreign('receipts_data_id')->references('id')->on('receipts_data');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('receipts_data_types');
    }
}
