<?php

namespace App\Enums\Hr;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */

// الحالة الوظيفية
final class JobStatus extends Enum implements LocalizedEnum
{
    const none = 1;
    const stayWork = 2;
    const inVacation = 3;
    const finishService = 4;
    const goneNoReturn = 5;
    const escape = 6;
    const other = 7;
}
