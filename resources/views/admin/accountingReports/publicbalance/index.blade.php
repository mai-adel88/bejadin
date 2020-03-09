@extends('admin.index')
@section('title', trans('admin.trial_balance'))
@section('content')
    @push('js')
        <script>
            $(function () {
                'use strict';
                $('.level').on('change',function () {
                    var departments = $('#departments option:selected').val();
                    var from = $('.from').val();
                    var to = $('.to').val();
                    var level = $('.level').val();

                    if (this){
                        $("#loadingmessage").css("display","block");
                        $(".column-form").css("display","none");
                        $.ajax({
                            url: '{{aurl('publicbalance/show')}}',
                            type:'get',
                            dataType:'json',
                            data:{departments : departments,from: from,to: to,level:level},
                            success: function (dataa) {
                                $("#loadingmessage").css("display","none");



                                $('.column-form').css("display","block").html(dataa[0]);
                                // $('.level').css("display","block").html(dataa[1]);
                            }
                        });
                    }else{
                        $('.levels').html('');
                    }
                });
            });
            $(function () {
                'use strict';
                $('.to,.from,.departments').on('change',function () {
                    var departments = $('.departments').val();
                    var level = $('.level').val();
                    var from = $('.from').val();
                    var to = $('.to').val();

                    if (this){
                        $("#loadingmessage").css("display","block");
                        $(".column-form").css("display","none");
                        $.ajax({
                            url: '{{aurl('publicbalance/show')}}',
                            type:'get',
                            dataType:'json',
                            data:{departments : departments,from: from,level: level,to: to},
                            success: function (dataa) {
                                $("#loadingmessage").css("display","none");
                                $('.level').empty();
                                $('.column-form').css("display","block").html(dataa[0]);
                                $('.level').css("display","block").html(dataa[1]);
                            }
                        });
                    }else{
                        $('.column-form').html('');
                    }
                });
            });
        </script>
        <script>
            $(document).ready(function(){
                var minDate = '{{\Carbon\Carbon::today()->format('Y-m-d')}}';
                console.log(minDate);
                $('.date').datepicker({
                    format: 'yyyy-mm-dd',
                    rtl: true,
                    language: '{{session('lang')}}',
                    autoclose:true,
                    todayBtn:true,
                    clearBtn:true,
                });
            });
        </script>
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
    @push('css')
        <style>
            .select2-container--default .select2-selection--multiple .select2-selection__choice{
                background-color: #333;
            }
        </style>

    @endpush
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{trans('admin.trial_balance')}}</h3>
        </div>
        @include('admin.layouts.message')
        <div class="box-body">

            <div class="form-group row">
                <div class="col-md-3">
                    {{ Form::label('departments',trans('admin.department'), ['class' => 'control-label']) }}
                    {{ Form::select('departments',$departments,null, array_merge(['class' => 'form-control e2 departments','placeholder'=> trans('admin.select') ])) }}
                </div>

                <div class="col-md-3 ">
                    {{ Form::label('level',trans('admin.level'), ['class' => 'control-label']) }}


                    {{ Form::select('level',[0=>trans('admin.select')], null, array_merge(['class' => 'form-control level','id' =>'level'])) }}



                </div>
                <div class="col-md-3">
                    {{ Form::label('from',trans('admin.from'), ['class' => 'control-label']) }}
                    {{ Form::text('from',date("Y-m-1", strtotime('1-1-'.\Carbon\Carbon::today()->format('Y')) ), array_merge(['class' => 'form-control from date' ])) }}
                </div>

                <div class="col-md-3" id="otherFieldDiv">
                    {{ Form::label('to',trans('admin.to'), ['class' => 'control-label']) }}
                    {{ Form::text('to',\Carbon\Carbon::today()->format('Y-m-d'), array_merge(['class' => 'form-control to date'])) }}
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
            {{--loader spinner--}}


        </div>
    </div>
    {{--<button class="btn btn-default" onclick="printPageArea()" id="primaryButton"><i class="fa fa-print"></i> {{trans('admin.print')}} </button>--}}

@endsection