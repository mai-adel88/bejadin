<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class FormsType extends Enum
{
    const Spcrpt_Rcpt = 2;
    const Spcrpt_Pymt = 3;
    const Spcrpt_Sal = 4;
    const Spcrpt_Pur = 5;
    const Spcrpt_Trnf = 6;
    const Spcrpt_Adjust = 7;
    const Spcrpt_SRV = 8;
    const Spcrpt_DNV = 9;
}
