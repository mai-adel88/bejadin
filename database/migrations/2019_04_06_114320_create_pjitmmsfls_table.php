<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePjitmmsflsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pjitmmsfls', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('month',[1,2,3,4,5,6,7,8,9,10,11,12])->nullable();
            $table->string('year')->nullable();
            $table->string('debtor')->nullable();
            $table->string('creditor')->nullable();
            $table->string('current_balance')->nullable();
            $table->string('estimated_balance')->nullable();
            $table->enum('type',[1,2])->nullable();
            $table->unsignedInteger('tree_id')->nullable();
            $table->unsignedInteger('cc_id')->nullable();
            $table->foreign('tree_id')->references('id')->on('departments');
            $table->foreign('cc_id')->references('id')->on('glccs');
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
        Schema::dropIfExists('pjitmmsfls');
    }
}
