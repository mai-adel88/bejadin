<?php

namespace App\Enums;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;

final class AllowedType extends Enum implements LocalizedEnum
{
    const AllwItm_RepatVch = 2;
    const AllwItmLoc_ZroBlnc = 3;
    const AllwItmQty_CostCalc = 4;
    const AllwDisc1Pur_Dis1Sal = 5;
    const AllwDisc2Pur_Dis2Sal = 6;
    const AllwStock_Minus = 7;
    const AllwPur_Disc1 = 8;
    const AllwPur_Disc2 = 9;
    const AllwPur_Bouns = 10;
    const AllwSal_Disc1 = 11;
    const AllwSal_Disc2 = 12;
    const AllwSal_Bouns = 13;
    const AllwTrnf_Cost = 14;
    const AllwTrnf_Disc1 = 15;
    const AllwTrnf_Bouns = 16;
    const AllwBatch_No = 17;
    const AllwExpt_Dt = 18;
    const ActvDnv_No = 19;
    const ActvSRV_No = 20;
    const ActvTrnf_No = 21;
    const TabOrder_Pur = 22;
    const TabOrder_SaL = 23;
}
