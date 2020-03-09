@extends('admin.index')
@section('title',trans('admin.Edit_Roles'))
@section('content')
@hasrole('writer')
    <div class="box">
        @include('admin.layouts.message')
        <div class="box-header">
            <h3 class="box-title">{{trans('admin.Edit_Roles')}}</h3>
        </div>
        <div class="box-body">
            {!! Form::model($role,['method'=>'PUT','route' => ['roles.update',$role->id]]) !!}
            <div class="form-group">
                {{ Form::label(trans('admin.name'), null, ['class' => 'control-label']) }}
                {{ Form::text('name', $role->name, array_merge(['class' => 'form-control'])) }}
            </div>
            {{Form::submit(trans('admin.update'),['class'=>'btn btn-primary'])}}
            {!! Form::close() !!}
        </div>
    </div>
@else
    <div class="alert alert-danger">{{trans('admin.you_cannt_see_invoice_because_you_dont_have_role_to_access')}}</div>

    @endhasrole







@endsection