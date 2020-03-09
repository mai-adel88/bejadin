<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class GLAstJrntyp extends Model
{
    protected $table = 'gLastjrntyp';
    protected $primaryKey = 'ID_NO';
    protected $fillable = ['Jr_Ty', 'Jrty_NmAr', 'Jrty_NmEn', 'active'];
}
