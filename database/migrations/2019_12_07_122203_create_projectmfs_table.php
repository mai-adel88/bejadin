<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProjectmfsTable extends Migration {

	public function up()
	{
		Schema::create('projectmfs', function(Blueprint $table) {
			$table->increments('ID_No');
			$table->timestamps();
			$table->integer('Cmp_No')->unsigned()->nullable();
			$table->integer('Prj_No')->unsigned()->nullable();
			$table->integer('Prj_Parnt')->nullable();
			$table->boolean('Level_Status')->nullable();
			$table->integer('Level_No')->nullable();
			$table->integer('Costcntr_No')->nullable();
			$table->boolean('Prj_Actv')->nullable();
			$table->date('Prj_Year')->nullable();
			$table->enum('Prj_Status',[0,1,2,3,4,5,6])->nullable();   //PrjStatus Enum
			$table->date('Tr_Dt')->nullable();
			$table->date('Tr_DtAr')->nullable();
			$table->string('Prj_NmAr')->nullable();
			$table->string('Prj_NmEn', 250)->nullable();
			$table->string('Prj_Refno', 20)->nullable();
			$table->integer('Prj_Categ')->nullable();
			$table->float('Prj_Value', 50,10)->nullable();
			$table->integer('Cstm_No')->nullable();
			$table->integer('Slm_No')->nullable();
			$table->integer('Country_No')->nullable();
			$table->integer('City_No')->nullable();
			$table->integer('Area_No')->nullable();
			$table->integer('Acc_DB')->nullable();
            $table->integer('Acc_CR')->nullable();
            $table->float('FBal_Db',50,10)->nullable();
			$table->float('FBal_Cr',50,10)->nullable();
			$table->float('DB11',50,10)->nullable();
			$table->float('DB12',50,10)->nullable();
			$table->float('DB13',50,10)->nullable();
			$table->float('DB14',50,10)->nullable();
			$table->float('DB15',50,10)->nullable();
			$table->float('DB16',50,10)->nullable();
			$table->float('DB17',50,10)->nullable();
			$table->float('DB18',50,10)->nullable();
			$table->float('DB20',50,10)->nullable();
			$table->float('DB21',50,10)->nullable();
			$table->float('DB22',50,10)->nullable();
			$table->float('CR11',50,10)->nullable();
			$table->float('CR12',50,10)->nullable();
			$table->float('CR13',50,10)->nullable();
			$table->float('CR14',50,10)->nullable();
			$table->float('CR15',50,10)->nullable();
			$table->float('CR16',50,10)->nullable();
			$table->float('CR17',50,10)->nullable();
			$table->float('CR18',50,10)->nullable();
			$table->float('CR19',50,10)->nullable();
			$table->float('CR20',50,10)->nullable();
			$table->float('CR21',50,10)->nullable();
			$table->float('CR22',50,10)->nullable();
			$table->integer('Brn_No')->nullable();
			$table->integer('Dlv_Stor')->nullable();
			$table->float('Ordr_Value',50,10)->nullable();
			$table->integer('Ordr_No')->nullable();
			$table->date('Ordr_Dt')->nullable();
			$table->string('Prj_Adr', 200)->nullable();
			$table->string('Prj_Tel', 15)->nullable();
			$table->string('Prj_Mobile', 15)->nullable();
			$table->string('Prj_Mobile1', 15)->nullable();
			$table->date('Nxt_Vst')->nullable();
			$table->date('Mnth_Year')->nullable();
			$table->string('Cntct_Prsn1')->nullable();
			$table->string('Cntct_Prsn2')->nullable();
			$table->string('TitL1')->nullable();
			$table->string('TitL2')->nullable();
			$table->string('Mobile1')->nullable();
			$table->string('Mobile2')->nullable();
			$table->string('Email1')->nullable();
			$table->string('Email2')->nullable();
			$table->date('Opn_Date')->nullable();
			$table->time('Opn_Time')->nullable();
			$table->integer('User_ID')->nullable();
			$table->date('Updt_Date')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('projectmfs');
	}
}
