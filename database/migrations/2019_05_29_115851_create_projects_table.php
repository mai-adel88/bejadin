<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name_ar')->nullable();
            $table->string('name_en')->nullable();
            $table->string('contract_number')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('fax_number')->nullable();
            $table->string('email')->nullable();
            $table->string('responsible_person')->nullable();
            $table->string('warehouse')->nullable();
//            $table->string('revenue')->nullable();
//            $table->string('expenses')->nullable();
            $table->unsignedInteger('customer_id')->nullable();
            $table->foreign('customer_id')->references('id')->on('employees');
            $table->integer('tree_id')->unsigned()->nullable();
            $table->foreign('tree_id')->references('id')->on('departments');
            $table->unsignedInteger('cc_id')->nullable();
            $table->foreign('cc_id')->references('id')->on('glccs');
            $table->unsignedInteger('operation_id')->default(3);
            $table->foreign('operation_id')->references('id')->on('operations');
            $table->string('project_title')->nullable();
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
        Schema::dropIfExists('projects');
    }
}
