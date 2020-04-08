<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateHrEmphldTable extends Migration {

	public function up()
	{
		Schema::create('hr_emphld', function(Blueprint $table) {
			$table->increments('ID_No');
			$table->integer('Cmp_No')->nullable();
			$table->integer('Emp_No')->nullable();
			$table->integer('SubCmp_No')->nullable();
			$table->date('Start_Date')->nullable();
			$table->float('Blnc_UnPaid')->nullable();
			$table->float('Blnc_Paid')->nullable();
			$table->smallInteger('HLdy_Ty')->nullable();
			$table->smallInteger('Hld_Ern_Prod')->nullable();
			$table->smallInteger('Start_Paid')->nullable();
			$table->smallInteger('Start_UnPaid')->nullable();
			$table->smallInteger('Open_Balnc')->nullable();
			$table->smallInteger('Curnt_Balnc')->nullable();
			$table->date('today_date')->nullable();
			$table->date('Start_Lasthld')->nullable();
			$table->date('Last_Ret_Dt')->nullable();
			$table->smallInteger('Unpad_Nxtyer')->nullable();
			$table->smallInteger('Pat_First')->nullable();
			$table->smallInteger('Pat_Hld')->nullable();
			$table->smallInteger('Inc_Typ')->nullable();
			$table->smallInteger('Inc_Yer')->nullable();
			$table->smallInteger('Inc_days')->nullable();
			$table->smallInteger('Tkt_Val')->nullable();
			$table->string('Tkt_Pth')->nullable();
			$table->date('Hold_Estmdt')->nullable();
			$table->date('Hold_Lstdt')->nullable();
			$table->string('HLd_Period')->nullable();
			$table->float('Hold_Blnc')->nullable();
			$table->float('Hold_Ndys')->nullable();
			$table->date('Last_Hldstdt')->nullable();
			$table->date('Last_Hldendt')->nullable();
			$table->date('Last_Hldrtdt')->nullable();
			$table->float('Last_Hldprod')->nullable();
			$table->smallInteger('Last_Hldrqno')->nullable();
			$table->smallInteger('Last_Hldrqty')->nullable();
			$table->smallInteger('Hld_No1')->nullable();
			$table->float('Hld_Prod1')->nullable();
			$table->date('Hld_Stdt1')->nullable();
			$table->date('Hld_Rtdt1')->nullable();
			$table->date('Hld_Endt1')->nullable();
			$table->float('Isu_Bln1')->nullable();
			$table->integer('Hld_No2')->nullable();
			$table->float('Hld_Prod2')->nullable();
			$table->date('Hld_Stdt2')->nullable();
			$table->date('Hld_Endt2')->nullable();
			$table->date('Hld_Rtdt2')->nullable();
			$table->float('Isu_Bln2')->nullable();
			$table->integer('Hld_No3')->nullable();
			$table->float('Hld_Prod3')->nullable();
			$table->date('Hld_Stdt3')->nullable();
			$table->date('Hld_Rtdt3')->nullable();
			$table->date('Hld_Endt3')->nullable();
			$table->float('Isu_Bln3')->nullable();
			$table->integer('Hld_No4')->nullable();
			$table->float('Hld_Prod4')->nullable();
			$table->date('Hld_Stdt4')->nullable();
			$table->date('Hld_Rtdt4')->nullable();
			$table->date('Hld_Endt4')->nullable();
			$table->float('Isu_Bln4')->nullable();
			$table->integer('Hld_No5')->nullable();
			$table->string('Hld_Prod5')->nullable();
			$table->date('Hld_Stdt5')->nullable();
			$table->date('Hld_Rtdt5')->nullable();
			$table->date('Hld_Endt5')->nullable();
            $table->float('Isu_Bln5')->nullable();
            $table->smallInteger('Work_Yer')->nullable();
            $table->smallInteger('Increase_Days')->nullable();
            $table->string('Notes')->nullable();
            $table->string('Visainout_ID')->nullable();
            $table->string('Visainout_ActDt')->nullable();
            $table->string('Visainout_ExtDt')->nullable();
            $table->string('Visainout_Period')->nullable();
            $table->string('Visainout_Type')->nullable();

            $table->integer('Cnt_Period')->nullable();
            $table->date('DueDt_Hldy')->nullable();
			$table->date('DueDt_HldyHij')->nullable();
			$table->date('DueDt_Tkt')->nullable();
			$table->date('DueDt_TktHij')->nullable();
            $table->integer('HldTrnsp_No')->nullable();
			$table->integer('Tkt_No')->nullable();
			$table->string('Tkt_Class')->nullable();
			$table->string('Tkt_Sector')->nullable();
			$table->integer('HldTrnsp_No1')->nullable();
			$table->integer('Tkt_No1')->nullable();
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
            $table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('hr_emphld');
	}
}
