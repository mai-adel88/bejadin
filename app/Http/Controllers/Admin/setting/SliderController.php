<?php

namespace App\Http\Controllers\Admin\setting;

use App\Slider;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\Http\Controllers\Controller;
use Up;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slides = Slider::all();
        return view('admin.setting.slider.index')->with('slides', $slides);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.setting.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * @throws
     */
    public function store(Request $request)
    {
        // validate the data
        $this->validate($request, array(
            'title' => 'required|max:255',
            'tag'  => 'required|min:5|max:255',
            'body'  => 'required',
            'image' => 'sometimes|image'
        ));

        $slide = new Slider;
        $slide->title = $request->title;
        $slide->tag = $request->tag;
        $slide->body = $request->body;

        if($request->hasFile('image')){
            $slide['image'] = Up::upload([
                'request' => 'image',
                'path'=>'slider',
                'upload_type' => 'single'
            ]);
        }

        $slide->save();

        return redirect()->route('slider.show', $slide->id);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $slide = Slider::find($id);
        return view('admin.setting.slider.show')->with('slide', $slide);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // find the post in database
        $slide = Slider::find($id);
        return view('admin.setting.slider.edit')->with('slide', $slide);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * @throws
     */
    public function update(Request $request, $id)
    {
        // validate the data
        $slide = Slider::find($id);
        $this->validate($request, array(
            'title' => 'required|max:255',
            'tag'  => 'required|min:5|max:255',
            'body'  => 'required',
            'image' => 'sometimes|image'
        ));


        // save the data to the database
        $slide = Slider::find($id);
        $slide->title = $request->input('title');
        $slide->tag = $request->input('tag');
        $slide->body = $request->input('body');

        if($request->hasFile('image')){
            $slide['image'] = Up::upload([
                'request' => 'image',
                'path'=>'drivers',
                'upload_type' => 'single',
                'delete_file'=> $slide->image
            ]);
        }

        $slide->save();

        // redirect to posts.show
        return redirect()->route('slider.show', $slide->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slide = Slider::find($id);

        $slide->delete();

        return redirect()->route('slider.index');
    }
}
