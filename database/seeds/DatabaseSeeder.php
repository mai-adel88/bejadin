<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {


        $this->call(admin::class);
//        $this->call(branche::class);
//        $this->call(setting::class);
//        $this->call(visitor::class);
//        $this->call(operations::class);
//        $this->call(countiestableseeder::class);
//        $this->call(permissions::class);
//        $this->call(roles::class);
//        $this->call(model_has_permissions::class);
//        $this->call(model_has_roles::class);
//        $this->call(levels::class);
//        $this->call(limitation_Receipts::class);

    }
}
