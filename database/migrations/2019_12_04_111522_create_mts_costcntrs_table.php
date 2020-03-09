<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMtsCostcntrsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mts_costcntrs', function (Blueprint $table) {
            $table->increments('ID_No');
            $table->integer('Cmp_No')->nullable()->unsigned()->index();//رقم الشركه
            $table->bigInteger('Acc_No')->nullable();//رقم الحساب
            $table->bigInteger('Parnt_Acc')->nullable();//رقم الحساب الرئيسى
            $table->integer('Level_No')->nullable();//رقم المستوى
            $table->boolean('Level_Status')->nullable();//حساب رئيسى - 0 رئيسى - 1 فرعى ENUM
            $table->string('Costcntr_Nmar')->nullable();//اسم الحساب عربى
            $table->string('Costcntr_Nmen')->nullable();//اسم الحساب انجليزى
            $table->bigInteger('Costcntr_No')->nullable();// رقم مركز التكلفة
            $table->float('Fbal_DB', 50, 10)->nullable();//رصيداول المده مدين
            $table->float('Fbal_CR', 50, 10)->nullable();//رصيد اول المده دائن
            $table->float('DB11', 50, 10)->nullable();//حركة ياناير مدين
            $table->float('CR11', 50, 10)->nullable();//حركة يناير دائن
            $table->float('DB12', 50, 10)->nullable();//حركة فبراير مدين
            $table->float('CR12', 50, 10)->nullable();//حركة فبراير دائن
            $table->float('DB13', 50, 10)->nullable();//
            $table->float('CR13', 50, 10)->nullable();//
            $table->float('DB14', 50, 10)->nullable();//
            $table->float('CR14', 50, 10)->nullable();//
            $table->float('DB15', 50, 10)->nullable();//
            $table->float('CR15', 50, 10)->nullable();//
            $table->float('DB16', 50, 10)->nullable();//
            $table->float('CR16', 50, 10)->nullable();//
            $table->float('DB17', 50, 10)->nullable();//
            $table->float('CR17', 50, 10)->nullable();//
            $table->float('DB18', 50, 10)->nullable();//
            $table->float('CR18', 50, 10)->nullable();//
            $table->float('DB19', 50, 10)->nullable();//
            $table->float('CR19', 50, 10)->nullable();//
            $table->float('DB20', 50, 10)->nullable();//
            $table->float('CR20', 50, 10)->nullable();//
            $table->float('DB21', 50, 10)->nullable();//
            $table->float('CR21', 50, 10)->nullable();//
            $table->float('DB22', 50, 10)->nullable();//
            $table->float('CR22', 50, 10)->nullable();//
            $table->integer('Analyticl2_Flag')->nullable();//
            $table->datetime('Updt_Time')->nullable();//
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
        Schema::dropIfExists('mts_costcntrs');
    }
}
