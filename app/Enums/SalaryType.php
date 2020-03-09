<?php

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

final class SalaryType extends Enum implements LocalizedEnum
{
    const monthly = 0;
    const daily = 1;
}
