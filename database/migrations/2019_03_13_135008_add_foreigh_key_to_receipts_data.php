<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeighKeyToReceiptsData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('receipts_data', function (Blueprint $table) {
            $table->foreign('receipts_id')->references('id')->on('receipts');
            $table->foreign('operation_id')->references('id')->on('operations');
            $table->foreign('tree_id')->references('id')->on('departments');
//            $table->foreign('fundsBanks_id')->references('id')->on('departments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('receipts_data', function (Blueprint $table) {
            //
        });
    }
}
