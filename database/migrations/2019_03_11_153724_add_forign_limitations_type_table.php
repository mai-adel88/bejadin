<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForignLimitationsTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('limitations_type', function (Blueprint $table) {
            $table->foreign('tree_id')->references('id')->on('departments');
            $table->foreign('operation_id')->references('id')->on('operations');
            $table->foreign('limitations_id')->references('id')->on('limitations');
            $table->foreign('cc_id')->references('id')->on('glccs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('limitations_type', function (Blueprint $table) {
            //
        });
    }
}
