<?php

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

final class EducateType extends Enum implements LocalizedEnum
{
    const preparatory = 0;
    const secondary = 1;
    const QualifiedAverage = 2;
    const HighQualified = 3;
}
