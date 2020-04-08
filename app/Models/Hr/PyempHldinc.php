<?php

namespace App\Models\Hr;

use Illuminate\Database\Eloquent\Model;

class PyempHldinc extends Model
{
    protected $table = 'pyemp_hldincs';
    public $timestamps = true;
    protected $primaryKey = 'ID_No';

    protected $fillable = [
        'Emp_No',
        'Work_Yer',
        'Increase_Days',
        'Notes'
    ];
}
