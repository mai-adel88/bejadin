<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAstsupctgsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('astsupctgs', function (Blueprint $table) {
            $table->increments('ID_No');
            $table->integer('Supctg_No')->nullable();
            $table->string('Supctg_Nmar')->nullable();
            $table->string('Supctg_Nmen')->nullable();
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
        Schema::dropIfExists('astsupctgs');
    }
}
