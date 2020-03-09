@extends('admin.index')
@section('title',trans('admin.For_Buses'))
@section('content')
    @can('reports')
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

                // var schedule = $('.schedules').val();
                $('.schedules,.buses,.date').on('change',function () {
                    var date = $('.date').val();
                    var schedules = $('.schedules option:selected').val();
                    var bus = $('.buses option:selected').val();
                    $("#loadingmessage").css("display","block");
                    $(".column-bus").css("display","none");
                    console.log(schedules);
                    if (this){
                        $.ajax({
                            url: '{{aurl('reportsbus/show')}}',
                            type:'get',
                            dataType:'html',
                            data:{bus : bus,schedules: schedules,date: date},
                            success: function (data) {
                                $("#loadingmessage").css("display","none");
                                $('.column-bus').css("display","block").html(data);

                            }
                        });
                    }else{
                        $('.column-bus').html('');
                    }
                });


            });
        </script>

    @endpush
    @push('js')

        <script>
            $(document).ready(function() {

                $(".buses").select2({
                    placeholder: "{{trans('admin.select')}}",
                    allowClear: true,
                    dir: '{{direction()}}'
                });
                $(".schedules").select2({
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
             @if(session('lang') == 'ar')
                    .datepicker{
                        direction: rtl;
                 text-align: right;
                    }
            @endif
        </style>

    @endpush

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{trans('admin.For_Buses')}}</h3>
        </div>
    @include('admin.layouts.message')
    <!-- /.box-header -->
        <div class="box-body">

            <div class="form-group">
                {{ Form::label('buses', trans('admin.Buses'), ['class' => 'control-label']) }}
                <select name="buses" class="buses form-control" placeholder="{{trans('admin.select')}}">
                    <option></option>
                    @foreach ($buses as $bus)
                        <option value="{{$bus->id}}">{{$bus->busnumber}}</option>
                    @endforeach
                </select>
                {{--loader spinner--}}
                <div id='loadingmessage' style='display:none; margin-top: 20px' class="text-center">
                    <img src="{{ url('/') }}/images/ajax-loader.gif"/>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-6">
                    {{ Form::label('date', trans('admin.date'), ['class' => 'control-label']) }}
                    {{ Form::text('date',old('date'), array_merge(['class' => 'form-control datepicker date','placeholder'=>trans('admin.select_date')])) }}
                </div>
                <div class="col-md-6">
                    {{ Form::label('schedules', trans('admin.Schedules'), ['class' => 'control-label']) }}
                    <select name="schedules" class="schedules form-control" placeholder="{{trans('admin.select')}}">
                        <option></option>
                        @foreach ($schedules as $schedule)
                            <option value="{{$schedule->id}}">{{date('h:i A', strtotime($schedule->schedule_time))}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            </div>
            <br>
        <div id="invoice">
            {{--loader spinner--}}
            <div id='loadingmessage' style='display:none; margin-top: 20px' class="text-center">
                <img src="{{ url('/') }}/images/ajax-loader.gif"/>
            </div>
            <div class="column-bus">

            </div>
        </div>
            <br>


    </div>
        <!-- /.box-body -->

    <button class="btn btn-default" onclick="printPageArea()" id="primaryButton"><i class="fa fa-print"></i> {{trans('admin.print')}} </button>

    @else
        <div class="alert alert-danger">{{trans('admin.you_cannt_see_invoice_because_you_dont_have_role_to_access')}}</div>

        @endcan
@endsection