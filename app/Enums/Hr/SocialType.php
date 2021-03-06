<?php

namespace App\Enums\Hr;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;
final class SocialType extends Enum implements LocalizedEnum
{
    const Single = 1;
    const Married = 2;
    const Divorcee = 3;
    const Widowed = 4;
}

