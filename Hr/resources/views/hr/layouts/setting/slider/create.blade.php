@extends('admin.index')

@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Create New Slide</h3>
        </div>

        <div class="box-body">
            {!!  Form::open(array('route' => 'slider.store', 'files' => 'true')) !!}

                {{ Form::label('title', 'Title:') }}
                {{ Form::text('title', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '255')) }}

                {{ Form::label('tag', 'Tag:', array( 'style' => 'margin-top: 20px;')) }}
                {{ Form::text('tag', null, array('class' => 'form-control', 'required' => '', 'minlength' => '5', 'maxlength' => '255')) }}

                {{ Form::label('image', 'Upload Image:', array( 'style' => 'margin-top: 20px;')) }}
                {{ Form::file('image') }}

                {{ Form::label('body', 'Body:', array( 'style' => 'margin-top: 20px;')) }}
                {{ Form::textarea('body', null, array('class' => 'form-control', 'id' => 'textarea')) }}

                {{ Form::submit('Create New Slide', array('class' => 'btn btn-success btn-lg btn-block', 'style' => 'margin-top: 20px;')) }}

            {!! Form::close() !!}
        </div>
    </div>
@endsection