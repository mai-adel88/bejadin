@extends('admin.index')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <h1>All Sliders</h1>
        </div>

        <div class="col-md-4">
            <a href="{{ route('slider.create') }}" class="btn btn-primary btn-block btn-line" style="margin-top: 20px;">Create New Slider</a>
        </div>
        <div class="col-md-12">
            <hr>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead>
                <tr>
                    <th>#ID</th>
                    <th>Title</th>
                    <th>Tag</th>
                    <th>Body</th>
                    <th>Control</th>
                </tr>
                </thead>
                <tbody>
                @foreach($slides as $slide)

                    <tr>
                        <th>{{ $slide->id }}</th>
                        <td>
                            {{ $slide->title }}
                        </td>
                        <td>
                            {{ $slide->tag }}
                        </td>
                        <td>
                            {{ substr(strip_tags($slide->body), 0, 40) }} {{ strlen(strip_tags($slide->body)) > 40 ? "...." : "" }}
                        </td>
                        <td>
                            {!! Html::linkRoute('slider.show', 'View', array($slide['id']), array('class' => 'btn btn-success btn-sm')) !!}
                            {!! Html::linkRoute('slider.edit', 'Edit', array($slide['id']), array('class' => 'btn btn-primary btn-sm')) !!}
                        </td>
                    </tr>


                @endforeach
                </tbody>
            </table>

        </div>
    </div>
@endsection