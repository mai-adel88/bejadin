<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    protected $connection;
    public function __construct(){
        $envFile = app()->environmentFilePath();
        $str = file_get_contents($envFile);
        $str .= "\n";
        $keyPosition = strpos($str, 'DB_CONNECTION=');
        $endOfLinePosition = strpos($str, "\n", $keyPosition);
        $oldLine = substr($str, $keyPosition, $endOfLinePosition - $keyPosition);
        $str_arr = explode("=", $oldLine);
        // dd($str_arr);
        // dd(\App\database::where('id',1)->first()->name);
        $this->connection = $str_arr[1];
    }
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
        return $this->hasMany('App\Department','id','parent_id');
    }
    public function children(){
        return $this->hasMany(self::class,'parent_id');
    }
    public function grandchildren()
    {
        return $this->children()->with('grandchildren');
    }
    public function levels(){
        return $this->hasMany('App\levels','id','level_id');
    }
    public function operations(){
        return $this->hasOne('App\operation','id','operation_id');
    }
    public function glcc(){
        return $this->hasOne('App\glcc','id','cc_id');
    }
    public function pjitmmsfls(){
        return $this->hasMany('App\pjitmmsfl','tree_id','id');
    }
    public function limitations_type(){
        return $this->hasMany('App\limitationsType','tree_id','id');
    }
    public function receipts_type(){
        return $this->hasMany('App\receiptsType','tree_id','id');
    }
    public function employees(){
        return $this->hasMany('App\employee','tree_id','id');
    }
    public function suppliers(){
        return $this->hasMany('App\supplier','tree_id','id');
    }
    public function subscription(){
        return $this->hasMany('App\subscription','tree_id','id');
    }
    public function projects(){
        return $this->hasMany('App\project','tree_id','id');
    }
    public function contractors(){
        return $this->hasMany('App\contractors','tree_id','id');
    }
    public function receiptsData(){
        return $this->hasMany('App\receiptsData','tree_id','id');
    }
}
