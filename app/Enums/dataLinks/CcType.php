<?php

namespace App\Enums\dataLinks;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

final class CcType extends Enum implements LocalizedEnum
{
    const withoutCc = 0;
    const withCc = 1;
    const multi = 2;
}
