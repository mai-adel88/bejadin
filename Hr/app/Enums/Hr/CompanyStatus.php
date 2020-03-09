<?php

namespace App\Enums\Hr;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;


/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */

// حالة الشركة - إعدادات الشركة
final class CompanyStatus extends Enum implements LocalizedEnum
{
    const none = 1;
    const still = 2;
    const stop = 3;
    const underCreation = 4;
}
