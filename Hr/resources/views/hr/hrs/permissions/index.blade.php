@extends('hr.index')
@section('title',trans('hr.permissions'))
@section('content')

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{trans('hr.permissions_datatable')}}</h3>
        </div>
        <!-- /.box-header -->
        @include('hr.layouts.message')

        <a href="{{route('HrPermissions.create')}}" class="btn btn-primary"><i class="fa fa-plus"></i> {{trans('hr.add_permissions')}} </a>
        <a href="{{route('hrs.index')}}" class="btn btn-primary"><i class="fa fa-users"></i> {{trans('hr.hr_account')}}  </a>

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
                @foreach($permissions as $permission)
                    <tr>
                        <td>{{$permission->id}}</td>
                        <td>{{$permission->name}}</td>
                        <td><a href="{{route('HrPermissions.edit',$permission->id)}}" class="btn btn-success"><i class="fa fa-edit"></i></a></td>
                        <td>
                            {!! Form::open(['method' => 'DELETE', 'route' => ['HrPermissions.destroy',$permission->id]]) !!}

                            {!! Form::button('<i class="glyphicon glyphicon-trash"></i> ' , ['type' => 'submit', 'class' => 'btn btn-danger']) !!}

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
