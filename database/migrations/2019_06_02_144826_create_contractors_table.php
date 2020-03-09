<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContractorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contractors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name_ar')->nullable();
            $table->string('name_en')->nullable();
            $table->integer('contractor_type_id')->unsigned()->nullable();
            $table->foreign('contractor_type_id')->references('id')->on('contractors_types');
            $table->text('address')->nullable();
            $table->integer('tree_id')->unsigned()->nullable();
            $table->foreign('tree_id')->references('id')->on('departments');
            $table->unsignedInteger('operation_id')->default(10);
            $table->foreign('operation_id')->references('id')->on('operations');
            $table->integer('country_id')->unsigned()->nullable();
            $table->foreign('country_id')->references('id')->on('countries');
            $table->string('currency')->nullable();
            $table->string('credit_limit')->nullable();
            $table->integer('account_number')->nullable();
            $table->integer('debtor')->default(0);
            $table->integer('creditor')->default(0);
            $table->string('status')->default(2);
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
        Schema::dropIfExists('contractors');
    }
}
