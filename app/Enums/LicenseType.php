<?php

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

final class LicenseType extends Enum implements LocalizedEnum
{
    const SpecialLicense = 0;
    const FirstClassLicense = 1;
    const SecondClassLicense = 2;
    const ThirdClassLicense = 3;
}
