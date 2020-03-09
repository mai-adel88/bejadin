<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForignLimitationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('limitations', function (Blueprint $table) {
            $table->foreign('branche_id')->references('id')->on('branches');
            $table->foreign('limitationsType_id')->references('id')->on('limitationReceipts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('limitations', function (Blueprint $table) {
            //
        });
    }
}
