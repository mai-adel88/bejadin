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
    const none = 1;
    const photograph = 2;
    const residence = 3;
    const passport = 4;
    const graduationCertificate = 5;
}
