<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\files;
use Illuminate\Support\Str;

class uploads extends Controller
{

    public static function delete($id){
        $file = files::findOrFail($id);
        if(!empty($file)){
            Storage::delete($file->full_file);
            $file->delete();
        }
    }
    public static function upload($data = []){
        if(!empty($data['new_name'])){
            $new_name = $data['new_name'] === null ?time():$data['new_name'];
        }
        if (request()->hasFile($data['request']) && $data['upload_type'] == 'single'){
            !empty($data['delete_file']) ? File::delete($data['delete_file']) : '';
            $filename = time().'_'.md5(Str::random(16)).'.'.request()->file($data['request'])->getClientOriginalExtension();

            $path = 'public/uploads/'.$data['path'];

            return request()->file($data['request'])->move($path, $filename);
        } elseif (request()->hasFile($data['request']) && $data['upload_type'] == 'files'){
            $files =  request()->{$data['request']};
            foreach ($files as $file) {
                $size = $file->getSize();
                $mime_type = $file->getMimeType();
                $name = $file->getClientOriginalName();
                $filename = time().'_'.md5(Str::random(16)).'.'.$file->getClientOriginalExtension();
                $path = 'public/uploads/'.$data['path'];
                $file->move($path, $filename);
                files::create([
                    'name'=>$name,
                    'size'=>$size,
                    'file'=>$filename,
                    'path'=> $data['path'],
                    'full_file'=> $path.'/' . $filename,
                    'mime_type'=>$mime_type,
                    'file_type'=> $data['file_type'],
                    'relation_id' => $data['relation_id']
                ]);
            }

        }
    }

    /**
     * Delete files as [images] from storage
     * @param array $file
     * @return void
     */
    public static function deleteFile($file = []){
        if (is_array($file)){
            foreach ($file as $item) {
                File::delete($item);
            }
        }
        File::delete($file);
    }

}
