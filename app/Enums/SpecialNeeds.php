<?php

namespace App\Enums;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;
final class SpecialNeeds extends Enum implements LocalizedEnum
{
    const normal = 1;
    const special_need = 0;

}
