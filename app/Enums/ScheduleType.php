<?php

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

final class ScheduleType extends Enum implements LocalizedEnum
{
    const go = 0;
    const rturn = 1;
}
