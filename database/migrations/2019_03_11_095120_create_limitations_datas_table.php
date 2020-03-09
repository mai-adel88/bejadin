<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLimitationsDatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('limitations_datas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('debtor')->default(0);
            $table->string('creditor')->default(0);
            $table->string('invoice_id')->nullable();
            $table->unsignedInteger('limitations_id')->nullable();
            $table->string('status')->default(0);
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
        Schema::dropIfExists('limitations_datas');
    }
}
