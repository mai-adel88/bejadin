<?php

namespace App\Enums\dataLinks;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

final class BondRestrictionsType extends Enum implements LocalizedEnum
{
    const inCash = 0;
    const inCheck = 1;
    const outCash = 2;
    const outCheck = 3;
//    const start = 5;
//    const adjustment = 6;
//    const inExchange = 7;
//    const outExchange = 8;
//    const notificationMinus = 9;
//    const notificationPluse = 10;
//    const discountInVoucher = 11;
//    const discountOutVoucher = 12;
//    const store = 13;
//    const purchasesReturn = 15;
//    const salesReturn = 17;
    const daily = 4;
    const NoticeDebt = 5;
    const NoticeCreditor = 6;
    const sales = 7;
    const purchases = 8;
    const RevenuePayable = 9;
    const ExchangeOfMaterials = 10;
    const start = 12;
}
