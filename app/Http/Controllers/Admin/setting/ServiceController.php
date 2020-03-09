<?php

namespace App\Http\Controllers\Admin\setting;

use App\ServicePage;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\Http\Controllers\Controller;
use Up;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = ServicePage::all();
        return view('admin.setting.service.index')->with('services', $services);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.setting.service.create');
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
            'mini_desc'  => 'required',
            'image' => 'sometimes|image',
            'icon' => 'sometimes|image'
        ));

        $service = new ServicePage();
        $service->title = $request->title;
        $service->body = $request->body;
        $service->mini_desc = $request->mini_desc;

        if($request->hasFile('icon')){
            $service['icon'] = Up::upload([
                'request' => 'icon',
                'path'=>'service',
                'upload_type' => 'single',
            ]);
        }

        if($request->hasFile('image')){
            $service['image'] = Up::upload([
                'request' => 'image',
                'path'=>'service',
                'upload_type' => 'single'
            ]);
        }

        $service->save();

        return redirect()->route('service.show', $service->id);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $service = ServicePage::find($id);
        return view('admin.setting.service.show')->with('service', $service);
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
        $service = ServicePage::find($id);
        return view('admin.setting.service.edit')->with('service', $service);
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
        $service = ServicePage::find($id);
        $this->validate($request, array(
            'title' => 'required|max:255',
            'body'  => 'required',
            'mini_desc'  => 'required',
            'image' => 'sometimes|image',
            'icon' => 'sometimes|image'
        ));


        // save the data to the database
        $service = ServicePage::find($id);
        $service->title = $request->input('title');
        $service->body = $request->input('body');
        $service->mini_desc = $request->input('mini_desc');

        if($request->hasFile('license_image')){
            $service['license_image'] = Up::upload([
                'request' => 'license_image',
                'path'=>'drivers',
                'upload_type' => 'single',
                'delete_file'=> $service->license_image
            ]);
        }

        if($request->hasFile('image')){
            $service['image'] = Up::upload([
                'request' => 'image',
                'path'=>'drivers',
                'upload_type' => 'single',
                'delete_file'=> $service->image
            ]);
        }

        $service->save();

        // redirect to posts.show
        return redirect()->route('service.show', $service->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $service = ServicePage::find($id);

        $service->delete();

        return redirect()->route('service.index');
    }
}
