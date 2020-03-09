<?php

namespace App;
use App\employee;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
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
    protected $table = 'projects';
    protected $fillable = [
        'name_ar',
        'name_en',
        'contract_number',
        'phone_number',
        'fax_number',
        'email',
        'responsible_person',
        'warehouse',
        'revenue',
        'expenses',
        'subscriber_id',
        'project_title',
        'cc_id',
        'tree_id',
    ];
    public function subscribers()
    {
        return $this->hasOne('App\subscription','id','subscriber_id');
    }
    public function glcc()
    {
        return $this->hasOne('App\glcc','id','cc_id');
    }
    public function departments()
    {
        return $this->hasMany('App\Department','operation_id','id');
    }
}
