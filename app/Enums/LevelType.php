<?php

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

final class LevelType extends Enum implements LocalizedEnum
{
    const accounts = 1;
    const cost_centers = 2;
    const final_account = 3;
    const center_analysis = 4;
}
