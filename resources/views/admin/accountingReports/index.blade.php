@extends('admin.index')
@section('title', trans('admin.daily_report'))
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

            $('.branches,.operations,.type,.kind').on('change',function () {
                var operations = $('.operations option:selected').val();
                var branches = $('.branches option:selected').val();
                var type = $('.type option:selected').val();
                var kind = $("input[name='kind']:checked").val();
                $("#loadingmessage").css("display","block");
                $(".column-form").css("display","none");
                console.log(operations,branches,type,kind);
                if (this){
                    $.ajax({
                        url: '{{aurl('dailyReport/show')}}',
                        type:'get',
                        dataType:'html',
                        data:{operations : operations,branches: branches,type: type,kind: kind},
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
@push('js')

    <script>
        $(document).ready(function() {

            $(".e2").select2({
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
        <h3 class="box-title">{{trans('admin.daily_report')}}</h3>
    </div>
    @include('admin.layouts.message')
<div class="box-body">

    <div class="form-group row">
        <div class="col-md-3">
            {{ Form::label('operations', trans('admin.account_type'), ['class' => 'control-label']) }}
            {{ Form::select('operations', $operations,null, array_merge(['class' => 'form-control operations','placeholder'=>trans('admin.select')])) }}
        </div>
        <div class="col-md-3">
            {{ Form::label('branches', trans('admin.Branches'), ['class' => 'control-label']) }}
            {{ Form::select('branches', $branches,null, array_merge(['class' => 'form-control branches','placeholder'=>trans('admin.select')])) }}
        </div>
        <div class="col-md-3">
            {{ Form::label('type', trans('admin.TypeOfConstraintOrBond'), ['class' => 'control-label']) }}
            {{ Form::select('type', $limitationReceipts,null, array_merge(['class' => 'form-control type','placeholder'=>trans('admin.select')])) }}
        </div>
        <div class="col-md-3 text-center">
            <div style="padding-top: 15px">
                <label><input type="radio" name="kind" value="0" class="kind">    {{trans('admin.by_date')}}</label>
                <br>
                <label><input type="radio" name="kind" value="1" class="kind">    {{trans('admin.by_receipt')}}</label>
            </div>
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
