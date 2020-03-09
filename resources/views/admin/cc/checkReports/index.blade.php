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
                $('.level').on('change',function () {
                    var level = $('.level').val();
                    $("#loadingmessage").css("display","block");
                    $(".column-data").css("display","none");
                    console.log(level);
                    if (this){
                        $.ajax({
                            url: '{{aurl('cc/report/checkReports/show')}}',
                            type:'get',
                            dataType:'html',
                            data:{level : level},
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
    @endpush
    <div class="box">
        @include('admin.layouts.message')
        @include('admin.layouts.error')
        <div class="box-header">
            <h3 class="box-title">{{$title}}</h3>
        </div>
        <div class="box-body">
            {{ Form::label('levels', trans('admin.level_number'), ['class' => 'control-label']) }}
            {{ Form::select('levels', $levels,null, array_merge(['class' => 'form-control level','placeholder'=>trans('admin.select')])) }}
        </div>
        <div id='loadingmessage' style='display:none; margin-top: 20px' class="text-center">
            <img src="{{ url('/') }}/images/ajax-loader.gif"/>
        </div>
        <br>
        <div class="column-data">


        </div>
        <br><br>
    </div>


    <button class="btn btn-default" onclick="printPageArea()" id="primaryButton"><i class="fa fa-print"></i> {{trans('admin.print')}} </button>



@endsection