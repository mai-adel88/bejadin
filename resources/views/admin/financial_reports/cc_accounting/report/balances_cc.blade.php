@extends('admin.index')
@section('title',trans('admin.disclosure_of_balances_of_accounts_of_cost_centers'))
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

                // var schedule = $('.schedules').val();
                $('.kind,.reporttype,.level').on('change',function () {
                    var reporttype = $('.reporttype').val();
                    var level = $('.level').val();
                    var kind = $('.kind').val();
                    $("#loadingmessage").css("display","block");
                    $(".column-data").css("display","none");

                    if (this){
                        $.ajax({
                            url: '{{aurl('cc/report/checkReports/show')}}',
                            type:'get',
                            dataType:'html',
                            data:{reporttype:reporttype,level:level,kind:kind},
                            success: function (data) {
                                $("#loadingmessage").css("display","none");
                                $('.column-data').css("display","block").html(data);

                            }
                        });
                    }else{
                        $('.column-data').html('');
                    }
                });


            });
        </script>


    @endpush
    @push('js')
        <script>
            $(document).ready(function() {

                $(".glcc").select2({
                    placeholder: "{{trans('admin.select')}}",
                    allowClear: true,
                    dir: '{{direction()}}'
                });
            });
        </script>
        <script>
            $("#seeAnotherField,.operations").change(function() {
                if ($("#seeAnotherField").val() == 1 ) {
                    $('#otherField').attr('disabled', 'disabled');
                    // $('#otherField').attr('data-error', 'This field is required.');
                }else
                {
                    $('#otherField').removeAttr("disabled");

                }

            });
        </script>
    @endpush
    <div class="box">
        @include('admin.layouts.message')
        @include('admin.layouts.error')
        <div class="box-header">
            <h3 class="box-title">{{trans('admin.disclosure_of_balances_of_accounts_of_cost_centers')}}</h3>
        </div>
        <div class="box-body row">
            <div class="col-md-3">
                {{ Form::label('branches', 'الفرع', ['class' => 'control-label']) }}
                {{ Form::select('branches', [0,1],1, array_merge(['class' => 'form-control branches','placeholder'=>trans('admin.select')])) }}
            </div>
            <div class="col-md-3">
                {{ Form::label('reporttype',trans('admin.report_type'), ['class' => 'control-label']) }}
                {{ Form::select('reporttype',\App\Enums\dataLinks\CCreporttype::toSelectArray(),null, array_merge(['class' => 'form-control e3 reporttype','placeholder'=> trans('admin.select') , 'id' => 'seeAnotherField' ])) }}
            </div>
            <div class="col-md-3">
                {{ Form::label('kind',trans('admin.type'), ['class' => 'control-label']) }}
                {{ Form::select('kind',\App\Enums\dataLinks\CCacountType::toSelectArray(),null, array_merge(['class' => 'form-control kind','placeholder'=> trans('admin.select') ])) }}
            </div>
            <div class="col-md-3">
                {{ Form::label('levels', trans('admin.level_number'), ['class' => 'control-label']) }}
                {{ Form::select('levels', [0,1,2,3,4,5,6,7],null, array_merge(['class' => 'form-control level','placeholder'=>trans('admin.select'),'id' => 'otherField'])) }}
            </div>


        </div>

        <div id='loadingmessage' style='display:none; margin-top: 20px' class="text-center">
            <img src="{{ url('/') }}/images/ajax-loader.gif"/>
        </div>
        <br>
        <div class="column-data">


        </div>
        <br><br>
        <a href="javascript:history.back()" class="btn btn-danger">الرجوع</a>

    </div>



@endsection
