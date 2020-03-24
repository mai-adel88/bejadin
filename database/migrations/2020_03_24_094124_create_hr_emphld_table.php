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
			$table->float('Blnc_UnPaid')->nullable();
			$table->float('Blnc_Paid')->nullable();
			$table->smallInteger('Hld_Ern')->nullable();
			$table->smallInteger('Hld_Ern_Prod')->nullable();
			$table->smallInteger('Start_Paid')->nullable();
			$table->smallInteger('Start_UnPaid')->nullable();
			$table->smallInteger('Open_Balnc')->nullable();
			$table->smallInteger('Curnt_Balnc')->nullable();
			$table->date('Start_Lasthld')->nullable();
			$table->date('Last_Ret_Dt')->nullable();
			$table->smallInteger('Unpad_Nxtyer')->nullable();
			$table->smallInteger('Inc_Typ')->nullable();
			$table->smallInteger('Inc_Yer')->nullable();
			$table->smallInteger('Inc_days')->nullable();
			$table->smallInteger('Tkt_No')->nullable();
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
            $table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('hr_emphld');
	}
}
