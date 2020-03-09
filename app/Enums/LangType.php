<?php

namespace App\Enums;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;

final class LangType extends Enum implements LocalizedEnum
{
    const arabic = 0;
    const english = 1;
}
