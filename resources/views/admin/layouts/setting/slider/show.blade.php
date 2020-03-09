@extends('admin.index')

@section('content')
    <div class="box">
        <div class="container-fluid">
            <div class="row">
                <div class="box-header">
                    <h3 class="box-title">Slider Info</h3>
                </div>
                <hr>
                <div class="col-md-8">
                    <div class="box-body">
                        <h3 >{{ $slide->title }}</h3><br>
                        <h5>{{ $slide->tag }}</h5><br>
                        <p>{{ $slide->body }}</p>
                        <hr>
                        <img src="{{ asset('elshehry/data1/images/' . $slide->image) }}" class="img-responsive" alt="">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="well" style="margin-top: 20px;">
                        <div>
                            <label>Created At:</label>
                            <p>{{ date('M j, Y H:i A', strtotime($slide->created_at)) }}</p>
                        </div>
                        <div>
                            <label>Last Update At:</label>
                            <p>{{ date('M j, Y h:i A', strtotime($slide->updated_at)) }}</p>
                        </div>
                        <hr>
                        <div class="row text-center">
                            <div class="col-sm-6">
                                {!! Html::linkRoute('slider.edit', 'Edit', array($slide->id), array('class' => 'btn btn-primary btn-block')) !!}
                            </div>
                            <div class="col-sm-6">
                                {!! Form::open(['route' => ['slider.destroy', $slide->id], 'method' => 'DELETE']) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-block']) !!}
                                {!! Form::close() !!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                {{ Html::linkRoute('slider.index', 'All sliders', [], ['class' => 'btn btn-default btn-block', 'style' => 'margin-top:18px']) }}
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection