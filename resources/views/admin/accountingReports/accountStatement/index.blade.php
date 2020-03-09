@extends('admin.index')
@section('title', trans('admin.account_statement'))
@section('content')
@push('js')

    <script>


        function printPageArea(areaID){
            var divElements = document.getElementById('report').innerHTML;
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

            $('.branches,.operations').on('change',function () {
                var operations = $('.operations option:selected').val();
                var branches = $('.branches option:selected').val();
                $("#loadingmessage").css("display","block");
                $(".column-form").css("display","none");
                console.log(operations,branches);
                if (this){
                    $.ajax({
                        url: '{{aurl('accountStatement/show')}}',
                        type:'get',
                        dataType:'html',
                        data:{operations : operations,branches: branches},
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
        <h3 class="box-title">{{trans('admin.account_statement')}}</h3>
    </div>
    @include('admin.layouts.message')
<div class="box-body">

    <div class="form-group row">
        <div class="col-md-6">
            {{ Form::label('operations', trans('admin.account_type'), ['class' => 'control-label']) }}
            {{ Form::select('operations', $operations,null, array_merge(['class' => 'form-control operations','placeholder'=>trans('admin.select')])) }}
        </div>
        <div class="col-md-6">
            {{ Form::label('branches', trans('admin.Branches'), ['class' => 'control-label']) }}
            {{ Form::select('branches', $branches,null, array_merge(['class' => 'form-control branches','placeholder'=>trans('admin.select')])) }}
        </div>
    </div>
    <br>
    {{--loader spinner--}}
    <div id='loadingmessage' style='display:none; margin-top: 20px' class="text-center">
        <img src="{{ url('/') }}/images/ajax-loader.gif"/>
    </div>
    <div id="report">
        <div class="column-form">

        </div>
    </div>
    <br>


</div>
</div>
{{--<button class="btn btn-default" onclick="printPageArea()" id="primaryButton"><i class="fa fa-print"></i> {{trans('admin.print')}} </button>--}}

@endsection
