<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLimitationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('limitations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('limitationId')->nullable();
            $table->unsignedInteger('branche_id')->nullable();
            $table->dateTime('date')->nullable();
            $table->unsignedInteger('limitationsType_id')->nullable();
            $table->string('invoice_id')->nullable();
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
        Schema::dropIfExists('limitations');
    }
}
