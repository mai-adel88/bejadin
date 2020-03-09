<?php

use Illuminate\Database\Seeder;

class model_has_roles extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('model_has_roles')->insert([
            [
                'role_id' => '1',
                'model_type' => 'App\Admin',
                'model_id' => '1',
            ],[
                'role_id' => '2',
                'model_type' => 'App\Admin',
                'model_id' => '1',
            ],[
                'role_id' => '3',
                'model_type' => 'App\Admin',
                'model_id' => '1',
            ]
            ]);
    }
}
