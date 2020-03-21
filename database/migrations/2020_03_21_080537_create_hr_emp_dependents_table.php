<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateHrEmpDependentsTable extends Migration {

    public function up()
    {
        Schema::create('hr_emp_dependents', function(Blueprint $table) {
            $table->increments('ID_No');
            $table->integer('Cmp_No')->nullable();
            $table->integer('Emp_No')->nullable();
            $table->integer('Host_No')->nullable();
            $table->integer('Pasprt_No')->nullable(); // رقم جواز السفر للموظف
            $table->string('Host_NmAr1')->nullable();
            $table->string('Host_NmAr2')->nullable();
            $table->string('Host_NmAr3')->nullable();
            $table->string('Host_NmAr4')->nullable();
            $table->string('Host_NmEn1')->nullable();
            $table->string('Host_NmEn2')->nullable();
            $table->string('Host_NmEn3')->nullable();
            $table->string('Host_NmEn4')->nullable();
            $table->string('Host_NmAr')->nullable();
            $table->string('Host_NmEn')->nullable();
            $table->smallInteger('Cntry_No')->nullable();
            $table->smallInteger('Pasprt_Ty')->nullable();
            $table->string('Relation')->nullable();
            $table->date('Birth_dt')->nullable();
            $table->smallInteger('Reljan_No')->nullable();
            $table->string('Job')->nullable();
            $table->smallInteger('Ownr_No')->nullable();
            $table->string('Passprt_No')->nullable();
            $table->date('Passprt_Sdt')->nullable();
            $table->date('Passprt_Edt')->nullable();
            $table->string('Passprt_Plc')->nullable();
            $table->string('Resid_No')->nullable();
            $table->date('Resid_Sdt')->nullable();
            $table->date('Resid_Edt')->nullable();
            $table->string('Resid_Plc')->nullable();
            $table->string('Photo')->nullable();
            $table->smallInteger('In_Job')->nullable();
            $table->integer('In_VisaNo')->nullable();
            $table->date('In_VisaDt')->nullable();
            $table->smallInteger('In_Port')->nullable();
            $table->date('In_Date')->nullable();
            $table->string('In_EntrNo')->nullable();
            $table->string('Out_VisaNo')->nullable();
            $table->date('Out_VisaDt')->nullable();
            $table->smallInteger('Out_Port')->nullable();
            $table->date('Out_Date')->nullable();
            $table->string('Trnsfer_Dt')->nullable();
            $table->string('Trnsfer_OLdNm')->nullable();
            $table->timestamps();

        });
    }

    public function down()
    {
        Schema::drop('hr_emp_dependents')->nullable();
    }
}
