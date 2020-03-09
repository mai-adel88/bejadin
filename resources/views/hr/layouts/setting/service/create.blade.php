@extends('admin.index')

@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Create New Service Post</h3>
        </div>

        <div class="box-body">
            {!!  Form::open(array('route' => 'service.store', 'files' => 'true')) !!}

                {{ Form::label('title', 'Title:') }}
                {{ Form::text('title', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '255')) }}

                {{ Form::label('icon', 'Upload Icon:', array( 'style' => 'margin-top: 20px;')) }}
                {{ Form::file('icon') }}

                {{ Form::label('image', 'Upload Image:', array( 'style' => 'margin-top: 20px;')) }}
                {{ Form::file('image') }}

                {{ Form::label('mini_desc', 'Mini Desc:', array( 'style' => 'margin-top: 20px;')) }}
                {{ Form::textarea('mini_desc', null, array('class' => 'form-control', 'id' => 'textarea')) }}

                {{ Form::label('body', 'Body:', array( 'style' => 'margin-top: 20px;')) }}
                {{ Form::textarea('body', null, array('class' => 'form-control', 'id' => 'textarea')) }}

                {{ Form::submit('Create New Service Post', array('class' => 'btn btn-success btn-lg btn-block', 'style' => 'margin-top: 20px;')) }}

            {!! Form::close() !!}
        </div>
    </div>
@endsection