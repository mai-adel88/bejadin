<?php

namespace App\Enums\Hr;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */

// نوع جوزا السفر
final class PassportType extends Enum implements LocalizedEnum
{
    const none = 1;
    const normal = 2;
    const diplomatic = 3;
    const document = 4;
    const other = 5;
}
