<?php

namespace App\Enums\dataLinks;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

final class OperationType extends Enum implements LocalizedEnum
{
    const suppliers = 0;
    const customers = 1;
    const projects = 2;
    const accounts = 3;
    const employees = 4;
    const cashiers = 5;
    const banks = 6;
    const minus_document = 7;
    const plus_document = 8;
}
