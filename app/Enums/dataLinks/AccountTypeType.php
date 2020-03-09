<?php

namespace App\Enums\dataLinks;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

final class AccountTypeType extends Enum implements LocalizedEnum
{
    const allAccounts = 0;
    const onlyTrans = 1;
    const noTrans = 2;
    const deptAccounts = 3;
    const crtAccounts = 4;
}
