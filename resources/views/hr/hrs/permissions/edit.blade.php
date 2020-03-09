@extends('hr.index')
@section('title',trans('hr.edit_permissions'))
@section('root_link',route('HrPermissions.index'))
@section('root_name',trans('hr.permissions'))
@section('content')
@hasrole('hr')
@can('create')
    <div class="box">
        @include('hr.layouts.message')
        <div class="box-header">
            <h3 class="box-title">{{trans('hr.edit_permissions')}}</h3>
        </div>
        <div class="box-body">
            {!! Form::model($permission,['method'=>'PUT','route' => ['HrPermissions.update',$permission->id]]) !!}
            <div class="form-group">
                {{ Form::label(trans('hr.name'), null, ['class' => 'control-label']) }}
                {{ Form::text('name', $permission->name, array_merge(['class' => 'form-control'])) }}
            </div>
            {{Form::submit(trans('hr.edit'),['class'=>'btn btn-primary'])}}
            {!! Form::close() !!}
        </div>
    </div>
@endcan
@else
    <div class="alert alert-danger">{{trans('hr.access_denied')}}</div>
@endhasrole

@endsection
