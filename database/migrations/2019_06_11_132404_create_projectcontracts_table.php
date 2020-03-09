<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectcontractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projectcontracts', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('branche_id')->nullable();
            $table->foreign('branche_id')->references('id')->on('branches');
            $table->unsignedInteger('project_id')->nullable();
            $table->foreign('project_id')->references('id')->on('projects');
            $table->string('date_hijri')->nullable();

            $table->date('date')->nullable();

            $table->longText('note')->nullable();
            $table->longText('note_en')->nullable();

            $table->date('Date_contract')->nullable();
            $table->date('beginning_contract')->nullable();
            $table->date('End_contract')->nullable();
            $table->string('period_contract')->nullable();

            $table->date('start_implementation')->nullable();
            $table->date('end_implementation')->nullable();
            $table->date('start_warranty')->nullable();
            $table->date('end_warranty')->nullable();

            $table->string('number_employees')->nullable();
            $table->string('Hour_employee')->nullable();
            $table->string('number_months')->nullable();
            $table->string('monthly_payment')->nullable();
            $table->string('revenue_measurement')->nullable();
            $table->string('expenses_measurement')->nullable();
            $table->string('cost_limit')->nullable();
            $table->string('actual_cost')->nullable();
            $table->string('Estimated_value')->nullable();
            $table->string('contract_value')->nullable();
            $table->string('deviation_value')->nullable();
            $table->string('Bank_guarantee_number')->nullable();


            $table->string('warranty_history')->nullable();
            $table->string('amount_guarantee')->nullable();
            $table->string('warranty_issued')->nullable();
            $table->string('warranty_issued_en')->nullable();



            $table->string('comprehensive_insurance')->nullable();
            $table->string('contractor_insurance')->nullable();
            $table->string('reference_retirement')->nullable();
            $table->unsignedInteger('subscriber_id')->nullable();
            $table->foreign('subscriber_id')->references('id')->on('subscriptions');

            $table->string('management_expenses_percentage')->nullable();
            $table->string('management_expenses')->nullable();
            $table->string('department_expenses_percentage')->nullable();
            $table->string('department_expenses')->nullable();

            $table->string('warranty_period_percentage')->nullable();
            $table->string('warranty_period')->nullable();
            $table->string('financial_expenses_percentage')->nullable();
            $table->string('financial_expenses')->nullable();

            $table->string('subtotal_percentage')->nullable();
            $table->string('subtotal')->nullable();
            $table->string('net_deviation_percentage')->nullable();
            $table->string('net_deviation')->nullable();

            $table->string('total_collection')->nullable();
            $table->string('current_balance')->nullable();




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
        Schema::dropIfExists('projectcontracts');
    }
}
