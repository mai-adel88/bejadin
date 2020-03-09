<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLimitationsTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('limitations_type', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name_ar')->nullable();
            $table->string('name_en')->nullable();
            $table->unsignedInteger('tree_id')->nullable();
            $table->unsignedInteger('operation_id')->nullable();
            $table->unsignedInteger('limitations_id')->nullable();
            $table->unsignedInteger('cc_id')->nullable();
            $table->string('relation_id')->nullable();
            $table->string('debtor')->default(0);
            $table->string('creditor')->default(0);
            $table->string('note')->nullable();
            $table->string('note_en')->nullable();
            $table->string('status')->default(0);
            $table->string('invoice_id')->nullable();
            $table->string('receipt_number')->nullable();
            $table->enum('month_for',[1,2,3,4,5,6,7,8,9,10,11,12])->nullable();
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
        Schema::dropIfExists('limitationsType');
    }
}
