<?php

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

final class DocType extends Enum implements LocalizedEnum
{
    //start from 2 for conditional reasons (0 and 1 cause problems)
    const Rcpt_Flg = 2;
    const Pymt_Flg = 3;
    const Jv_Flg = 4;
    const Sal_Flg = 5;
    const Pur_Flg = 6;
    const Inv_Flg = 7;
}
