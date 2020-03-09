@extends('admin.index')
@section('title', trans('admin.Edit_admin'))
@section('content')
@hasrole('admin')
    <div class="box">
        @include('admin.layouts.message')
        <div class="box-header">
            <h3 class="box-title">{{$title}}</h3>
        </div>
        <div class="box-body">
            {!! Form::model($admin,['method'=>'PUT','route' => ['admins.update',$admin->id],'files'=>true]) !!}
            <div class="form-group">
                {{ Form::label('admin.Branches', trans('admin.Branches') , ['class' => 'control-label']) }}
                {{ Form::select('branches_id', $branch,$admin->branches_id, array_merge(['class' => 'form-control','placeholder'=>trans('admin.select')])) }}
            </div>
            <div class="form-group">
                {{ Form::label( trans('admin.name'), null, ['class' => 'control-label']) }}
                {{ Form::text('name', $admin->name, array_merge(['class' => 'form-control'])) }}
            </div>
            <div class="form-group">
                {{ Form::label( trans('admin.email'), null, ['class' => 'control-label']) }}
                {{ Form::email('email', $admin->email, array_merge(['class' => 'form-control'])) }}
            </div>
            <div class="form-group">
                {{ Form::label( trans('admin.password'), null, ['class' => 'control-label']) }}
                {{ Form::password('password', array_merge(['class' => 'form-control'])) }}
            </div>
            <div class="form-group">
                {{ Form::label( trans('admin.image'), null, ['class' => 'control-label']) }}
                {{ Form::file('image', array_merge(['class' => 'form-control'])) }}
                <img src="{{asset('storage/'.$admin->image)}}" style="width: 100px">
            </div>
            {{Form::submit( trans('admin.update'),['class'=>'btn btn-primary'])}}
            {!! Form::close() !!}
        </div>
    </div>

@else
    <div class="alert alert-danger">{{trans('admin.you_cannt_see_invoice_because_you_dont_have_role_to_access')}}</div>

    @endhasrole






@endsection