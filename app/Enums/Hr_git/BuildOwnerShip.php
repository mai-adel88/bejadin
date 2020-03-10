<?php

namespace App\Enums\Hr;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;


/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */

// ملكية العقار للشركة - إعدادت الشركة
final class BuildOwnerShip extends Enum implements LocalizedEnum
{
    const none = 1;
    const governmentOwn = 2;
    const rentFromOther = 3;
    const CompanyOwn = 4;
    const specialOwn = 5;
}
