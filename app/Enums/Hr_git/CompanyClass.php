<?php

namespace App\Enums\Hr;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */

// تصنيف الشركات
final class CompanyClass extends Enum implements LocalizedEnum
{
    const none = 1;
    const shareHoldingCompany = 2;
    const companyHaveMM = 3;
    const simpleRecommendationCompany = 4;
    const industrialCraft = 5;
    const industrialFoundation= 6;
    const individualFoundation= 7;
    const specialParticipate = 8;
    const generalParticipate = 9;
}
