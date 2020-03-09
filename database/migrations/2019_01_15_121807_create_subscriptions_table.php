<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name_ar');
            $table->string('name_en')->nullable();
            $table->string('email')->nullable();
            $table->string('address')->nullable();
            $table->unsignedInteger('branches_id')->nullable();
            $table->string('status')->default(1);
            $table->string('phone_1')->nullable();
            $table->string('phone_2')->nullable();
            $table->string('phone_3')->nullable();
            $table->string('phone_4')->nullable();
            $table->string('per_status')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('tax_num')->nullable();
            $table->tinyInteger('Discounts')->nullable();
            $table->tinyInteger('Commissions')->nullable();
            $table->mediumText('note')->nullable();
            $table->string('debtor')->default(0);
            $table->string('creditor')->default(0);
            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedInteger('admin_id')->nullable();
            $table->unsignedInteger('operation_id')->default(2);
            $table->unsignedInteger('countries_id')->nullable();
            $table->unsignedInteger('city_id')->nullable();
            $table->unsignedInteger('employee_id')->nullable();
            $table->unsignedInteger('activity_type_id')->nullable();
            $table->unsignedInteger('cc_id')->nullable();
            $table->string('cc_type')->default(0);
            $table->string('credit_limit')->nullable();
            $table->string('repayment_period')->nullable();
            $table->string('discount')->nullable();
            $table->unsignedInteger('state_id')->nullable();
            $table->unsignedInteger('tree_id')->nullable();
            $table->timestamps();
        });
    }
//   subsystem_id   setnull casacade
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscriptions');
    }
}
