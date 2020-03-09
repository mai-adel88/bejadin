@extends('hr.index')
@section('title',trans('hr.permissions_and_roles'))
@section('root_link', route('hrs.index'))
@section('root_name', trans('hr.hr_account'))
@section('content')
@hasrole('hr')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{trans('hr.permissions_and_roles')}}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive">
            <table id="show-table" class="table table-bordered table-hover text-center">
                <thead>
                    <tr>
                        <th>{{trans('hr.name')}}</th>
                        <th>{{trans('hr.permissions')}}</th>
                        <th>{{trans('hr.roles')}}</th>
                        <th>{{trans('hr.edit')}}</th>
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
                        <td><a href="{{route('HrPermission_role.edit',$admin->id)}}" class="btn btn-success">{{trans('hr.edit')}}</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- /.box-body -->
    </div>


@else
    <div class="alert alert-danger">{{trans('hr.access_denied')}}</div>

    @endhasrole





@endsection
