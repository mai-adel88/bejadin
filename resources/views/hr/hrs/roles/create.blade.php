@extends('hr.index')
@section('title',trans('hr.add_roles'))
@section('content')
@hasrole('writer')
@can('create')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{trans('hr.add_roles')}}</h3>
        </div>
        <div class="col-md-12">@include('hr.layouts.message')</div>
        <div class="box-body">
            {!! Form::open(['method'=>'POST','route' => 'HrRoles.store']) !!}
            <div class="form-group">
                {{ Form::label(trans('hr.name'), null, ['class' => 'control-label']) }}
                {{ Form::text('name', old('name'), array_merge(['class' => 'form-control'])) }}
            </div>
            {{Form::submit(trans('hr.create'),['class'=>'btn btn-primary'])}}
            {!! Form::close() !!}
        </div>
    </div>
    @endcan
@else
    <div class="alert alert-danger">{{trans('hr.access_denied')}}</div>

    @endhasrole







@endsection
