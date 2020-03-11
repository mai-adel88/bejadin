<?php

namespace App\Enums\Hr;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
// نوع استحقاقات الاجازه
final class AstcHldyEarn extends Enum implements LocalizedEnum
{
    const none = 1;
    const according_law= 2;  //حسب القانون
    const annual15 = 3;     //15سنويه
    const annual30 = 4;     //سنويه30
    const annual21 = 5;     //سنويه21
    const annual45 = 6;     //سنويه45
    const years30  = 7;      //سنتين30
    
}
