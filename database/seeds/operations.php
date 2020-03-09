<?php

use Illuminate\Database\Seeder;

class operations extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('operations')->insert([
            [
                'name_ar' => 'موردين',
                'name_en' => 'Suppliers',
                'receipt' => '1',
            ],
            [
                'name_ar' => 'عملاء',
                'name_en' => 'Customers',
                'receipt' => '2',
            ],
            [
                'name_ar' => 'مشروعات',
                'name_en' => 'Projects',
                'receipt' => '0',
            ],
            [
                'name_ar' => 'حسابات',
                'name_en' => 'Accounts',
                'receipt' => '1',
            ],
            [
                'name_ar' => 'موظفين',
                'name_en' => 'Employees',
                'receipt' => '1',
            ],
            [
                'name_ar' => 'الصندوق',
                'name_en' => 'Cashiers',
                'receipt' => '0',
            ],
            [
                'name_ar' => 'البنوك',
                'name_en' => 'Banks',
                'receipt' => '0',
            ],
            [
                'name_ar' => 'اشعار خصم',
                'name_en' => 'Minus Document',
                'receipt' => '0',
            ],
            [
                'name_ar' => 'اشعار اضافه',
                'name_en' => 'Plus Document',
                'receipt' => '0',
            ],
            [
            'name_ar' => 'مقاولين الباطن',
            'name_en' => 'Contracts',
            'receipt' => '1',
            ]
        ]);
    }
}
