<?php

use Illuminate\Database\Seeder;

class branche extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('branches')->insert([
            [
                'name_ar' => 'الفرع الرئيسى',
                'name_en' => 'Personal Branche'
            ]
        ]);
    }
}
