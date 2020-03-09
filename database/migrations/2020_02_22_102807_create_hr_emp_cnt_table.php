<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateHrEmpCntTable extends Migration {

	public function up()
	{
		Schema::create('hr_emp_cnt', function(Blueprint $table) {
			$table->increments('ID_No');
			$table->timestamps();
			$table->integer('Cmp_No')->nullable();
			$table->enum('Emp_Type', [1,2,3])->nullable();
			$table->integer('Emp_No')->nullable();
			$table->integer('SubCmp_No')->nullable();
			$table->integer('Emp_SubNo')->nullable();
			$table->integer('Depm_No')->nullable();
			$table->integer('Job_Stu')->nullable();
			$table->integer('Job_No')->nullable();
			$table->string('Job_Date')->nullable();
			$table->enum('Shift_Type', [1,2,3,4,5])->nullable();
			$table->enum('Salary_Class_No', [1,2,3,4,5,6,7])->nullable();
			$table->smallInteger('Huspym_No')->nullable();
			$table->enum('HusTyp_No',[1,2,3,4,5,6])->nullable();
			$table->enum('Gender', [0,1])->nullable();
			$table->enum('Specl_Need', [0,1])->nullable();
			$table->integer('Specl_NeedTyp')->nullable();
			$table->enum('Cntry_No', [1,2])->nullable();
			$table->smallInteger('Reljan')->nullable();
			$table->integer('Job_SubNo')->nullable();
			$table->integer('Pymnt_No')->nullable();
			$table->integer('Cnt_Period')->nullable();
			$table->string('Emp_NmAr')->nullable();
			$table->string('Emp_NmEn')->nullable();
			$table->float('Bsc_Salary')->nullable();
			$table->float('Hous_Alw')->nullable();
			$table->float('Trnsp_Alw')->nullable();
			$table->float('Food_Alw')->nullable();
			$table->float('Other_Alw')->nullable();
			$table->float('Add_Alw')->nullable();
			$table->float('ALw1')->nullable();
			$table->float('ALw2')->nullable();
			$table->float('ALw3')->nullable();
			$table->float('ALw4')->nullable();
			$table->float('ALw5')->nullable();
			$table->float('Gross_Salary')->nullable();
			$table->float('Wrk_Hour')->nullable();
			$table->float('Wrk_CostHour')->nullable();
			$table->float('Total_Wrk_CostHour')->nullable();
			$table->tinyInteger('Wrk_OvrTime')->nullable();
			$table->float('OvrTime_Rate')->nullable();
			$table->float('OvrTime_HR1')->nullable();
			$table->float('OvrTime_HR2')->nullable();
			$table->float('OvrTime_HR3')->nullable();
			$table->float('Lunch_hour')->nullable();
			$table->date('Cnt_Stdt')->nullable();
			$table->date('Cnt_StdtHij')->nullable();
			$table->float('Cnt_Endt')->nullable();
			$table->date('Cnt_EndtHij')->nullable();
			$table->date('Cnt_Nwdt')->nullable();
			$table->date('Cnt_NwdtHij')->nullable();
			$table->date('Start_Date')->nullable();
			$table->date('Start_DateHij')->nullable();
			$table->date('On_WorkDt')->nullable();
			$table->date('On_WorkDtHij')->nullable();
			$table->date('Dection_ExpireDt')->nullable();
			$table->decimal('Bouns_Prct')->nullable();
			$table->string('Car_No')->nullable();
			$table->float('Start_Paid')->nullable();
			$table->float('Start_UnPaid')->nullable();
			$table->float('Fbal_Db')->nullable();
			$table->float('Fbal_CR')->nullable();
			$table->integer('Acc_NoDb1')->nullable();
			$table->integer('Acc_Loans')->nullable();
			$table->integer('Bnk_No')->nullable();
			$table->integer('Sub_Bnk')->nullable();
			$table->string('BnkEmp_Acntno')->nullable();
			$table->string('Bnk_Acntno')->nullable();
			$table->integer('Prj_No')->nullable();
			$table->integer('Loc_No')->nullable();
			$table->integer('PjLoc_No')->nullable();
			$table->integer('Gov_Cntrct')->nullable();
			$table->date('DueDt_Hldy')->nullable();
			$table->date('DueDt_HldyHij')->nullable();
			$table->date('DueDt_Tkt')->nullable();
			$table->date('DueDt_TktHij')->nullable();
			$table->integer('HLdy_Ty')->nullable();
			$table->integer('HldTrnsp_No')->nullable();
			$table->integer('Tkt_No')->nullable();
			$table->string('Tkt_Class')->nullable();
			$table->string('Tkt_Sector')->nullable();
			$table->integer('HldTrnsp_No1')->nullable();
			$table->integer('Tkt_No1')->nullable();
			$table->string('HLd_Period')->nullable();
			$table->string('Tkt_Class1')->nullable();
			$table->string('Tkt_Sector1')->nullable();
			$table->integer('HldTrnsp_No2')->nullable();
			$table->string('Tkt_No2')->nullable();
			$table->string('Tkt_Class2')->nullable();
			$table->string('Tkt_Sector2')->nullable();
			$table->tinyInteger('Tkt_Ty1')->nullable();
			$table->tinyInteger('Tkt_Ty2')->nullable();
			$table->tinyInteger('Tkt_Ty3')->nullable();
			$table->tinyInteger('Tkt_Ty4')->nullable();
			$table->tinyInteger('Tkt_Ty5')->nullable();
			$table->tinyInteger('Tkt_Ty6')->nullable();
			$table->tinyInteger('Tkt_Ty7')->nullable();
            $table->decimal('CR11')->nullable();                //حركة يناير مدين
            $table->decimal('CR12')->nullable();
            $table->decimal('CR13')->nullable();
            $table->decimal('CR14')->nullable();
            $table->decimal('CR15')->nullable();
            $table->decimal('CR16')->nullable();
            $table->decimal('CR17')->nullable();
            $table->decimal('CR18')->nullable();
            $table->decimal('CR19')->nullable();
            $table->decimal('CR20')->nullable();
            $table->decimal('CR21')->nullable();
            $table->decimal('CR22')->nullable();
            $table->decimal('DB11')->nullable();
            $table->decimal('DB12')->nullable();
            $table->decimal('DB13')->nullable();
            $table->decimal('DB14')->nullable();
            $table->decimal('DB15')->nullable();
            $table->decimal('DB16')->nullable();
            $table->decimal('DB17')->nullable();
            $table->decimal('DB18')->nullable();
            $table->decimal('DB19')->nullable();
            $table->decimal('DB20')->nullable();
            $table->decimal('DB21')->nullable();
            $table->decimal('DB22')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('hr_emp_cnt');
	}
}
