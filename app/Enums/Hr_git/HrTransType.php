<?php

namespace App\Enums\Hr;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */

// انواع وسائل السفر
final class HrTransType extends Enum implements LocalizedEnum
{
    const none = 1;
    const air = 2;
    const land = 3;
    const sea = 4;
}
