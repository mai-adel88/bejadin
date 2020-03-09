@extends('admin.index')

@section('content')
    <div class="row">
        {!! Form::model($service, ['route' => ['service.update', $service['id']], 'method' => 'PUT', 'files' => 'true']) !!}
        <div class="col-md-8">
            {{ Form::label('title', 'Title:') }}
            {{ Form::text('title', null, ['class' => 'form-control input-lg']) }}

            {{ Form::label('icon', 'Update Icon:', array( 'style' => 'margin-top: 20px;')) }}
            {{ Form::file('icon') }}

            {{ Form::label('image', 'Update Image:', array( 'style' => 'margin-top: 20px;')) }}
            {{ Form::file('image') }}

            {{ Form::label('body', 'Body:', array( 'style' => 'margin-top: 20px;')) }}
            {{ Form::textarea('body', null, ['class' => 'form-control', 'id' => 'textarea']) }}

        </div>
        <div class="col-md-4">
            <div class="well">
                <div>
                    <label>Created At:</label>
                    <p>{{ date('M j, Y H:i A', strtotime($service->created_at)) }}</p>
                </div>
                <div>
                    <label>Last Update At:</label>
                    <p>{{ date('M j, Y h:i A', strtotime($service->updated_at)) }}</p>
                </div>
                <hr>
                <div class="row text-center">
                    <div class="col-sm-6">
                        {!! Html::linkRoute('service.show', 'Cancel', array($service['id']), array('class' => 'btn btn-danger btn-block')) !!}
                    </div>

                    <div class="col-sm-6">
                        {{ Form::submit('Save', array('class' => 'btn btn-success btn-block')) }}
                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div> <!-- end of row -->
@endsection