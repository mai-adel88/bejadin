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
        $this->call(MainBranch::class);
        $this->call(SchLAstdiscTy::class);
        $this->call(setting::class);
        $this->call(admin::class);
        $this->call(permissions::class);
        $this->call(roles::class);
        $this->call(model_has_permissions::class);
        $this->call(model_has_roles::class);
        $this->call(visitor::class);
        $this->call(countiestableseeder::class);
        $this->call(SchLAstgrades::class);
        $this->call(SchLAstclass::class);
        $this->call(hr::class);
        $this->call(MainCompanySeeder::class);


//        $this->call(SchLAstrooms::class);
        // $this->call(AstAstBlood::class);
        // $this->call(SchLAstperiod::class);
        // $this->call(SCLStudntParnt::class);
        // $this->call(User::class);
        //$this->call(SchlStudntMfs::class);
        // $this->call(StudntTrnsaction::class);
        // $this->call(fees::class);
        // $this->call(branche::class);
        // $this->call(operations::class);

        // $this->call(citiestableseeder::class);
        // $this->call(starestableseeder::class);
        // $this->call(carsstyle::class);
        // $this->call(carstype::class);
        // $this->call(owner::class);
        // $this->call(bus::class);
        // $this->call(driver::class);
        // $this->call(levels::class);
        // $this->call(limitationReceipt::class);
        // $this->call(grades::class);
        // $this->call(seasons::class);
        // $this->call(students::class);
    }
}
