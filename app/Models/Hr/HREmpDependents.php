<?php

namespace App\Models\Hr;

use Illuminate\Database\Eloquent\Model;

class HREmpDependents extends Model
{

    protected $table = 'hr_emp_dependents';
    public $timestamps = true;
    protected $primaryKey = 'ID_No';
    protected $guarded = [];

    public function employee()
    {
        return $this->belongsTo(HrEmpmfs::class, 'Emp_No', 'Emp_No');
    }

}
