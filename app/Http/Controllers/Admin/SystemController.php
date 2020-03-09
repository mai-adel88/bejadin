<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\systemDataTable;
use App\Http\Controllers\Controller;
use App\subsystem;
use Illuminate\Http\Request;

class SystemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(systemDataTable $system)
    {
        return $system->render('admin.subsystems.index',['title'=>trans('admin.subsystem')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.subsystems.create',['title'=> trans('admin.Create_New_Sub_System')]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,subsystem $systems)
    {
        $data = $this->validate($request,[
            'name_ar' => 'required',
            'name_en' => 'required',
        ],[],[
            'name_ar' => trans('admin.arabic_name'),
            'name_en' => trans('admin.english_name'),
        ]);

        $systems->create($data);
        return redirect(aurl('systems'))->with(session()->flash('message',trans('admin.success_add')));

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
    public function edit($id)
    {
        $system = subsystem::findOrFail($id);
        return view('admin.subsystems.edit',['title'=> trans('admin.Edit_Sub_System') ,'system'=>$system]);
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
        $data = $this->validate($request,[
            'name_ar' => 'required',
            'name_en' => 'required',
        ],[],[
            'name_ar' => trans('admin.arabic_name'),
            'name_en' => trans('admin.english_name'),
        ]);
        $system = subsystem::findOrFail($id);

        $system->update($data);
        return redirect(aurl('systems'))->with(session()->flash('message',trans('admin.success_update')));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $system = subsystem::findOrFail($id);
        $system->delete();
        return redirect(aurl('systems'));
    }
}
