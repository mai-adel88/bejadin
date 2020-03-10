<?php

namespace App\Enums\Hr;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
// نوع النشاط
final class ActiveType extends Enum implements LocalizedEnum
{
    const none = 1;
    const trade = 2;
    const industrial = 3;
    const printAndPackaging = 4;
    const building = 5;
    const generalRent = 6;
    const carsRent = 7;
    const transporter = 8;
    const generalConstruction = 9;
    const maintenanceAndOperation = 10;
    const schools = 11;
    const hospitals = 12;
    const pharmacies = 13;
    const other = 14;
}
