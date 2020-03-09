<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class ActivityTypes extends Model
{
    protected $table = 'activitytypes';
    protected $primaryKey = 'ID_No';
    protected $fillable = [
        'Actvty_No',
        'Name_Ar',
        'Name_En',
        'NofCmp'
    ];

    public function companies()
    {
        return $this->hasMany(MainCompany::class, 'Actvty_No', 'Actvty_No');
    }
}
