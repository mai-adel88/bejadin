<?php

namespace App\Enums\Hr;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class EducationType extends Enum implements LocalizedEnum
{
    const none = 1;
    const noRead = 2;
    const writingReading = 3;
    const primary = 4;
    const mediate = 5;
    const secondary = 6;
    const diploma = 7;
    const academic = 8;
    const ma = 9;
    const doctorate = 10;
}
