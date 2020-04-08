<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHREmpadrsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hr_empadrs', function (Blueprint $table) {
            $table->increments('ID_No');
            $table->timestamps();
            $table->integer('Cmp_No')->nullable();
			$table->integer('Emp_No')->nullable();
			$table->integer('Cntry_No')->nullable();    //خارج المملكه  //الدولة
			$table->string('Phon_Cntry')->nullable();   //تليفون
			$table->string('Emp_Adrs')->nullable();     //العنوان
			$table->string('Name_Nerst')->nullable();   //اسم احد الأقارب
			$table->string('Phon_nerst')->nullable();
			$table->string('Adrs_Nerst')->nullable();
			$table->string('Notes')->nullable();
			$table->integer('Emp_City')->nullable();
			$table->string('Emp_Street')->nullable();
			$table->integer('Stat_No')->nullable();
			$table->string('Emp_Phon')->nullable();
			$table->string('Emp_Mobile')->nullable();
			$table->string('E_Email')->nullable();
			$table->string('RefPerson_Nm')->nullable();
			$table->string('RefPerson_Mobile')->nullable();
			$table->integer('Emp_Adrsno')->nullable();
			$table->string('Blck')->nullable();
			$table->string('Buld_Typ')->nullable();
			$table->string('Lane')->nullable();
			$table->string('Divsn_No')->nullable();
			$table->string('Flor_No')->nullable();
			$table->string('Hous_No')->nullable();
			$table->string('Hous_Entry')->nullable();
			$table->string('Hous_Adrs')->nullable();
			$table->string('Hous_Phon')->nullable();
			$table->string('Park_Buldno')->nullable();
			$table->string('Park_Cardno')->nullable();
			$table->string('ParkSt_DT')->nullable();
			$table->string('ParkEn_Dt')->nullable();
			$table->string('ParkBuld_Nm')->nullable();
			$table->string('Park_Florno')->nullable();

            // $table->foreign('Emp_City')->references('id')->on('cities')
            //     ->onDelete('restrict')
            //     ->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hr_empadrs');
    }
}
