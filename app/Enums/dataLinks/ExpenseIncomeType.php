<?php

namespace App\Enums\dataLinks;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

final class ExpenseIncomeType extends Enum implements LocalizedEnum
{
    const expense = 0;
    const income = 1;
}
