<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Units extends Model
{
    protected $table = 'mtsitmunit';
    protected $primaryKey = 'ID_No';
    protected $fillable = ['Actvty_No', 'Cmp_No', 'Unit_No', 'Unit_NmAr', 'Unit_NmEn'];
}
