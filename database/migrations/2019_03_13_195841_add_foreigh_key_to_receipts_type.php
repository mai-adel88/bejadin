<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeighKeyToReceiptsType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('receipts_type', function (Blueprint $table) {
            $table->foreign('tree_id')->references('id')->on('departments');
            $table->foreign('operation_id')->references('id')->on('operations');
            $table->foreign('receipts_id')->references('id')->on('receipts');
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
        Schema::table('receipts_type', function (Blueprint $table) {
            //
        });
    }
}
