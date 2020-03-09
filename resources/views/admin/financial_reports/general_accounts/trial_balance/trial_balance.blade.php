@extends('admin.index')
@section('title', trans('admin.trial_balance'))
@section('content')
    @push('css')
        <style>
            .select2-container--default .select2-selection--multiple .select2-selection__choice{
                background-color: #333;
            }

            .toggleClick{
                color: red;
            }

        </style>
        {{--    Date Hijri--}}
        <link rel="stylesheet" href="{{url('/')}}/public/adminlte/dateHijri/dist/css/bootstrap-datetimepicker.min.css">

    @endpush
    @push('js')
        <script src="{{url('/')}}/public/adminlte/dateHijri/dist/js/bootstrap-hijri-datepicker.min.js"></script>

        <script>
            $(function () {
                'use strict'



        </script>

        <script>

            $(function () {
                'use strict';

                $('#MainCompany').on('change',function () {
                    var MainCompany = $( "#MainCompany option:selected" ).val();
                    if (this){
                        $("#loadingmessage").css("display","block");
                        $(".show_row").css("display","none");
                        $.ajax({
                            url: '{{route('trialbalance.show')}}',
                            type:'get',
                            dataType:'html',
                            data:{MainCompany:MainCompany},
                            success: function (data) {
                                $("#loadingmessage").css("display","none");
                                $('.show_row').css("display","block").html(data);
                                var minDate = '{{\Carbon\Carbon::today()->format('Y-m-d')}}';
                                $('.datepicker').datepicker({
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
                        $('.show_row').html('');
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
                    {{--            placeholder: "{{trans('admin.select')}}",--}}
                    dir: '{{direction()}}'
                });
            });
        </script>

        <script>

            $('#select_check :checkbox[id=but_level_check]').change(function(){
                if($(this).is(':checked')){
                    $('#level_check').attr('disabled', 'disabled');
                }
                else{
                    $('#level_check').removeAttr('disabled');
                }
            });

            $(".hijri-date-input").hijriDatePicker({
                    hijri : false,
                    format: "YYYY-MM-DD",
                    hijriFormat: 'iYYYY-iMM-iDD',
                    showTodayButton:true,
            });
        </script>

    @endpush

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{trans('admin.trial_balance')}}</h3>
        </div>
        @include('admin.layouts.message')
        <div class="box-body">
            <div class="row">
                <div class="col-md-6 col-xs-12">
                    {{ Form::label('MainCompany','الشركه', ['class' => 'col-md-2 col-xs-4']) }}
                    {{ Form::select('MainCompany',$MainCompany,null, array_merge(['class' => 'col-md-10 col-xs-8 form-control  e2  MainCompany','placeholder'=> trans('admin.select')])) }}
                </div>

                <div class="checkonly col-md-6 col-xs-12" id="select_check">

                    <div class="col-md-6 col-xs-12">
                        <input  class="trialBalance_1"  type="checkbox" id="but_level_check" name="reviewBalance" value="1" checked>
                        <label for="reviewBalance">  ميزان المراجعة لاستاذ المساعد </label>
                    </div>
                </div>
            </div>
            <br>
            <div class="show_row col-md-6 col-xs-12">
                <div class="row">

                    <div class="col-md-12 col-xs-12">
                        {{ Form::label('level','المستوى', ['class' => 'col-md-2 control-label']) }}
                        {{ Form::select('level',[],null, array_merge(['class' => 'form-control col-xs-10', 'id'=>'level_check' ,'disabled' =>'disabled'])) }}
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-xs-9">
                        {{ Form::label('tree','من حساب', ['class' => 'col-xs-3 control-label']) }}
                        {{ Form::select('fromtree',[],null, array_merge(['class' => 'form-control fromtree col-xs-9 e2 ee', 'id'=>'fromtree'])) }}
                    </div>
                    <div class="col-xs-3">
                        {{ Form::text('number_fromtree',null, array_merge(['class' => 'form-control'])) }}
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-xs-9">
                        {{ Form::label('tree','الى حساب', ['class' => 'col-xs-3']) }}
                        {{ Form::select('totree',[],null, array_merge(['class' => 'form-control col-xs-9 e2 ee totree'])) }}
                    </div>
                    <div class="col-xs-3">
                        {{ Form::text('number_totree',null, array_merge(['class' => 'form-control'])) }}
                    </div>
                </div>

            </div>
            <div class="col-md-6 col-xs-12 well well-sm">
                <div class="col-xs-12">
                    <div class="col-xs-6">
                        {{ Form::label('From', trans('admin.From'), ['class' => 'col-md-2 col-xs-3']) }}
                        {{ Form::text('From',\Carbon\Carbon::today()->format('Y-'.\Carbon\Carbon::now()->diffInYears(\Carbon\Carbon::now()->copy()->addYear()).'-'.\Carbon\Carbon::now()->diffInYears(\Carbon\Carbon::now()->copy()->addYear())),
                                array_merge(['class' => 'col-md-10 col-xs-9 form-control hijri-date-input fromDate ','id'=>'fromDate','autocomplete'=>'off'])) }}
                    </div>
                    <div class="col-xs-6">
                        {{ Form::label('To', trans('admin.To'), ['class' => 'col-md-2 col-xs-3']) }}
                        {{ Form::text('To',\Carbon\Carbon::today()->format('Y-m-d'), array_merge(['class' => 'col-md-10 col-xs-9 form-control  hijri-date-input  toDate','id'=>'toDate'])) }}

                    </div>
                </div>
                <br>
                <br>
                <br>
                <div class="col-md-12 col-xs-12">
                    <div class="col-md-6 col-xs-6">
                        <div class="col-xs-12 custom-control custom-radio">
                            <input type="radio" class="total_department" id="total_department" name="department" checked value="1">
                            <label class="total_department" for="total_department">جميع الحسابات </label>
                        </div>
                        <br>
                        <br>
                        <br>
                        <div class="col-xs-12 custom-control custom-radio">
                            <input type="radio" class="total_department" id="balance_department" name="department" value="2">
                            <label for="balance_department">  حسابات بارصدة </label>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="col-xs-12 custom-control custom-radio">
                            <input type="radio" class="total_department" id="debt_department" name="department" value="3">
                            <label class="debt_department" for="debt_department">حسابات مدينه </label>
                        </div>
                        <br>
                        <br>
                        <br>
                        <div class="col-xs-12 custom-control custom-radio">
                            <input type="radio" class="total_department" id="credit_department" name="department" value="4">
                            <label for="credit_department">  حسابات دائنه </label>
                        </div>
                    </div>
                </div>

            </div>

        </div>
        <div class="print_div">

        </div>
    </div>


    <br>
    {{--loader spinner--}}
    <div id='loadingmessage_1' style='display:none; margin-top: 20px' class="text-center">
        <img src="{{ url('/') }}/public/images/ajax-loader.gif"/>
    </div>

    <br>



@endsection
