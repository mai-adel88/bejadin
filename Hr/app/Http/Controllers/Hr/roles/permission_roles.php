<?php

namespace App\Http\Controllers\Hr\roles;
use App\Models\Hr\Hr;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class permission_roles extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit($id,Role $roles,Permission $permission)
    {
        $admin = Hr::find($id);
        $roles = $roles->where('guard_name', 'hr')->pluck('name', 'name');
        $roles->all();
        $permissions = $permission->where('guard_name', 'hr')->pluck('name', 'name');
        $permissions->all();
        return  view('hr.hrs.per_role_edit',compact('admin','permissions','roles'));
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
        $admin = Hr::find($id);
        $roles = $request['roles']; //Retrieving the roles field
        //Checking if a role was selected
        $admin->syncRoles($request['roles']);
        $permissions = $request->permissions;
        $admin->syncPermissions($permissions);
        return redirect(route('hrs.show', $admin->id))->with(session()->flash('message',trans('admin.success_update')));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
