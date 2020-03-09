@extends('hr.index')
@section('title', trans('hr.edit_hr'))
@section('content')
@hasrole('hr')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{$title}}</h3>
        </div>
        <div class="col-md-12">
            @include('hr.layouts.message')
        </div>
        <div class="box-body">
            {!! Form::model($admin,['method'=>'PUT','route' => ['hrs.update',$admin->id],'files'=>true]) !!}
            <div class="form-group">
                {{ Form::label('admin.Branches', trans('hr.branch') , ['class' => 'control-label']) }}
                {{ Form::select('Brn_No', $branches,$admin->branches_id, array_merge(['class' => 'form-control','placeholder'=>trans('hr.select')])) }}
            </div>
            <div class="form-group">
                {{ Form::label( trans('hr.name'), null, ['class' => 'control-label']) }}
                {{ Form::text('name', $admin->name, array_merge(['class' => 'form-control'])) }}
            </div>
            <div class="form-group">
                {{ Form::label( trans('hr.email'), null, ['class' => 'control-label']) }}
                {{ Form::email('email', $admin->email, array_merge(['class' => 'form-control'])) }}
            </div>
            <div class="form-group">
                {{ Form::label( trans('hr.password'), null, ['class' => 'control-label']) }}
                {{ Form::password('password', array_merge(['class' => 'form-control'])) }}
            </div>
            <div class="form-group">
                {{ Form::label( trans('hr.image'), null, ['class' => 'control-label']) }}
                {{ Form::file('image', array_merge(['class' => 'form-control'])) }}
                @if($admin->image)
                    <img src="{{asset($admin->image)}}" style="width: 100px">
                @endif
            </div>
            {{Form::submit( trans('hr.edit'),['class'=>'btn btn-primary'])}}
            {!! Form::close() !!}
        </div>
    </div>

@else
    <div class="alert alert-danger">{{trans('hr.access_denied')}}</div>

    @endhasrole






@endsection
