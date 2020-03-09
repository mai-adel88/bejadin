<?php

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

final class SupplierType extends Enum implements LocalizedEnum
{
    const GeneralSupplier = 0;
    const SupplierOfSpareParts = 1;
}
