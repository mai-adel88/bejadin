<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class glcc extends Model
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
    protected $table='glccs';
    protected $fillable =[
        'branch_id',
        'name_ar',
        'name_en',
        'code',
        'level_id',
        'levelType',
        'type',
        'status',
        'creditor',
        'debtor',
        'estimite',
        'description',
        'parent_id',
    ];
    public function parents(){
        return $this->hasMany('App\glcc','id','parent_id');
    }
    public function children(){
        return $this->hasMany('App\glcc','parent_id','id');
    }
    public function levels(){
        return $this->hasMany('App\levels','id','level_id');
    }
    public function pjitmmsfls(){
        return $this->hasMany('App\pjitmmsfl','cc_id','id');
    }
    public function limitations_type(){
        return $this->hasMany('App\limitationsType','cc_id','id');
    }
    public function receipts_type(){
        return $this->hasMany('App\receiptsType','cc_id','id');
    }
}
