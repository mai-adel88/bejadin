<?php

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

final class PayType extends Enum implements LocalizedEnum
{ 
    const cache = 1;
    const check = 2;
    const visa = 3;
    const bank = 4;
}
