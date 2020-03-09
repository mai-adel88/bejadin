<?php

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class BarCodeSize extends Enum implements LocalizedEnum
{
    const large = 1;
    const medium = 2;
    const small = 3;
}
