<?php

namespace App\Enums\dataLinks;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

final class LimitationsType extends Enum implements LocalizedEnum
{
    const dailyLimitations = 0;
    const NoticeDebt = 1;
    const NoticeCreditor = 2;
    const SalesInvoice = 3;
    const PurchaseInvoice = 4;
    const RevenuePayable = 5;
    const ExchangeOfMaterials = 6;
}
