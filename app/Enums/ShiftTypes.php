<?php

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */

// نوع الدوام
final class ShiftTypes extends Enum implements LocalizedEnum
{
    const none = 1;
    const Administration= 2;
    const first_patrol  = 3;
    const second_patrol = 4;
    const third_patrol  = 5;
}
