<?php

namespace App\Enums\dataLinks;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

final class StatusAccountType extends Enum implements LocalizedEnum
{
    const suspend = 0;
    const open = 1;
    const post = 2;
    const confirmed = 3;
}
