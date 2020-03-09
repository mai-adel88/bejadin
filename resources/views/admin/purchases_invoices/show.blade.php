@extends('admin.index')
@section('title',trans('admin.permission_Role'))
@section('content')
@hasrole('admin')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{trans('admin.permission_Role')}}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive">
            <table id="show-table" class="table table-bordered table-hover text-center">
                <thead>
                    <tr>
                        <th>{{trans('admin.name')}}</th>
                        <th>{{trans('admin.Permissions')}}</th>
                        <th>{{trans('admin.Roles')}}</th>
                        <th>{{trans('admin.edit')}}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{$admin->name}}</td>
                        <td>
                            @foreach($admin->permissions as $permission)
                                <span class="badge">{{$permission->name}}</span>
                            @endforeach
                        </td>
                        <td>
                            @foreach($admin->getRoleNames() as $role)
                                <span class="badge">{{$role}}</span>
                            @endforeach
                        </td>
                        <td><a href="{{route('permission_role.edit',$admin->id)}}" class="btn btn-success">{{trans('admin.edit')}}</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- /.box-body -->
    </div>


@else
    <div class="alert alert-danger">{{trans('admin.you_cannt_see_invoice_because_you_dont_have_role_to_access')}}</div>

    @endhasrole





@endsection