<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class AccountPostingType extends Enum
{
    const JVPst_SalCash = 2;
    const JVPst_PurCash = 3;
    const JVPst_NetSalCrdt = 4;
    const JVPst_NetPurCrdt = 5;
    const JVPst_TrnsferVch = 6;
    const JVPst_AdjustVch = 7;
    const JVPst_InvCost = 8;
    const JVPst_InvSal = 9;
}
