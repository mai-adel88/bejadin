<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Hrmaincmpnam extends Migration
{
    public function up()
    {
        Schema::create('hrmaincmpnam', function(Blueprint $table) {
            $table->increments('ID_NO');
            $table->smallInteger('Cmp_No')->nullable();
            $table->smallInteger('Cmp_Activity')->nullable();
            $table->smallInteger('Local_Lang')->nullable();
            $table->smallInteger('Sys_SetupNo')->nullable();
            $table->string('Cmp_ShrtNm', 50)->nullable();
            $table->smallInteger('Start_Month')->nullable();
            $table->smallInteger('Start_Year')->nullable();
            $table->smallInteger('End_Month')->nullable();
            $table->smallInteger('End_year')->nullable();
            $table->smallInteger('Start_MonthHij')->nullable();
            $table->smallInteger('Start_YearHij')->nullable();
            $table->smallInteger('End_MonthHij')->nullable();
            $table->smallInteger('End_yearHij')->nullable();
            $table->string('Cmp_NmAr', 200)->nullable();
            $table->string('Cmp_NmAr2', 200)->nullable();
            $table->string('Cmp_NmEn', 200)->nullable();
            $table->string('Cmp_NmEn2', 100)->nullable();
            $table->string('Cmp_Tel', 25)->nullable();
            $table->string('Cmp_Fax', 15)->nullable();
            $table->string('Cmp_Email', 100)->nullable();
            $table->string('Cmp_AddAr', 200)->nullable();
            $table->string('Cmp_AddEn', 200)->nullable();
            $table->string('Picture', 200)->nullable();
            $table->integer('Activity_Type')->nullable();
            $table->string('CR_No', 20)->nullable();
            $table->string('CC_No', 20)->nullable();
            $table->string('License_No', 20)->nullable();
            $table->string('Tax_No', 20)->nullable();
            $table->float('TaxExtra_Prct')->nullable();
            $table->string('Prnt_Forms', 4)->nullable();
            $table->smallInteger('NofDay_SalryMnth')->nullable();
            $table->smallInteger('NofDay_PationHldy')->nullable();
            $table->smallInteger('HldIssue_Depend')->default(0)->nullable();
            $table->smallInteger('Hldestm_Depend')->default(0)->nullable();
            $table->smallInteger('Dep_Budge')->default(0)->nullable();
            $table->smallInteger('Emp_App')->default(0)->nullable();
            $table->smallInteger('Job_Under')->default(0)->nullable();
            $table->smallInteger('Nation_Effect')->default(0)->nullable();
            $table->smallInteger('Allw_RenewResidnc')->default(0)->nullable();
            $table->smallInteger('NofDys_RenewResidnc')->default(0)->nullable();
            $table->smallInteger('AllCmp_RenewResidnc')->default(0)->nullable();
            $table->smallInteger('CmpNo_RenewResidnc')->nullable();
            $table->smallInteger('Allw_RenewPassport')->default(0)->nullable();
            $table->smallInteger('NofDys_RenewPassport')->default(0)->nullable();
            $table->smallInteger('AllCmp_RenewPassport')->default(0)->nullable();
            $table->smallInteger('CmpNo_RenewPassport')->nullable();
            $table->smallInteger('Allw_RenewDrivLicns')->default(0)->nullable();
            $table->smallInteger('NofDys_RenewDrivLicns')->default(0)->nullable();
            $table->smallInteger('AllCmp_RenewDrivLicns')->default(0)->nullable();
            $table->smallInteger('CmpNo_RenewDrivLicns')->nullable();
            $table->smallInteger('Allw_ReneWorkPermit')->default(0)->nullable();
            $table->smallInteger('NofDys_ReneWorkPermit')->default(0)->nullable();
            $table->smallInteger('AllCmp_ReneWorkPermit')->default(0)->nullable();
            $table->smallInteger('CmpNo_ReneWorkPermit')->nullable();
            $table->smallInteger('Allw_RenewCarlicense')->default(0)->nullable();
            $table->smallInteger('NofDys_RenewCarlicense')->default(0)->nullable();
            $table->smallInteger('AllCmp_RenewCarlicense')->default(0)->nullable();
            $table->smallInteger('CmpNo_RenewCarlicense')->nullable();
            $table->smallInteger('Allw_RenewCarInsurance')->default(0)->nullable();
            $table->smallInteger('NofDys_RenewCarInsurance')->default(0)->nullable();
            $table->smallInteger('AllCmp_RenewCarInsurance')->default(0)->nullable();
            $table->smallInteger('CmpNo_RenewCarInsurance')->nullable();
            $table->smallInteger('Month_Post1')->nullable();
            $table->smallInteger('Month_Post2')->nullable();
            $table->smallInteger('Month_Post3')->nullable();
            $table->smallInteger('Month_Post4')->nullable();
            $table->smallInteger('Month_Post5')->nullable();
            $table->smallInteger('Month_Post6')->nullable();
            $table->smallInteger('Month_Post7')->nullable();
            $table->smallInteger('Month_Post8')->nullable();
            $table->smallInteger('Month_Post9')->nullable();
            $table->smallInteger('Month_Post10')->nullable();
            $table->smallInteger('Month_Post11')->nullable();
            $table->smallInteger('Month_Post12')->nullable();
            $table->timestamps();

        });
    }

    public function down()
    {
        Schema::drop('hrmaincmpnam');
    }
}
