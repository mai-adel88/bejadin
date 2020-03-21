<?php

namespace App\Models\Hr;

use Illuminate\Database\Eloquent\Model;

class HREmpDependents extends Model
{

    protected $table = 'hr_emp_dependents';
    public $timestamps = true;
    protected $guarded = array('ID_No');

}
