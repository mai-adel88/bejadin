<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Astsupctg extends Model
{
    protected $table = 'astsupctgs';
    protected $primaryKey = 'ID_No';
    protected $fillable = [
        'Supctg_No',
        'Supctg_Nmar',
        'Supctg_Nmen',

    ];



}
