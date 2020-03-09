<?php

namespace App\Enums\dataLinks;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

final class LimitTimeType extends Enum implements LocalizedEnum
{
    const firstDate = 0;
    const inTime = 1;
}
