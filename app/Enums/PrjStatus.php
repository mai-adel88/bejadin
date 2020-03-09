<?php

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class PrjStatus extends Enum implements LocalizedEnum
{
    const enquiry    = 0;
    const quted      = 1;
    const refused    = 2;
    const ordered    = 3;
    const under_work = 4;
    const completed  = 5;
    const warnty     = 6;

}
