<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('branch_id')->nullable();
            $table->string('dep_name_ar');
            $table->string('dep_name_en');
            $table->string('code')->nullable();
            $table->enum('levelType',[1,2,3,4])->default(1);
            $table->unsignedInteger('level_id')->nullable();
            $table->enum('type',[0,1])->nullable();
            $table->enum('status',[0,1])->nullable();
            $table->enum('category',[0,1])->nullable();
            $table->unsignedInteger('operation_id')->nullable();
            $table->unsignedInteger('cc_id')->nullable();
            $table->string('cc_type')->default(0);
            $table->enum('budget',[0,1,2,3])->nullable();
            $table->string('creditor')->default(0);
            $table->string('debtor')->default(0);
            $table->string('estimite')->nullable();
            $table->string('description')->nullable();
            $table->unsignedInteger('parent_id')->nullable();
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
        Schema::dropIfExists('departments');
    }
}
