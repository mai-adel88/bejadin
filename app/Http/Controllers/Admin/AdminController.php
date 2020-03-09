<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Branches;
use App\DataTables\AdminsDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Admin\MainBranch;
use Up;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(AdminsDataTable $admin)
    {
        return $admin->render('admin.admins.index',['title',trans('admin.admin_datatable')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Role $roles,Permission $permissions)
    {

        $branches = MainBranch::pluck('Brn_Nm'.ucfirst(session('lang')),'Brn_No');
        return view('admin.admins.create',['title'=>trans('admin.create_admin'),'roles' => $roles, 'permissions' => $permissions,'branches'=>$branches]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Admin $admin)
    {

        $data = $this->validate($request,[
            'name' => 'required',
            'branches_id' => 'required',
            'email' => 'required|email|unique:admins',
            'password' => 'required|min:6',
            'image' => 'sometimes|'.validate_image(),
        ],[],[
            'name' => trans('admin.name'),
            'branches_id' => trans('admin.Branches'),
            'email' => trans('admin.email'),
            'password' => trans('admin.password'),
            'image' => trans('admin.image')
        ]);
        if($request->hasFile('image')){
            $admin->image = Up::upload([
                'request' => 'image',
                'path'=>'admins',
                'upload_type' => 'single'
            ]);
        }
        $admin->name = request('name');
        $admin->email = request('email');
        $admin->password = bcrypt(request('password'));
        $admin->branches_id = request('branches_id');
        $admin->save();
        return redirect(aurl('admins'))->with(session()->flash('message',trans('admin.success_add')));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $admin = Admin::find($id);
        return view('admin.admins.show',['admin'=>$admin]);
//          dd(Admin::findOrFail($id)->getRoleNames()); //retrun all rolles he has
//          dd(Admin::findOrFail($id)->getAllPermissions()); //retrun all permation
//          dd(Admin::findOrFail($id)->hasAnyRole(Role::all())); //retrun true
//        $admin->syncRoles('writer');

//        Admin::findOrFail($id)->givePermissionTo('delete articles');
//        $permissions = auth()->guard('admin')->user()->givePermissionTo(['edit articles', 'delete articles']);;
//       Role::findByName('editor')->givePermissionTo(Permission::findByName('edit articles'));
//        $role = Role::create(['name' => 'editor']);
//        $permission = Permission::create(['name' => 'read articles']);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id,Branches $branche)
    {
        $admin = Admin::findOrFail($id);
        $branches = $branche->pluck('name_'.session('lang'),'id');
        return view('admin.admins.edit',['title'=>trans('admin.edit_admin'),'admin'=>$admin,'branches'=>$branches]);
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
            'name' => 'required',
            'email' => 'required|email|unique:admins,id,'.$id,
            'password' => 'sometimes|nullable|min:6',
            'image' => 'sometimes',
            'branches_id' => 'required',
        ],[],[
            'name' => trans('admin.name'),
            'email' => trans('admin.email'),
            'password' => trans('admin.password'),
            'image' => trans('admin.image'),
            'branches_id' => trans('admin.Branches'),
        ]);
        $admin = Admin::findOrFail($id);

        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->branches_id = $request->branches_id;

        if ( ! $request->password == '')
        {
            $admin->password = bcrypt($request->password);
        }
        if($request->hasFile('image')){
            $admin->image = Up::upload([
                'request' => 'image',
                'path'=>'admins',
                'upload_type' => 'single',
                'delete_file'=> $admin->image
            ]);
        }
        $admin->save();
        return redirect(aurl('admins'))->with(session()->flash('message',trans('admin.success_update')));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $admin = Admin::findOrFail($id);
        Storage::delete($admin->image);
        $admin->delete();
        return redirect(aurl('admins'));
    }



}
