<?php

namespace App\Http\Controllers\web;


use App\blog;
use App\Mail\VisitorMessage;
use App\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class PageController extends Controller
{
    public function getIndex() 
    {
        return view('web.index.home');
    }

    public function contact() {
        return view('web.index.contact');
    }
    public function about() {
        return view('web.index.about');
    }
    public function services() {
        return view('web.index.services');
    }
    public function blog() {
        $blogs = blog::paginate(5);
        return view('web.blog.index')->with('blogs', $blogs);
    }

    public function getSingle($id) {
        // fetch from BD based on the slug
        $blog = blog::where('id', '=', $id)->first();
        // return the view
        return view('web.blog.single')->with('blog', $blog);
    }

    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * @throws
     */

    public function postContact(Request $request) {


        $from = $request->email;
        $message = $request->message;
        $phone = $request->phone;
        $name = $request->name;
        $to = 'elmonieribrahim@gmail.com';
        Mail::to($to)->send(new VisitorMessage($from,$message,$phone,$name));

        return redirect()->route('web.index.home');

    }

}
