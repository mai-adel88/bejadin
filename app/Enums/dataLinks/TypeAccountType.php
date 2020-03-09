<?php

namespace App\Enums\dataLinks;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

final class TypeAccountType extends Enum implements LocalizedEnum
{
    const main = 0;
    const sub = 1;
}
