@extends('admin.index')
@section('title', trans('admin.trial_balance'))
@section('content')
    @push('js')

        <script>

            $("#seeAnotherField,.operations").change(function() {
                if ($("#seeAnotherField").val() == 0 && $('.operations').val()) {
                    $('#otherField').attr('disabled', 'disabled');
                    // $('#otherField').attr('data-error', 'This field is required.');
                }if  ($("#seeAnotherField").val() == 0 && $('.operations').val() == 4) {
                    $('#otherField').attr('disabled', 'disabled');
                    // $('#otherField').removeAttr('data-error');
                }if  ($("#seeAnotherField").val() == 1 && $('.operations').val() != 4) {
                    $('#otherField').attr('disabled', 'disabled');
                    // $('#otherField').removeAttr('data-error');
                }
                if  ($("#seeAnotherField").val() == 1 && $('.operations').val() == 4) {
                    $('#otherField').removeAttr('disabled');
                    // $('#otherField').removeAttr('data-error');
                }
            });


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

                $('.reporttype,.kind,.level,.operations').on('change',function () {
                    var reporttype = $('.reporttype option:selected').val();
                    var kind = $('.kind option:selected').val();
                    var level = $('.level option:selected').val();
                    var operations = $('.operations').val();

                    if (this){
                        $("#loadingmessage").css("display","block");
                        $(".column-form").css("display","none");
                        $.ajax({
                            url: '{{aurl('trialbalance/show')}}',
                            type:'get',
                            dataType:'html',
                            data:{reporttype : reporttype,kind: kind,level: level,operations: operations},
                            success: function (data) {
                                $("#loadingmessage").css("display","none");
                                $('.column-form').css("display","block").html(data);
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
                    {{ Form::label('operations',trans('admin.account_type'), ['class' => 'control-label']) }}
                    {{ Form::select('operations',\App\operation::whereIn('receipt',[1,2])->pluck('name_'.session('lang'),'id'),null, array_merge(['class' => 'form-control operations','placeholder'=> trans('admin.select') ])) }}
                </div>
                <div class="col-md-3">
                    {{ Form::label('reporttype',trans('admin.report_type'), ['class' => 'control-label']) }}
                    {{ Form::select('reporttype',\App\Enums\dataLinks\BalanceReviewType::toSelectArray(),null, array_merge(['class' => 'form-control e3 reporttype','placeholder'=> trans('admin.select') , 'id' => 'seeAnotherField' ])) }}
                </div>
                <div class="col-md-3">
                    {{ Form::label('kind',trans('admin.type'), ['class' => 'control-label']) }}
                    {{ Form::select('kind',\App\Enums\dataLinks\AccountTypeType::toSelectArray(),null, array_merge(['class' => 'form-control kind','placeholder'=> trans('admin.select') ])) }}
                </div>
                <div class="col-md-3" id="otherFieldDiv">
                    {{ Form::label('level',trans('admin.level'), ['class' => 'control-label']) }}
                    {{ Form::selectRange('level',1,7,null, array_merge(['class' => 'form-control level','placeholder'=> trans('admin.select') , 'id' => 'otherField'])) }}
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
