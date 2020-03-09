<?php

namespace App\Enums\Hr;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
// مدة الإقامات
final class MBudg_typ extends Enum implements LocalizedEnum
{
    const none = 0;
    const year = 1;
    const twoYears = 2;
    const threeYears = 3;
    const fourYears = 4;
    const fiveYears = 5;
    const flexibleYears = 10;
}
