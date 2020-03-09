@extends('admin.index')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <h1>All Posts</h1>
        </div>

        <div class="col-md-4">
            <a href="{{ route('about.create') }}" class="btn btn-primary btn-block btn-line" style="margin-top: 20px;">Create New About Post</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead>
                <tr>
                    <th>#ID</th>
                    <th>Title</th>
                    <th>Body</th>
                    <th>Control</th>
                </tr>
                </thead>
                <tbody>
                @foreach($abouts as $about)

                    <tr>
                        <th>{{ $about->id }}</th>
                        <td>
                            {{ $about->title }}
                        </td>
                        <td>
                            {{ substr(strip_tags($about->body), 0, 100) }} {{ strlen(strip_tags($about->body)) > 100 ? "...." : "" }}
                        </td>
                        <td>
                            {!! Html::linkRoute('about.show', 'View', array($about['id']), array('class' => 'btn btn-success btn-sm')) !!}
                            {!! Html::linkRoute('about.edit', 'Edit', array($about['id']), array('class' => 'btn btn-primary btn-sm')) !!}
                        </td>
                    </tr>


                @endforeach
                </tbody>
            </table>

        </div>
    </div>
@endsection