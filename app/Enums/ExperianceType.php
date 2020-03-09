<?php

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

final class ExperianceType extends Enum implements LocalizedEnum
{
    const LessThanYear = 0;
    const OneYear = 1;
    const TwoYears = 2;
    const ThreeYears = 3;
    const FourYears = 4;
    const FiveYears = 5;
    const MoreThanFive = 6;
}
