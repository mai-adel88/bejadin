<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class files extends Model
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
    protected $table = 'files';
    protected $fillable = [
        'id',
        'name',
        'size',
        'file',
        'path',
        'full_file',
        'mime_type',
        'file_type',
        'relation_id'
    ];
}
