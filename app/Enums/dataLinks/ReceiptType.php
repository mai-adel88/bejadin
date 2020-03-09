<?php

namespace App\Enums\dataLinks;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

final class ReceiptType extends Enum implements LocalizedEnum
{
    // const catchReceipt = 0;
    // const catchReceiptCheck = 1;
    // const receipt = 2;
    // const ReceiptCheck = 3;

    const open = 1; // قيد افتتاحى
    const cache_in = 2; //سند قبض نقدى
    const cheq_in = 3;//سند قبض شيك
    const cache_out = 4;//سند صرف نقدى
    const cheq_out = 5;//سند صرف شيك
    const daily = 6;// قيد يوميه
    const future_sale = 7;//مبيعات اجله
    const cache_sale = 8;//مبيعات نقديه
    const future_purchase = 9;//مشتريات اجله
    const cache_purchase = 10;//مشتريات نقديه
    const trnsform_in = 11;//وارد تحويل
    const transform_out = 12;//منصرف تحويل
    const add_equation = 13;//تسويه بالاضافه
    const sub_equation = 14;//تسويه بالخصم
    const debt_notify = 18;//اشعار مدين
    const credit_notify = 19;//اشعار دائن
}
