<?php

namespace App\Enums;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;

final class NotiType extends Enum implements LocalizedEnum
{
    const Creditor = 0; //دائن
    const Debit = 1; //مدين

}
