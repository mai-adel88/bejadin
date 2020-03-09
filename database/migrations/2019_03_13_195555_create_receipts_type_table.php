<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReceiptsTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receipts_type', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name_ar')->nullable();
            $table->string('name_en')->nullable();
            $table->unsignedInteger('tree_id')->nullable();
            $table->unsignedInteger('operation_id')->nullable();
            $table->unsignedInteger('receipts_id')->nullable();
            $table->unsignedInteger('cc_id')->nullable();
            $table->string('relation_id')->nullable();
            $table->string('debtor')->nullable();
            $table->string('creditor')->nullable();
            $table->string('note')->nullable();
            $table->string('note_en')->nullable();
            $table->string('status')->default(0);
            $table->string('tax')->nullable();
            $table->string('invoice_id')->nullable();
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
        Schema::dropIfExists('receipts_datas');
    }
}
