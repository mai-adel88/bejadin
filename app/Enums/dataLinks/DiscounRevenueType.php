<?php

namespace App\Enums\dataLinks;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

final class DiscounRevenueType extends Enum implements LocalizedEnum
{
    const revenue = 0;
    const Discount = 1;
}
