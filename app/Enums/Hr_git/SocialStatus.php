<?php

namespace App\Enums\Hr;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */

// الحالة الاجتماعية
final class SocialStatus extends Enum implements LocalizedEnum
{
    const none = 1;
    const single = 2;
    const married = 3;
    const divorced = 4;
    const widower = 5;
}
