<?php

namespace App\Http\Controllers\Admin\blog;

use App\blog;
use App\DataTables\blogDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Up;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(blogDataTable $blog)
    {
        return $blog->render('admin.blog.index',['title'=>trans('admin.Blogs')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.blog.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,blog $blog)
    {
        $data = $this->validate($request,[
            'blog' => 'sometimes',
            'publish_after' => 'required',
            'slug' => 'required|unique:blog_entries',
            'title' => 'required',
            'image' => 'required|'.validate_image(),
            'body' => 'required',
        ],[],[
            'blog' => trans('admin.blog'),
            'publish_after' => trans('admin.publish_after'),
            'slug' => trans('admin.slug'),
            'title' => trans('admin.title_blog'),
            'image' => trans('admin.image'),
            'body' => trans('admin.body'),
        ]);
        $blog->publish_after = date('Y-m-d h:i:s', strtotime($request->publish_after));
        $blog->title = $request->title;
        $blog->slug = str_slug($request->slug);
        $blog->author_name = auth()->guard('admin')->user()->name;
        $blog->author_email = auth()->guard('admin')->user()->email;
        $blog->content = $request->body;
        $blog->summary = getExcerpt($request->body,0,150);
        $blog->page_title = str_slug($request->slug);
        if($request->hasFile('image')){
            $blog->image = Up::upload([
                'request' => 'image',
                'path'=>'blog',
                'upload_type' => 'single'
            ]);
        }
        $blog->save();
        return redirect(aurl('blog'))->with(session()->flash('message',trans('admin.success_add')));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $blog = blog::findOrFail($id);
        return view('admin.blog.edit',['title'=> trans('admin.edit_blog') ,'blog'=>$blog]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'blog' => 'sometimes',
            'publish_after' => 'required',
            'title' => 'required',
            'body' => 'required',
        ]);
        $blog = blog::findOrFail($id);
        $data['publish_after'] = date('Y-m-d h:i:s', strtotime($request->publish_after));
        $data['summary'] = getExcerpt($request->body,0,150);
        
        // dd($blog->image);
        $blog->update($data);
        return redirect(aurl('blog'))->with(session()->flash('message',trans('admin.success_update')));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blog = blog::findOrFail($id);
        $blog->delete();
        return redirect(aurl('blog'));
    }
}
