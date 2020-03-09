@extends('hr.index')
@section('title',trans('hr.add_permissions'))
@section('root_link',route('HrPermissions.index'))
@section('root_name',trans('hr.permissions'))
@section('content')
@hasrole('hr')
@can('create')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{trans('hr.add_permissions')}}</h3>
        </div>
        <div class="col-md-12">@include('hr.layouts.message')</div>
        <div class="box-body">
            {!! Form::open(['method'=>'POST','route' => 'HrPermissions.store']) !!}
            <div class="form-group">
                {{ Form::label(trans('admin.name'), null, ['class' => 'control-label']) }}
                {{ Form::text('name', old('name'), array_merge(['class' => 'form-control'])) }}
            </div>
            {{Form::submit(trans('hr.create'),['class'=>'btn btn-primary'])}}
            {!! Form::close() !!}
        </div>
    </div>
@endcan
@else
    <div class="alert alert-danger">{{trans('hr.access_denies')}}</div>

    @endhasrole

@endsection
