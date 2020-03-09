<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class hr extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('hrs')->insert([
            [
                'name' => 'Sallam',
                'email' => 'admin@admin.com',
                'password' => bcrypt('123456'),
                'Cmp_ID' => 1,
            ]
        ]);
    }
}
