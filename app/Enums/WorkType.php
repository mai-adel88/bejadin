<?php

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

final class WorkType extends Enum implements LocalizedEnum
{
    const Administrative = 0;
    const sales = 1;
    const Worker = 2;
    const night_worker = 3;
}
