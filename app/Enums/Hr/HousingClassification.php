<?php

namespace App\Enums\Hr;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;


/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */

// تصنيف السكن
final class HousingClassification extends Enum implements LocalizedEnum
{
    const none = 1;
    const room = 2;
    const tworooms = 3;
    const roomhall = 4;
    const flat = 5;
}
