<?php

namespace App\Enums\dataLinks;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

final class BankAppearType extends Enum implements LocalizedEnum
{
    const bankClipboard = 0;
    const bannkRestriction = 1;
}
