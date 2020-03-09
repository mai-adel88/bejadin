<?php

namespace App\Enums;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;

final class PostEnum extends Enum implements LocalizedEnum
{
    //start from 2 for conditional reasons (0 and 1 cause problems)
    const DlyPst_CshSal = 2;
    const DlyPst_CshPur = 3;
}
