<?php

use Illuminate\Database\Seeder;

class countiestableseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('countries')->insert([
                    'country_name_ar' => 'السعوديه',
                    'country_name_en' => 'saudi arabia',
                    'mob' => '0020',
                    'code' => '20',
                    'logo' => 'https://cdn3.volusion.com/jhqje.emawp/v/vspfiles/photos/Saudi-Arabia-Flag-2.gif?1355398483',
                ]
        );
    }
}
