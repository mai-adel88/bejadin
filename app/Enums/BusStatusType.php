<?php

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

final class BusStatusType extends Enum implements LocalizedEnum
{
    const working = 1;
    const noexist = 2;
    const maintance = 3;
    const accident = 4;
    const stopedaccident = 5;
    const stopedselling = 6;
    const bookingtraffic = 7;
    const withoutdriver = 8;
    const stoped = 9;
    const weekend = 10;
}
