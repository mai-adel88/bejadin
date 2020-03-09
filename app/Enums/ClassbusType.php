<?php

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

final class ClassbusType extends Enum implements LocalizedEnum
{
    const bus = 0;
    const minibus = 1;
    const microbus = 2;
}
