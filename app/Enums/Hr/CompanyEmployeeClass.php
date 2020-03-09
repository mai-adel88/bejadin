<?php

namespace App\Enums\Hr;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */

// تصنيف العمالة بالشركات
final class CompanyEmployeeClass extends Enum implements LocalizedEnum
{
    const none = 1;
    const permanentEmployee = 2;
    const temporaryEmployee = 3;
}
