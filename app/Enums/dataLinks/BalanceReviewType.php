<?php

namespace App\Enums\dataLinks;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

final class BalanceReviewType extends Enum implements LocalizedEnum
{
    const reviewBalance = 0;
    const levelReview = 1;
}
