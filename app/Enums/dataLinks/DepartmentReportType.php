<?php

namespace App\Enums\dataLinks;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

final class DepartmentReportType extends Enum implements LocalizedEnum
{
    const levelNumber = 0;
    const trustAccounts = 1;
    const DeptDepartement = 2;
    const CrdDepartement = 3;
    const PersonalDepartement = 4;
    const BranchDepartement = 5;
}
