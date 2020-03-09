<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App;

class Department extends Model
{
    protected $table='departments';
    protected $fillable =[
        'branch_id',
        'dep_name_ar',
        'dep_name_en',
        'code',
        'levelType',
        'level_id',
        'type',
        'status',
        'category',
        'operation_id',
        'cc_id',
        'cc_type',
        'budget',
        'creditor',
        'debtor',
        'estimite',
        'description',
        'parent_id',
    ];

    public function parents(){
        return $this->hasMany('Department','id','parent_id');
    }
    public function children(){
        return $this->hasMany('Department','parent_id','id');
    }
    public function levels(){
        return $this->hasMany('levels','id','level_id');
    }
    public function operations(){
        return $this->hasOne('operation','id','operation_id');
    }
    public function glcc(){
        return $this->hasOne('glcc','id','cc_id');
    }
    public function pjitmmsfls(){
        return $this->hasMany('pjitmmsfl','tree_id','id');
    }
    public function limitations_type(){
        return $this->hasMany('limitationsType','tree_id','id');
    }
    public function receipts_type(){
        return $this->hasMany('receiptsType','tree_id','id');
    }
}
