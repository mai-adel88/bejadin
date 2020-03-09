<?php

namespace App\Enums\Hr;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */

// الصفة القانوينة للشركاء والمفوضين-الشركات
final class LegalForPartnersAndDelegates extends Enum implements LocalizedEnum
{
    const none = 1;
    const partner = 2;
    const signedDelegate = 3;
    const agent = 4;
}
