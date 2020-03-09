@extends('admin.index')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <h1>All Posts</h1>
        </div>

        <div class="col-md-4">
            <a href="{{ route('service.create') }}" class="btn btn-primary btn-block btn-line" style="margin-top: 20px;">Create Service Post</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead>
                <tr>
                    <th>#ID</th>
                    <th>Title</th>
                    <th>Mini desc</th>
                    <th>Body</th>
                    <th>Control</th>
                </tr>
                </thead>
                <tbody>
                @foreach($services as $service)

                    <tr>
                        <th>{{ $service->id }}</th>
                        <td>
                            {{ $service->title }}
                        </td>
                        <td>
                            {{ substr(strip_tags($service->mini_desc), 0, 70) }} {{ strlen(strip_tags($service->mini_desc)) > 70 ? "...." : "" }}
                        </td>
                        <td>
                            {{ substr(strip_tags($service->body), 0, 50) }} {{ strlen(strip_tags($service->body)) > 50 ? "...." : "" }}
                        </td>
                        <td>
                            {!! Html::linkRoute('service.show', 'View', array($service['id']), array('class' => 'btn btn-success btn-sm')) !!}
                            {!! Html::linkRoute('service.edit', 'Edit', array($service['id']), array('class' => 'btn btn-primary btn-sm')) !!}
                        </td>
                    </tr>


                @endforeach
                </tbody>
            </table>

        </div>
    </div>
@endsection