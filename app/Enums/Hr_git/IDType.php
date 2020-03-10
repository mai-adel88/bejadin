<?php

namespace App\Enums\Hr;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
// انواع الإقامات
final class IDType extends Enum implements LocalizedEnum
{
    const none = 1;
    const systemic = 2;
    const nonSystemic = 3;
    const nationalityId = 4;
    const workVisiting = 5;
}
