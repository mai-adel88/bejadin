<?php

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */

// تصنيف العمالة بالشركات
final class Nationalities extends Enum implements LocalizedEnum
{
    const Saudi = 1;
    const egyptian = 2;
}
