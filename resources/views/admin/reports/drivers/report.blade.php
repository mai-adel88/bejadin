@extends('admin.index')
@section('title',trans('admin.Reports_Drivers'))
@section('content')
    @push('js')

        <script>

            function printPageArea(areaID){
                var divElements = document.getElementById('invoice').innerHTML;
                //Get the HTML of whole page
                var oldPage = document.body.innerHTML;

                //Reset the page's HTML with div's HTML only
                document.body.innerHTML =
                    "<html><head><title></title></head><body>" +
                    divElements + "</body>";

                //Print Page
                window.print();
                window.location.reload(true);
                //Restore orignal HTML
                document.body.innerHTML = oldPage;
            }

        </script>
    @endpush
@push('js')
    <script>
        $(function () {
            'use strict';

            $(document).on('change','.drivers',function () {
                var driver = $('.drivers option:selected').val();
                var dateToday = new Date();
                $("#loadingmessage").css("display","block");
                $(".column-form").css("display","none");
                if (driver > 0){
                    $.ajax({
                        url: '{{aurl('reportdriver/show')}}',
                        type:'get',
                        dataType:'html',
                        data:{driver : driver},
                        success: function (data) {
                            $("#loadingmessage").css("display","none");
                            $('.column-form').css("display","block").html(data);

                            $('.datepicker').datepicker({
                                format: 'yyyy-mm-dd',
                                rtl: true,
                                language: '{{session('lang')}}',
                                inline:true,
                                minDate: 0,
                                autoclose:true,
                                minDateTime: dateToday

                            });
                        }
                    });
                }else{
                    $('.column-form').html('');
                }
            });

            $('.drivers').on('change',function () {
                $('body').find('.linkpdf').find( "a" ).remove();
                var url = $('.drivers option:selected').attr('data-url');
                $('.linkpdf').append('<a href="' + url + '">' + 'Print pdf' + '</a>');
            });


        });
    </script>

@endpush
@push('js')

    <script>
        $(document).ready(function() {

            $("#e2_2").select2({
                placeholder: "{{trans('admin.select')}}",
                allowClear: true,
                dir: '{{direction()}}'
            });


        });
    </script>


@endpush
@push('css')
    <style>
        .select2-container--default .select2-selection--multiple .select2-selection__choice{
            background-color: #333;
        }
    </style>

@endpush
<div class="box">
    <div class="box-header">
        <h3 class="box-title">{{trans('admin.Reports_Drivers')}}</h3>
    </div>
@include('admin.layouts.message')
<!-- /.box-header -->
<div class="box-body">

    <div class="form-group">
        {{ Form::label('drivers', trans('admin.drivers'), ['class' => 'control-label']) }}
        <select name="driver_id" class="drivers form-control" id='e2_2' placeholder="{{trans('admin.select')}}">
            <option></option>
            @foreach ($drivers as $driver)
        <option data-url="{{ url('admin/reportpdf/pdf/' . $driver->id) }}" class="pdf" value="{{$driver->id}}">{{session_lang($driver->name_en,$driver->name_ar)}}   </option>
            @endforeach
        </select>

    </div>
    <br>
    <div id="invoice">
        {{--loader spinner--}}
        <div id='loadingmessage' style='display:none; margin-top: 20px' class="text-center">
            <img src="{{ url('/') }}/images/ajax-loader.gif"/>
        </div>
    <div class="column-form">

    </div>
    </div>
    <br>

</div>
</div>
    <button class="btn btn-default linkpdf" id="primaryButton"><i class="fa fa-print"></i>    </button>

<!-- /.box-body -->
















@endsection