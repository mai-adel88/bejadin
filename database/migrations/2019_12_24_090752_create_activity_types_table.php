<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivityTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activitytypes', function (Blueprint $table) {
            $table->increments('ID_No');

            $table->integer('Actvty_No')->nullable();
            $table->string('Name_Ar', 50)->nullable();
            $table->string('Name_En', 50)->nullable();
            $table->integer('NofCmp')->nullable();

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
        Schema::dropIfExists('ActivityTypes');
    }
}
