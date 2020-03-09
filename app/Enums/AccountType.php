<?php

namespace App\Enums;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;

final class AccountType extends Enum implements LocalizedEnum
{
    const accounts = 1;
    const clients = 2;
    const suppliers = 3;
    const employees = 4;
    // const fixed_assets = 5;
    // const approvals =  6;
    // const projects = 7;

}
