<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGLAstJrntypsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gLastjrntyp', function (Blueprint $table) {
            $table->increments('ID_NO');
            $table->bigInteger('Jr_Ty')->nullable();
            $table->string('Jrty_NmAr', 30)->nullable();
            $table->string('Jrty_NmEn', 30)->nullable();
            $table->boolean('active')->default(1);
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
        Schema::dropIfExists('gLastjrntyp');
    }
}
