<?php

namespace App\Enums;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;


/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */

// طرق دفع الراتب
final class SalaryPaymentWay extends Enum implements LocalizedEnum
{
    const none = 1;
    const bank = 2;
    const cash = 3;
    const check = 4;
}
