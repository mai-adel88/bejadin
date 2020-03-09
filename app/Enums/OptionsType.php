<?php

namespace App\Enums;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;

final class OptionsType extends Enum implements LocalizedEnum
{
    const Itm_SrchRef = 2;
    const Date_Status = 3;
    const JvAuto_Mnth = 4;
    const Cshr_Status = 5;
    const PhyTy_CostPrice = 6;
    const PhyTy_SalePrice = 7;
    const Fraction_Cost = 8;
    const Fraction_Curncy = 9;
}
