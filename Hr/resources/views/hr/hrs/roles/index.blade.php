@extends('hr.index')
@section('title',trans('hr.roles_datatable'))
@section('content')

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{trans('hr.roles_datatable')}}</h3>
        </div>

        @include('hr.layouts.message')

        <a href="{{route('HrRoles.create')}}" class="btn btn-primary"><i class="fa fa-plus"></i> {{trans('hr.add_roles')}} </a>
        <a href="{{route('hrs.index')}}" class="btn btn-primary"><i class="fa fa-users"></i> {{trans('hr.hr_account')}}</a>

        <!-- /.box-header -->
        <div class="box-body table-responsive">
            <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>{{trans('hr.number')}}</th>
                    <th>{{trans('hr.name')}}</th>
                    <th>{{trans('hr.edit')}}</th>
                    <th>{{trans('hr.delete')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($roles as $role)
                    <tr>
                        <td>{{$role->id}}</td>
                        <td>{{$role->name}}</td>
                        <td><a href="{{route('HrRoles.edit',$role->id)}}" class="btn btn-success"><i class="fa fa-edit"></i></a></td>
                        <td>
                            {!! Form::open(['method' => 'DELETE', 'route' => ['HrRoles.destroy',$role->id]]) !!}

                            {!! Form::button('<i class="glyphicon glyphicon-trash"></i> ', ['type' => 'submit', 'class' => 'btn btn-danger']) !!}

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
