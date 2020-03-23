<?php

namespace App\Models\Hr;

use Illuminate\Database\Eloquent\Model;

class HREmpAttach extends Model
{
    protected $table = 'hrempattach';
    public $timestamps = true;
    protected $primaryKey = 'ID_NO';
    protected $fillable = [
        'Cmp_No', // رقم الشركة
        'Emp_No', // رقم الموظف
        'Attch_No', // رقم المرفق
        'Ln_No', // رقم المرفق
        'Attch_Ty', // نوع المرفق HrAstAttachType 
        'Attch_Desc', // وصف المرفق
        'Photo', // صورة المرفق 
    ];

    public function employee()
    {
        return $this->belongsTo(HrEmpmfs::class, 'Emp_No', 'Emp_No');
    }
}
