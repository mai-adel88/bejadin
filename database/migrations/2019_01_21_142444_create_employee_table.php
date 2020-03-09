<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name_ar');
            $table->string('name_en');
            $table->date('beginning_date')->nullable();
            $table->date('end_date')->nullable();
            $table->date('renew_date')->nullable();
            $table->enum('salary_type',[0,1])->nullable();
            $table->string('salary')->nullable();
            $table->string('transition_allowance')->nullable();
            $table->string('housing_allowance')->nullable();
            $table->string('food_allowance')->nullable();
            $table->string('other_allowances')->nullable();
            $table->enum('work_type',[0,1,2,3])->nullable();
            $table->string('number_rest')->nullable();
            $table->enum('work_status',[0,1,2])->nullable();
            $table->enum('payment_methods',[0,1,2])->nullable();
            $table->string('workhour_count')->nullable();
            $table->string('hour_payment')->nullable();
            $table->string('employee_ticket')->nullable();
            $table->string('ticket_class')->nullable();
            $table->string('children_ticket')->nullable();
            $table->tinyInteger('sales_officer')->default(0);
            $table->integer('sales_number')->nullable();
            $table->string('percentage')->nullable();
            $table->unsignedInteger('branches_id')->nullable();
            $table->unsignedInteger('companybanks_id')->nullable();
            $table->string('company_banks_num')->nullable();
            $table->unsignedInteger('employeebanks_id')->nullable();
            $table->string('employee_banks_num')->nullable();
            $table->string('employee_banks_branches')->nullable();
            $table->string('debtor')->default(0);
            $table->string('creditor')->default(0);
            $table->string('accounts_receivable')->nullable();
            $table->unsignedInteger('tree_id')->nullable();
            $table->unsignedInteger('operation_id')->default(5);
            $table->string('status')->default(1);
            $table->string('statusreport')->default(3);
            $table->unsignedInteger('cc_id')->nullable();
            $table->string('cc_type')->default(0);
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
        Schema::dropIfExists('drivers');
    }
}
