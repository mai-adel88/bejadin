@extends('admin.index')

@section('content')
    <div class="box">
        <div class="container-fluid">
            <div class="row">
                <div class="box-header">
                    <h3 class="box-title">Service Info</h3>
                </div>
                <hr>
                <div class="col-md-8">
                    <div class="box-body">
                        <span>Title:</span>
                        <h3>
                            {{ $service->title }}
                        </h3>
                        <hr>
                        <span>Body:</span>
                        <p>
                            {{ $service->body }}
                        </p>
                        <hr>
                        <span>mini Desc:</span>
                        <p>
                            {{ $service->mini_desc }}
                        </p>
                        <hr>
                        <span>Icon:</span>
                        <img src="{{ asset('elshehry/images/' . $service->icon) }}" class="img-responsive" alt="">
                        <hr>
                        <span>Image:</span>
                        <img src="{{ asset('elshehry/images/' . $service->image) }}" class="img-responsive" alt="">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="well" style="margin-top: 20px;">
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
                                {!! Html::linkRoute('service.edit', 'Edit', array($service->id), array('class' => 'btn btn-primary btn-block')) !!}
                            </div>
                            <div class="col-sm-6">
                                {!! Form::open(['route' => ['service.destroy', $service->id], 'method' => 'DELETE']) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-block']) !!}
                                {!! Form::close() !!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                {{ Html::linkRoute('service.index', 'All Services Posts', [], ['class' => 'btn btn-default btn-block', 'style' => 'margin-top:18px']) }}
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection