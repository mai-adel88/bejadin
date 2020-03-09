<?php

namespace App\Models\Hr;

use Illuminate\Database\Eloquent\Model;

class HrAstEmpstuts extends Model
{
    protected $table = 'hrastempstuts';
    public $timestamps = true;
    protected $primaryKey = 'ID_NO';
    protected $fillable = ['HldTrnsp_No', 'HldTrnsp_Ar', 'HldTrnsp_En'];
}
