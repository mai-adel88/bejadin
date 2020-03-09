<?php

namespace App\Models\Hr;

use Illuminate\Database\Eloquent\Model;

class HrHldTrnsp extends Model
{
    protected $table = 'hrhldtrnsps';
    public $timestamps = true;
    protected $primaryKey = 'ID_NO';
    protected $fillable = ['Emp_stu', 'Emp_StunmAr', 'Emp_StunmEn'];
}
