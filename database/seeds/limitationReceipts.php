<?php

use Illuminate\Database\Seeder;

class limitation_Receipts extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('limitationreceipts')->insert([
            [
                'name_ar' => 'سند قبض نقدي',
                'name_en' => 'receipts in Cash',
                'limitationReceiptsId' => '0',
                'type' => '0',
            ],
            [
                'name_ar' => 'سند قبض شيك',
                'name_en' => 'receipts in check',
                'limitationReceiptsId' => '1',
                'type' => '0',
            ],
            [
                'name_ar' => 'سند صرف نقدي',
                'name_en' => 'receipts out cash',
                'limitationReceiptsId' => '2',
                'type' => '0',
            ],
            [
                'name_ar' => 'سند صرف شيك',
                'name_en' => 'receipts out check',
                'limitationReceiptsId' => '3',
                'type' => '0',
            ],
            [
                'name_ar' => 'قيد يوميه',
                'name_en' => 'daily',
                'limitationReceiptsId' => '0',
                'type' => '1',
            ],
            [
                'name_ar' => 'اشعار مدين',
                'name_en' => 'Notice Debt',
                'limitationReceiptsId' => '1',
                'type' => '1',
            ],
            [
                'name_ar' => 'اشعار دائن',
                'name_en' => 'Notice Creditor',
                'limitationReceiptsId' => '2',
                'type' => '1',
            ],
            [
                'name_ar' => 'فاتورة المبيعات',
                'name_en' => 'sales',
                'limitationReceiptsId' => '3',
                'type' => '1',
            ],
            [
                'name_ar' => 'فاتورة المشتريات',
                'name_en' => 'purchases',
                'limitationReceiptsId' => '4',
                'type' => '1',
            ],
            [
                'name_ar' => 'ايراد مستحق',
                'name_en' => 'Revenue Payable',
                'limitationReceiptsId' => '5',
                'type' => '1',
            ],
            [
                'name_ar' => 'صرف مواد',
                'name_en' => 'Exchange Of Materials',
                'limitationReceiptsId' => '6',
                'type' => '1',
            ],
            [
                'name_ar' => 'قيد افتتاحي',
                'name_en' => 'Opening Entry',
                'limitationReceiptsId' => '0',
                'type' => '2',
            ]
        ]);
    }
}
