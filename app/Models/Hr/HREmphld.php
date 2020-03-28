<?php

namespace App\Models\Hr;

use Illuminate\Database\Eloquent\Model;

class HREmphld extends Model
{

    protected $table = 'hr_emphld';
    public $timestamps = true;
    protected $guarded = ['ID_No'];

    public function employee()
    {
        return $this->belongsTo(HrEmpmfs::class, 'Emp_No', 'Emp_No');
    }

    public function employeeCnt()  //البيانات الماليه للموظفين
    {
        return $this->belongsTo(HREmpCnt::class, 'Emp_No', 'Emp_No');
    }
}
