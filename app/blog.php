<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class blog extends Model
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
    protected $table = 'blog_entries';
    protected $fillable =[
        'blog',
        'publish_after',
        'slug',
        'title',
        'author_name',
        'author_email',
        'author_url',
        'image',
        'content',
        'summary',
        'page_title',
        'description',
        'meta_tags',
        'display_full_content_in_feed',
    ];
    public static function boot()
    {
        parent::boot();

        static::saving(function($model) {
            $model->slug = str_slug($model->title);

            return true;
        });
    }
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
