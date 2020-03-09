<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pjitmmsfl extends Model
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
    protected $table = 'pjitmmsfls';
    protected $fillable = [
        'month',
        'year',
        'debtor',
        'creditor',
        'current_balance',
        'estimated_balance',
        'type',
        'tree_id',
        'cc_id',
    ];
    public function departments()
    {
        return $this->hasOne('App\Department','id','tree_id');
    }
    public function glcc()
    {
        return $this->hasOne('App\glcc','id','cc_id');
    }
}
