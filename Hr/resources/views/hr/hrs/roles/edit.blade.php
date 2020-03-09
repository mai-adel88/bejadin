@extends('hr.index')
@section('title',trans('hr.edit_roles'))
@section('root_link', route('HrRoles.index'))
@section('root_name',trans('hr.roles'))
@section('content')
@hasrole('writer')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{trans('hr.edit_roles')}}</h3>
        </div>

        <div class="col-md-12">@include('admin.layouts.message')</div>
        <div class="box-body">
            {!! Form::model($role,['method'=>'PUT','route' => ['HrRoles.update',$role->id]]) !!}
            <div class="form-group">
                {{ Form::label(trans('admin.name'), null, ['class' => 'control-label']) }}
                {{ Form::text('name', $role->name, array_merge(['class' => 'form-control'])) }}
            </div>
            {{Form::submit(trans('hr.edit'),['class'=>'btn btn-primary'])}}
            {!! Form::close() !!}
        </div>
    </div>
@else
    <div class="alert alert-danger">{{trans('hr.access_denied')}}</div>

@endhasrole

@endsection
