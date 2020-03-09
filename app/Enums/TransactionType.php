<?php

namespace App\Enums;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;

final class TransactionType extends Enum implements LocalizedEnum
{
    const open_entry = 1;
    const cash_reciept = 2;
    const cheque_reciept = 3;
    const cash_payment = 4;
    const cheque_payment = 5;
    const daily_entry = 6;
    const future_sales = 7;
    const cash_sales = 8;
    const future_purchases = 9;
    const cash_purchases = 10;
    const income_transform = 11;
    const outcome_transform = 12;
    const addition_adiustment = 13;
    const discount_adujstment = 14;
    const debt_notify = 15;
    const credit_notify = 16;
}
