<?php

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

final class WorkStatusType extends Enum implements LocalizedEnum
{
    const vacation = 0;
    const termination_of_service = 1;
    const On_the_job = 2;
}
