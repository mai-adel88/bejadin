<?php

namespace App\Enums;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;
final class ReligionType extends Enum implements LocalizedEnum
{
    const Muslim = 0;
    const Christian = 1;
    const Jewish = 2;
    const Others = 3;
}
