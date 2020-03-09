<?php

use Illuminate\Database\Seeder;

class roles extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            [
                'name' => 'writer',
                'guard_name' => 'admin',
            ],[
                'name' => 'reader',
                'guard_name' => 'admin',
            ],[
                'name' => 'admin',
                'guard_name' => 'admin',
            ],
        ]);
    }
}
