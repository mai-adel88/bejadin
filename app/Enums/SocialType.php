<?php

namespace App\Enums;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;
final class SocialType extends Enum implements LocalizedEnum
{
    const Single = 0;
    const Married = 1;
    const Divorcee = 2;
    const Widowed = 3;
}

