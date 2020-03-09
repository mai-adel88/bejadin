<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class AstCurncy extends Model
{
    protected $table = 'astcurncy';
    protected $primaryKey = 'ID_No';
    protected $fillable = [
        'Curncy_No',
        'Curncy_NmAr',
        'Curncy_NmEn',
        'Curncy_Rate',
    ];
}
