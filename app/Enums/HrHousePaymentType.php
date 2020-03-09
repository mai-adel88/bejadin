<?php

namespace App\Enums;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;


/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */

// تصنيف بدل السكن
final class HrHousePaymentType extends Enum implements LocalizedEnum
{
    const none = 1;
    const monthly = 2;
    const quarterYear = 3;
    const halfYear = 4;
    const fullYear = 5;
    const companyHouse = 6;
}
