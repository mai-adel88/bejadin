<?php

namespace App\Enums\dataLinks;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

final class StatusTreeType extends Enum implements LocalizedEnum
{
    const deactive = 0;
    const active = 1;
}
