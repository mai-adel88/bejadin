<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGlccsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('glccs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('branch_id')->nullable();
            $table->string('name_ar');
            $table->string('name_en');
            $table->string('code')->nullable();
            $table->unsignedInteger('level_id')->nullable();
            $table->enum('levelType',[1,2,3,4])->default(2);
            $table->enum('type',[0,1])->nullable();
            $table->enum('status',[0,1])->nullable();
            $table->string('creditor')->default(0);
            $table->string('debtor')->default(0);
            $table->string('estimite')->nullable();
            $table->string('description')->nullable();
            $table->unsignedInteger('parent_id')->nullable();
            $table->foreign('branch_id')->references('id')->on('branches');
            $table->foreign('level_id')->references('id')->on('levels');
            $table->foreign('parent_id')->references('id')->on('departments')->onDelete('cascade');
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
        Schema::dropIfExists('glccs');
    }
}
