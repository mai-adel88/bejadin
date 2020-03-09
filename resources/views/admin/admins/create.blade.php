@extends('admin.index')
@section('title', trans('admin.Create_new_admin'))
@section('content')
@hasrole('admin')
@can('create')
<div class="box">
    @include('admin.layouts.message')
    <div class="box-header">
        <h3 class="box-title">{{$title}}</h3>
    </div>
    <div class="box-body">
        {!! Form::open(['method'=>'POST','route' => 'admins.store','files'=>true]) !!}
        <div class="form-group">
            {{ Form::label('admin.Branches', trans('admin.Branches') , ['class' => 'control-label']) }}
            {{ Form::select('branches_id', $branches,null, array_merge(['class' => 'form-control','placeholder'=>trans('admin.select')])) }}
        </div>
        <div class="form-group">
            {{ Form::label(trans('admin.name'), null, ['class' => 'control-label']) }}
            {{ Form::text('name', old('name'), array_merge(['class' => 'form-control'])) }}
        </div>
        <div class="form-group">
            {{ Form::label(trans('admin.email'), null, ['class' => 'control-label']) }}
            {{ Form::email('email', old('email'), array_merge(['class' => 'form-control'])) }}
        </div>
        <div class="form-group">
            {{ Form::label(trans('admin.password'), null, ['class' => 'control-label']) }}
            {{ Form::password('password', array_merge(['class' => 'form-control'])) }}
        </div>
        <div class="form-group">
            {{ Form::label(trans('admin.image'), null, ['class' => 'control-label']) }}
            {{ Form::file('image', array_merge(['class' => 'form-control'])) }}
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