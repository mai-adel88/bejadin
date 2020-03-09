@extends('admin.index')

@section('content')

    <div id="visitor">
        {!! $lava->render("GeoChart","Popularity","visitor")!!}
    </div>


@endsection