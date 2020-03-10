<?php

namespace App\Enums\Hr;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */

// انواع المواقع
final class LocationsType extends Enum implements LocalizedEnum
{
    const none = 1;
    const licencedLocation = 2;
    const spaceLand = 3;
    const building = 4;
    const byWriting = 5;
    const withoutWriting = 6;
    const townShipLicenced = 7;
    const gallery = 8;
    const hall = 9;
    const other = 10;
}
