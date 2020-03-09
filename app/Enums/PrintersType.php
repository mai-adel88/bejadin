<?php

namespace App\Enums;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;

final class PrintersType extends Enum implements LocalizedEnum
{
    const PrintOrder_DNV = 2;
    const PrintOrder_SRV = 3;
    const SelctNorm_Prntr1 = 4;
    const SelctNorm_Prntr2 = 5;
    const SelctNorm_Prntr3 = 6;
    const SelctBarCod_Prntr1 = 7;
    const SelctBarCod_Prntr2 = 8;
    const SelctBarCod_Prntr3 = 9;
    const SelctPosSlip_Prntr1 = 10;
    const SelctPosSlip_Prntr2 = 11;
    const SelctPosSlip_Prntr3 = 12;
}
