@extends('hr.index')
@section('title',trans('hr.com_fixed'))
@section('root_title',trans('hr.com_fixed'))
@section('content')

    @push('js')
        <script>
            $(document).ready(function () {
                {{--$('.Brn_No').change(function () {--}}
                {{--    let BranchNo = $(this).val();--}}
                {{--    $.ajax({--}}
                {{--        url: "{{route('students.index')}}",--}}
                {{--        type: 'get',--}}
                {{--        dataType: 'html',--}}
                {{--        data: {Brn_No: BranchNo},--}}
                {{--        success: function (data) {--}}
                {{--            $('body').html(data)--}}
                {{--        }--}}
                {{--    });--}}
                {{--});--}}
                {{--$('.status').change(function(){--}}
                {{--    let status = $(this).val();--}}
                {{--    $.ajax({--}}
                {{--        url: "{{route('students.index')}}",--}}
                {{--        type: 'get',--}}
                {{--        dataType: 'html',--}}
                {{--        data: {status: status},--}}
                {{--        success: function (data) {--}}
                {{--            $('body').html(data)--}}
                {{--        }--}}
                {{--    });--}}
                {{--});--}}
                {{--$('.Cstm_Activ').change(function(){--}}
                {{--    let Cstm_Activ = $(this).val();--}}
                {{--    $.ajax({--}}
                {{--        url: "{{route('students.index')}}",--}}
                {{--        type: 'get',--}}
                {{--        dataType: 'html',--}}
                {{--        data: {Cstm_Activ: Cstm_Activ},--}}
                {{--        success: function (data) {--}}
                {{--            $('body').html(data)--}}
                {{--        }--}}
                {{--    });--}}
                {{--});--}}
            });
        </script>
    @endpush
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{trans('hr.com_fixed')}}</h3>
        </div>
        <div class="box-body table-responsive">
            @include('hr.layouts.message')
            {!! $dataTable->table([
             'class' => 'table table-bordered table-striped table-hover'
             ],true) !!}
        </div>
    </div>
@push('js')
    {!! $dataTable->scripts() !!}
@endpush
@endsection
