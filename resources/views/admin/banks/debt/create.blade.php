@extends('admin.index')
@section('title',trans('admin.create_debt_limitations'))
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
    <limitations-debt-component invoice="{{generateBarcodeNumber()}}"></limitations-debt-component>
    <vue-progress-bar>

    </vue-progress-bar>




@endsection
