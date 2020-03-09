@extends('admin.index')
@section('title',trans('admin.For_Subscribers'))
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

            $(document).on('change','.subscriber',function () {
                var sub = $('.subscriber option:selected').val();
                var dateToday = new Date();
                $("#loadingmessage").css("display","block");
                $(".column-form").css("display","none");
                console.log(sub);
                if (sub > 0){
                    $.ajax({
                        url: '{{aurl('reports/show')}}',
                        type:'get',
                        dataType:'html',
                        data:{sub : sub},
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
        <h3 class="box-title">{{trans('admin.For_Subscribers')}}</h3>
    </div>
@include('admin.layouts.message')
<!-- /.box-header -->
<div class="box-body">

    <div class="form-group">
        {{ Form::label('subscriptions', trans('admin.subscription'), ['class' => 'control-label']) }}
        <select name="subscriper_id" class="subscriber form-control" id='e2_2' placeholder="{{trans('admin.select')}}">
            <option></option>
            @foreach ($subscriptions as $subscription)
                <option value="{{$subscription->id}}">{{session_lang($subscription->name_en,$subscription->name_ar)}} ({{session_lang($subscription->branches->name_en,$subscription->branches->name_ar)}}) ({{\App\Enums\TypeType::getDescription($subscription->type)}}) {{trans('admin.Start_In')}}: {{date('Y-m-d', strtotime($subscription->start))}} {{trans('admin.End_In')}}: {{date('Y-m-d', strtotime($subscription->end))}}</option>
            @endforeach
        </select>
        {{--loader spinner--}}
        <div id='loadingmessage' style='display:none; margin-top: 20px' class="text-center">
            <img src="{{ url('/') }}/images/ajax-loader.gif"/>
        </div>
    </div>
    <br>
    <div id="invoice">
    <div class="column-form">

    </div>
    </div>
    <br>


</div>
</div>
    <button class="btn btn-default" onclick="printPageArea()" id="primaryButton"><i class="fa fa-print"></i> {{trans('admin.print')}} </button>
<!-- /.box-body -->
















@endsection