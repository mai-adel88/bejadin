<?php

namespace App\Enums;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;
final class ReligionType extends Enum implements LocalizedEnum
{
    const Muslim = 1;
    const Christian = 2;
    const Jewish = 3;
    const Others = 4;
}
