<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHrastplclicnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hrastplclicns', function (Blueprint $table) {
            $table->increments('ID_NO');
            $table->smallInteger('State_No');
            $table->string('State_NmAr', 50)->nullable();
            $table->string('State_NmEn', 50)->nullable();
            $table->smallInteger('cty_client')->default(0); // عملاء
            $table->smallInteger('cty_resident')->default(0); // اقامة
            $table->smallInteger('cty_drivlic')->default(0); // رخصة القيادة
            $table->smallInteger('cty_jobactv')->default(0); // رخصة مزاولة المهنة
            $table->smallInteger('cty_Nat_id')->default(0); // هوية وطنية
            $table->smallInteger('cty_address')->default(0); // العنوان
            $table->smallInteger('cty_actv')->default(1); // فعال او لا
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
        Schema::dropIfExists('hrastplclicns');
    }
}
