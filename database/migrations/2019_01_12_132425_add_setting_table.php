<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSettingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sitename_ar');
            $table->string('sitename_en');
            $table->string('logo')->nullable();
            $table->string('icon')->nullable();
            $table->string('email')->nullable();
            $table->string('main_lang')->default('en');
            $table->longText('description')->nullable();
            $table->longText('description_ar')->nullable();
            $table->longText('contact_description')->nullable();
            $table->longText('contact_description_ar')->nullable();
            $table->longText('keyword')->nullable();
            $table->enum('status',['open','close'])->default('open');
            $table->enum('currancy',[0,1,2])->default('0');
            $table->longText('message_maintenance')->nullable();
            $table->string('addriss')->nullable();
            $table->string('phone')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('googel')->nullable();
            $table->string('linkedin')->nullable();
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
        Schema::dropIfExists('setting');
    }
}
