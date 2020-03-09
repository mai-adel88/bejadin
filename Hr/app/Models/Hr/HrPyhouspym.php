<?php

namespace App\Models\Hr;

use Illuminate\Database\Eloquent\Model;

class HrPyhouspym extends Model
{
    protected $table = 'hrpyhouspyms';
    public $timestamps = true;
    protected $primaryKey = 'ID_NO';
    protected $fillable = ['Huspym_No', 'Huspym_NmAr', 'Huspym_NmEn'];
}
