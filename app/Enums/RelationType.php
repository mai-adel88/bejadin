<?php

namespace App\Enums;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;

final class RelationType extends Enum implements LocalizedEnum
{
    const father = 0;
    const mother = 1;
    const brother = 2;
    const sister = 3;
    const grandfather = 4;
    const grandmother = 5;
    const Stepfather = 6;
    const HusbandAunt = 7;
    const uncle = 8;
    const aunt = 9;
    const uncle_M = 10;
    const aunt_M = 11;
    const brother_in_law = 12;
    const cousin = 13;
    const husband = 14;

}
