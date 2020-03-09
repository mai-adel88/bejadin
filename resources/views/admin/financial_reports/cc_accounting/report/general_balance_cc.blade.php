@extends('admin.index')
@section('title', trans('admin.trial_balance_cc'))
@section('content')
    @push('js')
        <script>
            $(function () {
                'use strict';
                $('.glcc').on('change',function () {
                    var glcc = $('.glcc').val();
                    if (this){
                        $("#loadingmessage").css("display","block");
                        $(".column-form").css("display","none");
                        $.ajax({
                            url: '{{aurl('cc/report/ccpublicbalance/level')}}',
                            type:'get',
                            dataType:'json',
                            data:{glcc : glcc},
                            success: function ($data) {
                                $("#loadingmessage").css("display","none");
                                // $('.level').empty();
                                // $('.column-form').css("display","block").html(dataa[0]);
                                $('.level').css("display","block").html($data[1]);
                            }
                        });
                    }else{
                        $('.column-form').html('');
                    }
                });
            });

            $(function () {
                'use strict';
                $('.level,.kind,.to,.from').on('change',function () {
                    var glcc = $('.glcc option:selected').val();
                    var level = $('.level').val();
                    var kind = $('.kind').val();
                    var from = $('.from').val();
                    var to = $('.to').val();

                    if (this){
                        $("#loadingmessage").css("display","block");
                        $(".column-form").css("display","none");
                        $.ajax({
                            url: '{{aurl('cc/report/ccpublicbalance/print')}}',
                            type:'get',
                            dataType:'json',
                            data:{glcc : glcc,level:level,kind:kind,from:from,to:to},
                            success: function ($data) {
                                $("#loadingmessage").css("display","none");
                                // $('.level').empty();
                                // $('.level').css("display","block").html($data[0]);
                                $('.column-form').css("display","block").html($data[1]);
                            }
                        });
                    }else{
                        $('.column-form').html('');
                    }
                });
            });
            {{--$(function () {--}}
            {{--    'use strict';--}}
            {{--    $('.kind,.to,.from').on('change',function () {--}}
            {{--        var glcc = $('.glcc option:selected').val();--}}
            {{--        var level = $('.level').val();--}}
            {{--        var kind = $('.kind').val();--}}
            {{--        var from = $('.from').val();--}}
            {{--        var to = $('.to').val();--}}



            {{--        if (this){--}}
            {{--            $("#loadingmessage").css("display","block");--}}
            {{--            $(".column-form").css("display","none");--}}
            {{--            $.ajax({--}}
            {{--                url: '{{aurl('cc/report/ccpublicbalance/print')}}',--}}
            {{--                type:'get',--}}
            {{--                dataType:'html',--}}
            {{--                data:{glcc : glcc,level:level,kind:kind,from: from,to: to,},--}}
            {{--                success: function (data) {--}}
            {{--                    $("#loadingmessage").css("display","none");--}}



            {{--                    $('.column-form').css("display","block").html(data);--}}
            {{--                    // $('.level').css("display","block").html(dataa[1]);--}}
            {{--                }--}}
            {{--            });--}}
            {{--        }else{--}}

            {{--            $('.levels').html('');--}}
            {{--        }--}}
            {{--    });--}}
            {{--});--}}


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
            <h3 class="box-title">{{trans('admin.trial_balance_cc')}}</h3>
        </div>
        @include('admin.layouts.message')
        <div class="box-body">

            <div class="form-group row">
                <div class="col-md-4">
                    {{ Form::label('glcc',trans('admin.cc'), ['class' => 'control-label']) }}
                    {{ Form::select('glcc',[0,1],null, array_merge(['class' => 'form-control e2 glcc','placeholder'=> trans('admin.select') ])) }}
                </div>

                <div class="col-md-4 ">
                    {{ Form::label('level',trans('admin.level'), ['class' => 'control-label']) }}


                    {{ Form::select('level',[0=>trans('admin.select')], null, array_merge(['class' => 'form-control level','id' =>'level'])) }}



                </div>
                <div class="col-md-4">
                    {{ Form::label('kind',trans('admin.type'), ['class' => 'control-label']) }}
                    {{ Form::select('kind',\App\Enums\dataLinks\CCacountType::toSelectArray(),null, array_merge(['class' => 'form-control kind','placeholder'=> trans('admin.select') ])) }}
                </div>
                <div class="col-md-6">
                    {{ Form::label('from',trans('admin.from'), ['class' => 'control-label']) }}
                    {{ Form::text('from',date("Y-m-1", strtotime('1-1-'.\Carbon\Carbon::today()->format('Y')) ), array_merge(['class' => 'form-control from date' ])) }}
                </div>

                <div class="col-md-6" id="otherFieldDiv">
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

<a href="javascript:history.back()" class="btn btn-danger">الرجوع</a>
        </div>
    </div>
    {{--<button class="btn btn-default" onclick="printPageArea()" id="primaryButton"><i class="fa fa-print"></i> {{trans('admin.print')}} </button>--}}

@endsection
