@extends('admin.index')
@section('title',trans('admin.Create_new_role'))
@section('content')
@hasrole('writer')
@can('create')
    <div class="box">
        @include('admin.layouts.message')
        <div class="box-header">
            <h3 class="box-title">{{trans('admin.Add_New_Role')}}</h3>
        </div>
        <div class="box-body">
            {!! Form::open(['method'=>'POST','route' => 'roles.store']) !!}
            <div class="form-group">
                {{ Form::label(trans('admin.name'), null, ['class' => 'control-label']) }}
                {{ Form::text('name', old('name'), array_merge(['class' => 'form-control'])) }}
            </div>
            {{Form::submit(trans('admin.create'),['class'=>'btn btn-primary'])}}
            {!! Form::close() !!}
        </div>
    </div>
    @endcan
@else
    <div class="alert alert-danger">{{trans('admin.you_cannt_see_invoice_because_you_dont_have_role_to_access')}}</div>

    @endhasrole







@endsection