@extends('admin.index')
@section('title',trans('admin.motion_detection_center_cost'))
@section('content')
    <?php $to_glcc_select = null;?>
    @push('js')
        <script>
            $(document).ready(function() {

                $(".e2").select2({
                    placeholder: "{{trans('admin.select')}}",
                    // allowClear: true,
                    dir: '{{direction()}}'
                });
                $(".e3").select2({
                    placeholder: "{{trans('admin.select')}}",
                    // allowClear: true,
                    dir: '{{direction()}}'
                });
                $('.from_glcc').change(function() {
                    var x =  $('.to_glcc').val($(this).val());
                    var x = x[0].value;
                    var y =  $('.from_glcc option:selected').text();
                    $('.select2-selection__rendered').text(y);
                    // console.log(z)
                });
                {{--$('.from_glcc').change(function () {--}}
                {{--    var x = $('.from_glcc option:selected').val();--}}
                {{--    console.log(x);--}}
                {{--    var z = '{{$to_glcc_select}}'--}}
                {{--    console.log(z)--}}
                {{--    // $to_glcc_select--}}
                {{--    // var y =  $('.to_glcc option:selected').text();--}}
                {{--    // y = x--}}
                {{--    // console.log(y);--}}
                {{--    // console.log(y = x);--}}
                {{--})--}}

                // $('.from_glcc').on("change", function () {
                //     console.log($('input[name="from_glcc"]').val());
                //     $(".to_glcc").val();
                // }

            });
        </script>
    @endpush
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
                $('.from_glcc ,.to_glcc').on('change',function () {
                    var from_glcc = $('.from_glcc').val();
                    var to_glcc = $('.to_glcc').val();

                    $("#loadingmessage").css("display","block");
                    $(".column-data").css("display","none");
                    console.log(from_glcc,to_glcc);
                    if (this){
                        $.ajax({
                            url: '{{aurl('cc/report/motioncc/show')}}',
                            type:'get',
                            dataType:'html',
                            data:{from_glcc : from_glcc,to_glcc : to_glcc},
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
            <h3 class="box-title">{{trans('admin.motion_detection_center_cost')}}</h3>
        </div>
        <div class="box-body">
            {{--            {{ Form::label('glcc', trans('admin.cc'), ['class' => 'control-label']) }}--}}
            {{--            {{ Form::select('glcc', $glcc,null, array_merge(['class' => 'form-control glcc','placeholder'=>trans('admin.choose')])) }}--}}
            <div class="col-md-6">
                {{ Form::label('glcc',trans('admin.from_cc'), ['class' => 'control-label']) }}
                {{ Form::select('from_glcc',[0,1,2],null, array_merge(['class' => 'form-control e2 from_glcc','placeholder'=> trans('admin.select') ])) }}
            </div>
            <div class="col-md-6">
                {{ Form::label('glcc',trans('admin.to_cc'), ['class' => 'control-label']) }}
                {{ Form::select('to_glcc',[0,1,2],null, array_merge(['class' => 'form-control e3 to_glcc','placeholder'=> trans('admin.select') ])) }}
            </div>
        </div>


        <div id='loadingmessage' style='display:none; margin-top: 20px' class="text-center">
            <img src="{{ url('/') }}/images/ajax-loader.gif"/>
        </div>
        <br>
        <div class="column-data">


        </div>
        <br>
        <a href="javascript:history.back()" class="btn btn-danger">الرجوع</a>

    </div>


    {{--<button class="btn btn-default" onclick="printPageArea()" id="primaryButton"><i class="fa fa-print"></i> {{trans('admin.print')}} </button>--}}



@endsection
