<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class admin extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            [
                // superAdmin -> can view and perform CRUD to all companies and all branches
                'name' => 'Sallam',
                'email' => 'admin@admin.com',
                'password' => bcrypt('123456'),
                'branches_id' => 1,
                'company_id' => 1,
            ],
            [
                // superAdmin -> can view and perform CRUD to all companies and all branches
                'name' => 'infosas',
                'email' => 'infosas2019@infosasics.com',
                'password' => bcrypt('ics@gits'),
                'branches_id' => 1,
                'company_id' => 1,
            ]
        ]);
    }
}
