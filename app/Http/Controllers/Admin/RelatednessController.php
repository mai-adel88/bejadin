<?php

namespace App\Http\Controllers\Admin;

use App\Branches;
use App\DataTables\relatedDataTable;
use App\Http\Controllers\Controller;
use App\parents;
use App\subscription;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RelatednessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(relatedDataTable $related)
    {
        return $related->render('admin.relatedness.index',['title'=>trans('admin.relatedness')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Branches $branches)
    {
        $subscriptions = subscription::all();
        return view('admin.relatedness.create',['title'=> trans('admin.create_new_relatedness'),'subscriptions'=>$subscriptions]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,parents $parents)
    {
        $data = $this->validate($request,[
            'name_ar' => 'required',
            'name_en' => 'required',
            'phone' => 'required',
        ],[],[
            'name_ar' => trans('admin.arabic_name'),
            'name_en' => trans('admin.english_name'),
            'phone' => trans('admin.mob'),
        ]);
        $parents->name_ar = $request->name_ar;
        $parents->name_en = $request->name_en;
        $parents->phone = $request->phone;

        $parents->save();

        $subscriber = subscription::find($request->subscription);
        $parents->subscription()->attach($subscriber);
        return redirect(aurl('relatedness'))->with(session()->flash('message',trans('admin.success_add')));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id,Branches $branches)
    {
        $related = parents::findOrFail($id);
        $subscriptions = subscription::all();
        return view('admin.relatedness.edit',['title'=>trans('admin.edit_relatedness') ,'related'=>$related,'subscriptions'=>$subscriptions]);
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
        $parent = parents::findOrFail($id);
        $data = $this->validate($request,[
            'name_ar' => 'required',
            'name_en' => 'required',
            'phone' => 'required',
        ],[],[
            'name_ar' => trans('admin.arabic_name'),
            'name_en' => trans('admin.english_name'),
            'phone' => trans('admin.mob'),
        ]);
        $parent->name_ar = $request->name_ar;
        $parent->name_en = $request->name_en;
        $parent->phone = $request->phone;

        $parent->save();

        $subscriber = subscription::find($request->subscription);
        $parent->subscription()->sync($subscriber);
        return redirect(aurl('relatedness'))->with(session()->flash('message',trans('admin.success_update')));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $parent = parents::findOrFail($id);
        DB::table('sub_parents')->where('parent_id',$id)->delete();
        $parent->delete();
        return redirect(aurl('relatedness'));
    }
}
