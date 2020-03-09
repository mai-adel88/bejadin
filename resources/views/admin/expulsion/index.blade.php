@extends('admin.index')
@section('title', trans('admin.expulsion_transaction'))
@section('content')
    @push('js')
        <script>
            $(function () {
                'use strict'
                $('.datepicker').datepicker({
                    format: 'yyyy-mm-dd',
                    rtl: true,
                    language: '{{session('lang')}}',
                    inline:true,
                    minDate: 0,
                    autoclose:true,
                    minDateTime: dateToday

                });
            })
        </script>
        <script>
            $(function () {
                'use strict';

                $('.from,.to').on('change',function () {
                    var from = $('.from').val();
                    var to = $('.to').val();
                    $("#loadingmessage").css("display","block");
                    $(".column-form").css("display","none");
                    if (this){
                        $.ajax({
                            url: '{{aurl('expulsion/create')}}',
                            type:'get',
                            dataType:'html',
                            data:{from : from,to: to},
                            success: function (data) {
                                $("#loadingmessage").css("display","none");
                                $('.column-form').css("display","block").html(data);

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
            <h3 class="box-title">{{trans('admin.expulsion_transaction')}}</h3>
        </div>
    @include('admin.layouts.message')
    <!-- /.box-header -->
        <div class="box-body">
            <div class="form-group row">
                <div class="col-md-6">
                    {{ Form::label(trans('admin.from'), null, ['class' => 'control-label']) }}
                    {{ Form::text('from', null, array_merge(['class' => 'form-control datepicker from','autocomplete'=>'off'])) }}
                </div>
                <div class="col-md-6">
                    {{ Form::label(trans('admin.to'), null, ['class' => 'control-label']) }}
                    {{ Form::text('to', null, array_merge(['class' => 'form-control datepicker to','autocomplete'=>'off'])) }}
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
        </div>
        <!-- /.box-body -->
    </div>








@endsection
