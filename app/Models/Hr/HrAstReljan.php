<?php

namespace App\Models\Hr;

use Illuminate\Database\Eloquent\Model;

class HrAstReljan extends Model
{
    protected $table = 'hrastreljans';
    public $timestamps = true;
    protected $primaryKey = 'ID_NO';
    protected $fillable = ['Reljan_No', 'Reljan_NmAr', 'Reljan_NmEn'];
}
