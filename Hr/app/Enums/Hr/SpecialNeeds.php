<?php

namespace App\Enums\Hr;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */

// الاحتياجات الخاصة
final class SpecialNeeds extends Enum implements LocalizedEnum
{
    const none = 1;
    const mentalityObstruction = 2;
    const physicalObstruction = 3;
}
