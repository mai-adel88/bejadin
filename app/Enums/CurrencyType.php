<?php

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

final class CurrencyType extends Enum implements LocalizedEnum
{
    const SAR = 0;
    const USD = 1;
    const EUR = 2;
}
