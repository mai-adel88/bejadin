<?php

use Illuminate\Database\Seeder;

class permissions extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            [
                'name' => 'create',
                'guard_name' => 'admin',
            ],[
                'name' => 'edit',
                'guard_name' => 'admin',
            ],[
                'name' => 'delete',
                'guard_name' => 'admin',
            ],[
                'name' => 'student',
                'guard_name' => 'admin',
            ],[
                'name' => 'single',
                'guard_name' => 'admin',
            ],[
                'name' => 'company',
                'guard_name' => 'admin',
            ],[
                'name' => 'flight',
                'guard_name' => 'admin',
            ],[
                'name' => 'driver',
                'guard_name' => 'admin',
            ],[
                'name' => 'reports',
                'guard_name' => 'admin',
            ],
        ]);
    }
}
