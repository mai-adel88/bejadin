<?php

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

final class StatusType extends Enum implements LocalizedEnum
{
    const Serves = 1;
    const Stopped = 2;
    const Sick = 3;
    const Escape = 4;
    const Damage = 5;
    const WithoutCar = 6;
    const InVacation = 7;
}
