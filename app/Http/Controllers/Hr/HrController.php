<?php

namespace App\Http\Controllers\Hr;

use App\Admin;
use App\Branches;
use App\DataTables\AdminsDataTable;
use App\DataTables\HrDataTable;
use App\Models\Hr\Hr;
use App\Http\Controllers\Controller;
use App\Models\Admin\MainBranch;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Up;

class HrController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param HrDataTable $admin
     * @return Response
     */
    public function index(HrDataTable $admin)
    {
        return $admin->render('hr.hrs.index',['title',trans('hr.hr_datatable')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Role $roles,Permission $permissions,MainBranch $branche)
    {
        $branches = $branche->where('Brn_NmAr', '!=', 'null')->where('Brn_NmEn', '!=', 'null')->pluck('Brn_Nm'.ucfirst(session('lang')),'Brn_No');
        return view('hr.hrs.create',['title'=>trans('hr.create_hr'),'roles' => $roles, 'permissions' => $permissions,'branches'=>$branches]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(Request $request,Hr $admin)
    {
        $data = $this->validate($request,[
            'name' => 'required',
            'Brn_No' => 'required',
            'email' => 'required|email|unique:admins',
            'password' => 'required|min:6',
            'image' => 'sometimes|'.validate_image(),
        ],[],[
            'name' => trans('hr.name'),
            'Brn_No' => trans('hr.branch'),
            'email' => trans('hr.email'),
            'password' => trans('hr.password'),
            'image' => trans('hr.image')
        ]);
        if($request->hasFile('image')){
            $admin->image = Up::upload([
                'request' => 'image',
                'path'=>'hrs',
                'upload_type' => 'single'
            ]);
        }
        $admin->name = request('name');
        $admin->email = request('email');
        $admin->password = bcrypt(request('password'));
        $admin->Brn_No = request('Brn_No');
        $admin->save();
        return redirect(hrUrl('hrs'))->with(session()->flash('message',trans('hr.add_success')));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $admin = Hr::find($id);
        return view('hr.hrs.show',['admin'=>$admin]);
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
     * @param int $id
     * @param MainBranch $branche
     * @return Response
     */
    public function edit($id, MainBranch $branche)
    {
        $admin = Hr::findOrFail($id);
        $branches = $branche->where('Brn_NmAr', '!=', 'null')->where('Brn_NmEn', '!=', 'null')->pluck('Brn_Nm'.ucfirst(session('lang')),'Brn_No');
        return view('hr.hrs.edit',['title'=>trans('hr.edit_hr'),'admin'=>$admin,'branches'=>$branches]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $data = $this->validate($request,[
            'name' => 'required',
            'email' => 'required|email|unique:admins,id,'.$id,
            'password' => 'sometimes|nullable|min:6',
            'image' => 'sometimes',
            'Brn_No' => 'required',
        ],[],[
            'name' => trans('hr.name'),
            'email' => trans('hr.email'),
            'password' => trans('hr.password'),
            'image' => trans('hr.image'),
            'Brn_No' => trans('hr.branch'),
        ]);
        $admin = Hr::findOrFail($id);

        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->Brn_No = $request->Brn_No;

        if ( ! $request->password == '')
        {
            $admin->password = bcrypt($request->password);
        }
        if($request->hasFile('image')){
            $admin->image = Up::upload([
                'request' => 'image',
                'path'=>'hrs',
                'upload_type' => 'single',
                'delete_file'=> $admin->image
            ]);
        }
        $admin->save();
        return redirect(hrUrl('hrs'))->with(session()->flash('message',trans('hr.update_success')));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $admin = Hr::findOrFail($id);
        Storage::delete($admin->image);
        $admin->delete();
        return redirect(hrUrl('hrs'))->with(session()->flash('message',trans('hr.delete_success')));
    }



}
