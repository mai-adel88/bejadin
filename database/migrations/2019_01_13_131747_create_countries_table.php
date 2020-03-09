<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('country_name_ar');
            $table->string('country_name_en');
            $table->string('mob')->nullable();
            $table->string('code')->nullable();
            $table->string('logo')->nullable();
            $table->smallInteger('cntry_cst')->default(0);
            $table->smallInteger('cntry_sub')->default(0);
            $table->smallInteger('cntry_emp')->default(0);
            $table->smallInteger('cntry_cmp')->default(0);
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
        Schema::dropIfExists('countries');
    }
}
