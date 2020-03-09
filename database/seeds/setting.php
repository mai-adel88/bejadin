<?php

use Illuminate\Database\Seeder;

class setting extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            'sitename_ar' => 'arabic',
            'sitename_en' => 'english',

        ]);
    }
}
