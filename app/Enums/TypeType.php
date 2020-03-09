<?php

namespace App\Enums;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;
final class TypeType extends Enum implements LocalizedEnum
{
    const student = 1;
    const single = 2;
    const company = 3;
    const domestic_flights = 4;
}
