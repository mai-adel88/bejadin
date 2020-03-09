<?php

namespace App\Enums\dataLinks;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

final class IncomeListType extends Enum implements LocalizedEnum
{
    const budget = 0;
    const tradeAccount = 1;
    const operatingAccount = 3;
}
