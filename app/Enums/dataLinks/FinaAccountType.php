<?php

namespace App\Enums\dataLinks;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

final class FinaAccountType extends Enum implements LocalizedEnum
{
    const budget_elements = 0;
    const incoming_list = 1;
    const money_flow_up = 2;
}
