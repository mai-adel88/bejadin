<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectsSites extends Model
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
    protected $table = 'projects_sites';
    protected $fillable = [
        'project_id',
        'name_ar',
        'name_en',
        'cc_id',
        'contract_number',
        'phone_number',
        'email',
        'responsible_person',
        'warehouse',
        'project_title',
    ];
    public function project(){
        return $this->hasOne('App\Project','id','project_id');
    }
}
