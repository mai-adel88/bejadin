<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class notificationController extends Controller
{
    public function count(Request $request){
        if($request->ajax()) {

            $contents = view('admin.notification.count')->render();
            // do some other manipulation?
            return $contents;


        }
    }
}
