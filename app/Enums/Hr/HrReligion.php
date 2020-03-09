<?php

namespace App\Enums\Hr;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */

// الديانة
final class HrReligion extends Enum implements LocalizedEnum
{
    const islam =   1;
    const christian = 2;
    const jewish = 3;
    const other = 4;
}
