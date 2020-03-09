<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePyjobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pyjobs', function (Blueprint $table) {
            $table->increments('ID_No');
            $table->timestamps();
            $table->integer('Job_No')->nullable();
            $table->string('Job_NmAr')->nullable();
            $table->string('Job_NmEn')->nullable();
            $table->integer('Job_Typ')->nullable();
            $table->boolean('job_cmpny')->nullable()->default(0);   //الوظيفه بالشركه
            $table->boolean('job_gov')->nullable()->default(0);     //الوظيفه بالحكومه
            $table->boolean('job_desc')->nullable()->default(0);    //التخصص للوظيفه
            $table->boolean('job_tech')->nullable()->default(0);    //التخصص المهني

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pyjobs');
    }
}
