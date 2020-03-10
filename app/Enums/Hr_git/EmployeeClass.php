<?php

namespace App\Enums\Hr;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */

// فئات الموظفين
final class EmployeeClass extends Enum implements LocalizedEnum
{
    const none = 1;
    const ExcellentClass = 2;
    const ClassA = 3;
    const ClassB = 4;
    const ClassG = 5;
    const ClassD = 6;
}
