@extends('admin.index')
@section('title',trans('admin.Departments_Review'))
@section('content')
    @push('js')

        <script>
            $('.datepicker').datepicker({
                format: 'yyyy-mm-dd',
                rtl: true,
                language: '{{session('lang')}}',
                inline:true,
                minDate: 0,
                autoclose:true,
                minDateTime: dateToday

            });



        </script>
        <script>
            $(function () {
                'use strict';

                $('.type,.startdate,.enddate').on('change',function () {
                    var type = $('.type option:selected').val();

                    var startdate = $('.startdate').val();
                    var enddate = $('.enddate').val();


                    $("#loadingmessage").css("display","block");
                    $(".column-form").css("display","none");

                    if (this){

                        $.ajax({
                            url: "{{route('reviewdeCcpartment')}}",
                            type:'get',
                            dataType:'html',
                            data:{type : type,startdate: startdate,enddate: enddate},
                            success: function (data) {
                                $("#loadingmessage").css("display","none");
                                if(data != null)
                                {
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
                                }else {
                                    data = 'not'
                                    $('.column-form').css("display","block").html(data);
                                }


                            }
                        });
                    }else{
                        $('.column-form').html('');
                    }
                });


            });
        </script>
    @endpush
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{trans('admin.Departments_Review')}}</h3>
        </div>
        @include('admin.layouts.message')
        <div class="box-body">

            <div class="form-group row">
                <div class="col-md-4">
                    {{ Form::label('type', trans('admin.TypeOfConstraintOrBond'), ['class' => 'control-label']) }}
                    {{ Form::select('type', $limitationReceipts,null, array_merge(['class' => 'form-control type','placeholder'=>trans('admin.select')])) }}
                </div>
                <div class="col-md-4">
                    {{ Form::label('startdate',trans('admin.date') , ['class' => 'control-label']) }}
                    {{ Form::text('startdate',date("Y-m-1", strtotime('1-1-'.\Carbon\Carbon::today()->format('Y')) ), array_merge(['class' => 'form-control datepicker startdate','id' => 'history_date_project','placeholder'=>trans('admin.date')])) }}
                    @if ($errors->has('date'))
                        <div class="alert alert-danger" style="margin-top: 10px">{{ $errors->first('date') }}</div>
                    @endif
                </div>
                <div class="col-md-4">
                    <?php $current_date_time = new DateTime("now");
                    $user_current_date = $current_date_time->format("Y-m-d");?>
                    {{ Form::label('enddate',trans('admin.date') , ['class' => 'control-label']) }}
                    {{ Form::text('enddate', $user_current_date, array_merge(['class' => 'form-control datepicker enddate','placeholder'=>trans('admin.higri_date')])) }}
                    @if ($errors->has('enddate'))
                        <div class="alert alert-danger" style="margin-top: 10px">{{ $errors->first('date_hijri') }}</div>
                    @endif
                </div>
            </div>
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





@endsection
