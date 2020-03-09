<?php

namespace App\Enums\Hr;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
// أنواع المرفقات 
final class HrAstAttachType extends Enum implements LocalizedEnum
{
    const none = 0;
    const photograph = 1;
    const residence = 2;
    const passport = 3;
    const graduationCertificate = 4;
}
