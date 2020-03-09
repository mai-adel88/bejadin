<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class responsiblePerson extends Model
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
    protected $table = 'responsible_people';
    protected $fillable=[
        'id',
        'responsible_people',
        'email',
        'phone1',
        'phone2',
        'mobile',
        'contractor_name'
    ];
}
