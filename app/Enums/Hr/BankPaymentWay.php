<?php

namespace App\Enums\Hr;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */

// طرق دفع البنك
final class BankPaymentWay extends Enum implements LocalizedEnum
{
    const none = 1;
    const bank = 2;
    const cash = 3;
    const check = 4;
}
