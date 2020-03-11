<?php

namespace App\Models\Hr;

use Illuminate\Database\Eloquent\Model;

class HrOwnrmf extends Model
{
    protected $table = 'HROwnrmf';
    public $timestamps = true;
    protected $primaryKey = 'ID_No';
    protected $guarded = [];

    //owners الكفيل
    public function employees()
    {
        return $this->hasMany(HrEmpmfs::class, 'Ownr_No','Ownr_No');
    }
    
}
