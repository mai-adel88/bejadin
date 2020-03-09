@extends('admin.index')

@section('content')
    <div class="box">
        <div class="container-fluid">
            <div class="row">
                <div class="box-header">
                    <h3 class="box-title">About Info</h3>
                </div>
                <hr>
                <div class="col-md-8">
                    <div class="box-body">
                        <span>Title:</span>
                        <h3 >{{ $about->title }}</h3><br>
                        <span>Body:</span>
                        <p>{{ $about->body }}</p>
                        <hr>
                        <span>Image:</span>
                        <img src="{{ asset('elshehry/images/' . $about->image) }}" class="img-responsive" alt="">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="well" style="margin-top: 20px;">
                        <div>
                            <label>Created At:</label>
                            <p>{{ date('M j, Y H:i A', strtotime($about->created_at)) }}</p>
                        </div>
                        <div>
                            <label>Last Update At:</label>
                            <p>{{ date('M j, Y h:i A', strtotime($about->updated_at)) }}</p>
                        </div>
                        <hr>
                        <div class="row text-center">
                            <div class="col-sm-6">
                                {!! Html::linkRoute('about.edit', 'Edit', array($about->id), array('class' => 'btn btn-primary btn-block')) !!}
                            </div>
                            <div class="col-sm-6">
                                {!! Form::open(['route' => ['about.destroy', $about->id], 'method' => 'DELETE']) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-block']) !!}
                                {!! Form::close() !!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                {{ Html::linkRoute('about.index', 'All About Posts', [], ['class' => 'btn btn-default btn-block', 'style' => 'margin-top:18px']) }}
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection