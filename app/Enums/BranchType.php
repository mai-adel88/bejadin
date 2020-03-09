<?php

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

final class BranchType extends Enum implements LocalizedEnum
{
    const manage = 0;
    const main_store = 1;
    const branch = 2;
    const sales_point = 3;
}
