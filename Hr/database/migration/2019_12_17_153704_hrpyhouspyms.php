<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Hrpyhouspyms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hrpyhouspyms', function (Blueprint $table) {
            $table->increments('ID_NO');
            $table->smallInteger('Huspym_No')->nullable();
            $table->string('Huspym_NmAr', 50)->nullable();
            $table->string('Huspym_NmEn', 50)->nullable();
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
        Schema::dropIfExists('hrpyhouspyms');
    }
}
