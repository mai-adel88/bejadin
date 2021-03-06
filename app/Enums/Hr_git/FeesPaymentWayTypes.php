<?php

namespace App\Enums\Hr;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;


/**
 *
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
 // انواع طرق دفع السوم - إعدادت الشركة
final class FeesPaymentWayTypes extends Enum implements  LocalizedEnum
{
    const none = 1;
    const monthly = 2;
    const quarterYear = 3;
    const halfYear = 4;
    const fullYear = 5;

}
