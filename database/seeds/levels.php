<?php

use Illuminate\Database\Seeder;

class levels extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('levels')->insert([
            [
                'type' => '1',
                'name_ar' => 'المستوي الأول',
                'name_en' => 'first level',
                'format' => '1',
                'length' => '1',
                'levelId' => '1',
                'parent_id' => null
            ],
            [
                'type' => '1',
                'name_ar' => 'المستوي الثاني',
                'name_en' => 'second level',
                'format' => '101',
                'length' => '2',
                'levelId' => '2',
                'parent_id' => '1'
            ],
            [
                'type' => '1',
                'name_ar' => 'المستوي الثالث',
                'name_en' => 'third level',
                'format' => '10101',
                'length' => '2',
                'levelId' => '3',
                'parent_id' => '2'
            ],
            [
                'type' => '1',
                'name_ar' => 'المستوي الرابع',
                'name_en' => 'fourth level',
                'format' => '1010101',
                'length' => '2',
                'levelId' => '4',
                'parent_id' => '3'
            ],
            [
                'type' => '1',
                'name_ar' => 'المستوي الخامس',
                'name_en' => 'fifth level',
                'format' => '101010101',
                'length' => '2',
                'levelId' => '5',
                'parent_id' => '4'
            ],
            [
                'type' => '1',
                'name_ar' => 'المستوي السادس',
                'name_en' => 'sixth level',
                'format' => '10101010101',
                'length' => '2',
                'levelId' => '6',
                'parent_id' => '5'
            ],
            [
                'type' => '1',
                'name_ar' => 'المستوي السابع',
                'name_en' => 'seventh level',
                'format' => '1010101010101',
                'length' => '2',
                'levelId' => '7',
                'parent_id' => '6'
            ],
            [
                'type' => '2',
                'name_ar' => 'المستوي الأول',
                'name_en' => 'first level',
                'format' => '1',
                'length' => '1',
                'levelId' => '1',
                'parent_id' => null
            ],
            [
                'type' => '2',
                'name_ar' => 'المستوي الثاني',
                'name_en' => 'second level',
                'format' => '101',
                'length' => '2',
                'levelId' => '2',
                'parent_id' => '8'
            ],
            [
                'type' => '2',
                'name_ar' => 'المستوي الثالث',
                'name_en' => 'third level',
                'format' => '10101',
                'length' => '2',
                'levelId' => '3',
                'parent_id' => '9'
            ],
            [
                'type' => '3',
                'name_ar' => 'المستوي الأول',
                'name_en' => 'first level',
                'format' => '1',
                'length' => '1',
                'levelId' => '1',
                'parent_id' => null
            ],
            [
                'type' => '3',
                'name_ar' => 'المستوي الثاني',
                'name_en' => 'second level',
                'format' => '101',
                'length' => '2',
                'levelId' => '2',
                'parent_id' => '11'
            ],
            [
                'type' => '3',
                'name_ar' => 'المستوي الثالث',
                'name_en' => 'third level',
                'format' => '10101',
                'length' => '2',
                'levelId' => '3',
                'parent_id' => '12'
            ],
            [
                'type' => '4',
                'name_ar' => 'المستوي الأول',
                'name_en' => 'first level',
                'format' => '1',
                'length' => '1',
                'levelId' => '1',
                'parent_id' => null
            ],
            [
                'type' => '4',
                'name_ar' => 'المستوي الثاني',
                'name_en' => 'second level',
                'format' => '101',
                'length' => '2',
                'levelId' => '2',
                'parent_id' => '14'
            ],
            [
                'type' => '4',
                'name_ar' => 'المستوي الثالث',
                'name_en' => 'third level',
                'format' => '10101',
                'length' => '2',
                'levelId' => '3',
                'parent_id' => '15'
            ]
        ]);
    }
}
