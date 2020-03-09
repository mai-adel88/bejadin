<?php

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

final class BloodType extends Enum implements LocalizedEnum
{
    const O = 0;
    const Om = 1;
    const A = 2;
    const Am = 3;
    const B = 4;
    const Bm = 5;
    const AB = 6;
    const ABm = 7;
}
