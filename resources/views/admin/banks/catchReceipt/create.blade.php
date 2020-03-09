@extends('admin.index')
@section('title',trans('admin.create_catch_receipt'))
@section('content')
    @push('js')
        <script>
            $(function () {
                'use strict'

                // var schedule = $('.schedules').val();
                $('.branches,.receipts,.date').on('change',function () {
                    var date = $('.date').val();
                    var branches = $('.branches option:selected').val();
                    var receipts = $('.receipts option:selected').val();
                    if (this){
                        $.ajax({
                            url: '{{aurl('banks/Receipt/show')}}',
                            type:'get',
                            dataType:'html',
                            data:{branches : branches,receipts: receipts,date: date},
                            success: function (data) {
                                $('.column-receipts').html(data);
                                $('.date').datepicker({
                                    format: 'yyyy-mm-dd',
                                    rtl: true,
                                    language: '{{session('lang')}}',
                                    autoclose:true,
                                    todayBtn:true,
                                    clearBtn:true,
                                });
                            }
                        });
                    }else{
                        $('.column-receipts').html('');
                    }
                });


            });
        </script>

    @endpush
    @push('js')
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
                $('#e2').select2({
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
            @if(session('lang') == 'ar')
                .datepicker{
                direction: rtl
            }
            @endif

        </style>

    @endpush
    <div class="box">
        @include('admin.layouts.message')
        <div class="box-header">
            <h3 class="box-title">{{$title}}</h3>
        </div>
        <div class="box-body">
            {!! Form::open(['method'=>'POST','route' => 'receipt.store']) !!}
            {{--<div class="hidden">--}}

            {{ Form::hidden('invoice', generateBarcodeNumber(),['class'=>'invoice']) }}
            {{--</div>--}}
                <div class="form-group row">
                    <div class="col-md-4">
                        {{ Form::label('branche_id', trans('admin.Branches'), ['class' => 'control-label']) }}
                        {{ Form::select('branche_id', $branches,old('branche_id'), array_merge(['class' => 'form-control branches','placeholder'=>trans('admin.select'),'required'=>'required'])) }}
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {{ Form::label('date', trans('admin.date'), ['class' => 'control-label']) }}
                            {{ Form::text('date',\Carbon\Carbon::today()->format('Y-m-d'), array_merge(['class' => 'form-control date','required'=>'required','disabled'])) }}
                            {{ Form::hidden('date',\Carbon\Carbon::today()->format('Y-m-d')) }}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {{ Form::label('receipts', trans('admin.receipts'), ['class' => 'control-label']) }}
                            {{ Form::select('receipts',$limitationReceipts,null, array_merge(['class' => 'form-control receipts','placeholder'=> trans('admin.select') ,'required'=>'required'])) }}
                        </div>
                    </div>
                </div>
                <div class="column-receipts">

                </div>
            <br>
            {{Form::submit(trans('admin.create'),['class'=>'btn btn-primary primaryButton','disabled'])}}
            {!! Form::close() !!}

        </div>
    </div>








@endsection