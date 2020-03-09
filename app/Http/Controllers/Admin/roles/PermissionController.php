<?php

namespace App\Http\Controllers\Admin\roles;

use App\Admin;
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
    public function index(Admin $admin)
    {


//        dd(Admin::query()->with('permissions')->find(6)->getAllPermissions());
        $permissions = Permission::all();
        return view('admin.admins.permissions.index',['permissions' => $permissions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.admins.permissions.create');
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
            'name' => trans('admin.name'),
        ]);
        Permission::create([
            'name' => request('name'),
            'guard_name' => 'admin',
        ]);
        return redirect(aurl('permissions'))->with(session()->flash('message',trans('admin.success_add')));
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
        return view('admin.admins.permissions.edit',['permission'=>$permission]);
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
            'name' => trans('admin.name')
        ]);
        $role = Permission::findOrFail($id);

        $role->name = $request->name;
        $role->guard_name = 'admin';
        $role->save();
        return redirect(aurl('permissions'))->with(session()->flash('message',trans('admin.success_update')));
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
        return redirect(aurl('permissions'));
    }
}
