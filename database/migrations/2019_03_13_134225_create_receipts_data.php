<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReceiptsData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receipts_data', function (Blueprint $table) {
            $table->increments('id');
            $table->string('debtor')->nullable();
            $table->string('creditor')->nullable();
            $table->string('receipt_number')->nullable();
            $table->string('check')->nullable();
            $table->dateTime('checkDate')->nullable();
            $table->string('person')->nullable();
            $table->string('taken')->nullable();
            $table->string('invoice_id')->nullable();
            $table->unsignedInteger('receipts_id')->nullable();
            $table->unsignedInteger('tree_id')->nullable();
            $table->unsignedInteger('operation_id')->nullable();
            $table->string('note')->nullable();
            $table->string('note_en')->nullable();
//            $table->unsignedInteger('fundsBanks_id')->nullable();
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
        Schema::dropIfExists('receipts_data');
    }
}
