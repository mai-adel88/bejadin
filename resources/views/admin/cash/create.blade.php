@extends('admin.index')
@section('title',trans('admin.create_catch_receipt'))
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
<receipts-component invoice="{{generateBarcodeNumber()}}"></receipts-component>
<vue-progress-bar>

</vue-progress-bar>




@endsection
