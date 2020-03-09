<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('section_id')->unsigned()->nullable();
            $table->foreign('section_id')->references('id')->on('branches');
            $table->string('date')->nullable();
            $table->string('higri_date')->nullable();
            $table->integer('project_id')->unsigned()->nullable();
            $table->foreign('project_id')->references('id')->on('projects');
            $table->integer('contractor_id')->unsigned()->nullable();
            $table->foreign('contractor_id')->references('id')->on('contractors');
            $table->integer('Contract_reference')->nullable();
            $table->integer('contract_number')->nullable();
            $table->integer('subscriber_id')->unsigned()->nullable();
            $table->foreign('subscriber_id')->references('id')->on('subscriptions');
            $table->string('statement_ar')->nullable();
            $table->string('statement_en')->nullable();
            $table->string('contract_date')->nullable();
            $table->string('contract_start')->nullable();
            $table->string('contract_end')->nullable();
            $table->string('contract_period')->nullable();
            $table->string('implementation_start')->nullable();
            $table->string('implementation_end')->nullable();
            $table->string('warranty_start')->nullable();
            $table->string('warranty_end')->nullable();
            $table->integer('employees_number')->nullable();
            $table->integer('employee_hour_work')->nullable();
            $table->integer('months_number')->nullable();
            $table->integer('monthly_payment')->nullable();
            $table->integer('contract_value')->nullable();
            $table->integer('estimated_value')->nullable();
            $table->integer('deviation_value')->nullable();
            $table->integer('downpayment')->nullable();
            $table->integer('warranty_expenses')->nullable();
            $table->integer('insurance_value')->nullable();
            $table->integer('contract_value_customer')->nullable();
            $table->integer('subcontracts_value')->nullable();
            $table->integer('total_payments')->nullable();
            $table->integer('current_balance')->nullable();
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
        Schema::dropIfExists('contracts');
    }
}
