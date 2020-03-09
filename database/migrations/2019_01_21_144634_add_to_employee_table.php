<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddToEmployeeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->foreign('tree_id')->references('id')->on('departments');
            $table->foreign('companybanks_id')->references('id')->on('departments');
            $table->foreign('employeebanks_id')->references('id')->on('departments');
            $table->foreign('operation_id')->references('id')->on('operations');
            $table->foreign('branches_id')->references('id')->on('branches');
            $table->foreign('cc_id')->references('id')->on('glccs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('drivers', function (Blueprint $table) {
            //
        });
    }
}
