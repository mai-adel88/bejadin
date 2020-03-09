<?php

namespace App\Http\Controllers\Hr\roles;

use App\Admin;
use App\Models\Hr\Hr;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Hr $admin)
    {


//        dd(Admin::query()->with('permissions')->find(6)->getAllPermissions());
        $permissions = Permission::where('guard_name', 'hr')->get();
        return view('hr.hrs.permissions.index',['permissions' => $permissions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('hr.hrs.permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validate($request,[
            'name' => 'required',
        ],[],[
            'name' => trans('hr.name'),
        ]);
        Permission::create([
            'name' => request('name'),
            'guard_name' => 'hr',
        ]);
        return redirect(hrUrl('HrPermissions'))->with(session()->flash('message',trans('hr.add_success')));
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
        $permission = Permission::findOrFail($id);
        return view('hr.hrs.permissions.edit',['permission'=>$permission]);
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
            'name' => 'required'
        ],[],[
            'name' => trans('hr.name')
        ]);
        $role = Permission::findOrFail($id);

        $role->name = $request->name;
        $role->guard_name = 'hr';
        $role->save();
        return redirect(hrUrl('HrPermissions'))->with(session()->flash('message',trans('hr.update_success')));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $permission = Permission::findOrFail($id);
        $permission->delete();
        return redirect(hrUrl('HrPermissions'))->with(session()->flash('message',trans('hr.delete_success')));
    }
}
