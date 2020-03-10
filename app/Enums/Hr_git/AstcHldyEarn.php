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
    const none = 0;
    const according_law= 1;  //حسب القانون
    const annual15 = 2;     //15سنويه
    const annual30 = 3;     //سنويه30
    const annual21 = 4;     //سنويه21
    const annual45 = 5;     //سنويه45
    const years30  = 6;      //سنتين30
    
}
