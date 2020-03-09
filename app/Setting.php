<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
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
    protected $table = 'settings';
    protected $fillable = [
        'sitename_ar',
        'sitename_en',
        'logo',
        'icon',
        'email',
        'main_lang',
        'description',
        'description_ar',
        'contact_description',
        'contact_description_ar',
        'keywords',
        'status',
        'message_maintenance',
        'addriss',
        'phone',
        'facebook',
        'twitter',
        'googel',
        'linkedin',
    ];
}
