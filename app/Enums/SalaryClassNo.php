<?php

namespace App\Enums;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */

// تصنيف الراتب
final class SalaryClassNo extends Enum implements LocalizedEnum
{
    const none = 1;
    const Managers = 2;
    const Technicians = 3;
    const Laborers = 4;
    const Administration = 5;
    const factory = 6;
    const foreign = 7;
}
