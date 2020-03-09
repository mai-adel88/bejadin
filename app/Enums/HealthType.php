<?php

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

final class HealthType extends Enum implements LocalizedEnum
{
    const Normal = 0;
    const SpecialNeeds = 1;
}
