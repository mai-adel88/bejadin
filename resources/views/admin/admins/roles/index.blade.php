@extends('admin.index')
@section('title',trans('admin.Roles_datatable'))
@section('content')

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{trans('admin.Roles_datatable')}}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive">
            <a href="{{route('roles.create')}}" class="btn btn-primary"><i class="fa fa-plus"></i>{{trans('admin.Add_New_Role')}} </a>
            <a href="{{route('admins.index')}}" class="btn btn-primary"><i class="fa fa-users"></i> {{trans('admin.admins')}}</a>
            <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>{{trans('admin.id')}}</th>
                    <th>{{trans('admin.name')}}</th>
                    <th>{{trans('admin.edit')}}</th>
                    <th>{{trans('admin.delete')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($roles as $role)
                    <tr>
                        <td>{{$role->id}}</td>
                        <td>{{$role->name}}</td>
                        <td><a href="{{route('roles.edit',$role->id)}}" class="btn btn-success"><i class="fa fa-edit"></i> {{trans('admin.edit')}}</a></td>
                        <td>
                            {!! Form::open(['method' => 'DELETE', 'route' => ['roles.destroy',$role->id]]) !!}

                            {!! Form::button('<i class="glyphicon glyphicon-trash"></i> ' . trans('admin.delete') , ['type' => 'submit', 'class' => 'btn btn-danger']) !!}

                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>

                </tfoot>
            </table>
        </div>
        <!-- /.box-body -->
    </div>







@endsection