@extends('admin.index')
@section('title',trans('admin.create_limitations'))
@section('content')


    @push('js')
        <script>
            $(function () {
                'use strict'
                $('.e2').select2({
                    placeholder: "{{trans('admin.select')}}",
                    dir: '{{direction()}}'
                });
            });

        </script>
    @endpush



<openingentry-component invoice="{{generateBarcodeNumber()}}"></openingentry-component>
<vue-progress-bar></vue-progress-bar>







@endsection
