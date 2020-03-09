<?php

namespace App\Models\Hr;

use Illuminate\Database\Eloquent\Model;

class HrAstPorts extends Model
{
    protected $table = 'hrastports';
    public $timestamps = true;
    protected $primaryKey = 'ID_NO';
    protected $fillable = ['Ports_No', 'Ports_NmAr', 'Ports_NmEn'];
}
