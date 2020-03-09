<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name_ar');
            $table->string('name_en');
            $table->string('addriss');
            $table->string('responsible');
            $table->string('email');
            $table->string('credit_limit');
            $table->string('debtor');
            $table->string('creditor');
            $table->unsignedInteger('country_id')->nullable();
            $table->enum('currency',[0,1]);
            $table->string('phone1');
            $table->string('phone2');
            $table->string('fax');
            $table->string('account_num');
            $table->string('tax_num');
            $table->unsignedInteger('tree_id')->nullable();
            $table->unsignedInteger('branches_id')->nullable();
            $table->unsignedInteger('operation_id')->default(1);
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
        Schema::dropIfExists('suppliers');
    }
}
