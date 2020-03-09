<?php

namespace App\Enums\dataLinks;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

final class InvoiceSaleType extends Enum implements LocalizedEnum
{
    const purchaseInvoice = 0;
    const saleInvoice = 1;
    const other = 2;
}
