<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHREmpAttachTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('HREmpAttach', function (Blueprint $table) {
            $table->increments('ID_NO');
            $table->integer('Cmp_No')->nullable(); // رقم الشركة
            $table->bigInteger('Emp_No')->nullable(); // رقم الموظف
            $table->bigInteger('Attch_No')->nullable(); // رقم المرفق
            $table->smallInteger('Ln_No')->nullable(); // رقم المرفق
            $table->smallInteger('Attch_Ty')->nullable(); // نوع المرفق HrAstAttachType 
            $table->string('Attch_Desc')->nullable(); // وصف المرفق
            $table->string('Photo')->nullable(); // صورة المرفق 
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
        Schema::dropIfExists('HREmpAttach');
    }
}
