<?php

namespace App\Enums\Hr;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */

// أنواع رخص القيادة
final class DriveLicenceType extends Enum implements LocalizedEnum
{
    const none = 1;
    const spacial = 2;
    const mediate = 3;
    const generalGreat = 4;
}
