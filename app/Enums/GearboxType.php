<?php

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

final class GearboxType extends Enum implements LocalizedEnum
{
    const automatic = 0;
    const manual = 1;
}
