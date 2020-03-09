@extends('admin.index')
@section('title',trans('admin.Departments_reports'))
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
                $('.search').on('change',function () {
                    var search = $('.search').val();
                    $("#loadingmessage").css("display","block");
                    $(".column-data").css("display","none");
                    console.log(search);
                    if (this){
                        $.ajax({
                            url: '{{aurl('departments/show')}}',
                            type:'get',
                            dataType:'html',
                            data:{search : search},
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
    <div class="box">
        @include('admin.layouts.message')
        @include('admin.layouts.error')
        <div class="box-header">
            <h3 class="box-title">{{$title}}</h3>
        </div>
        <div class="box-body">
                {{ Form::label('search', trans('admin.search_kind'), ['class' => 'control-label']) }}
                {{ Form::select('search', \App\Enums\dataLinks\DepartmentReportType::toSelectArray(),null, array_merge(['class' => 'form-control search','placeholder'=>trans('admin.select')])) }}
        </div>
        <div id='loadingmessage' style='display:none; margin-top: 20px' class="text-center">
            <img src="{{ url('/') }}/images/ajax-loader.gif"/>
        </div>
        <br>
        <div class="column-data">


        </div>
        <br><br>
    </div>


    {{--<button class="btn btn-default" onclick="printPageArea()" id="primaryButton"><i class="fa fa-print"></i> {{trans('admin.print')}} </button>--}}



@endsection