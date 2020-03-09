<?php

namespace App\Http\Controllers\Admin\setting;

use App\AboutPage;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\Http\Controllers\Controller;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $abouts = AboutPage::all();
        return view('admin.setting.about.index')->with('abouts', $abouts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.setting.about.create');
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
            'body'  => 'required',
            'image' => 'sometimes|image'
        ));

        $about = new AboutPage();
        $about->title = $request->title;
        $about->body = $request->body;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('elshehry/images/' . $filename);
            Image::make($image)->save($location);

            $about->image = $filename;
        }

        $about->save();

        return redirect()->route('about.show', $about->id);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $about = AboutPage::find($id);
        return view('admin.setting.about.show')->with('about', $about);
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
        $about = AboutPage::find($id);
        return view('admin.setting.about.edit')->with('about', $about);
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
        $about = AboutPage::find($id);
        $this->validate($request, array(
            'title' => 'required|max:255',
            'body'  => 'required',
            'image' => 'sometimes|image'
        ));


        // save the data to the database
        $about = AboutPage::find($id);
        $about->title = $request->input('title');
        $about->tag = $request->input('tag');
        $about->body = $request->input('body');

        if ($request->hasFile('image')) {
            //add the new image
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('elshehry/images/' . $filename);
            Image::make($image)->save($location);
            $oldFileName = $about->image;
            // update the image in database
            $about->image = $filename;
            // delete the old image
            Storage::delete($oldFileName);
        }

        $about->save();

        // redirect to posts.show
        return redirect()->route('about.show', $about->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $about = AboutPage::find($id);

        $about->delete();

        return redirect()->route('about.index');
    }
}
