@extends('admin.index')
@section('title',trans('admin.Reports_Branches'))
@section('content')
@hasanyrole('writer|admin')
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


            $(document).on('change','.branche',function () {
                var branche = $('.branche option:selected').val();
                var dateToday = new Date();
                $("#loadingmessage").css("display","block");
                $(".column-form").css("display","none");
                console.log(branche);
                if (branche > 0){
                    $.ajax({
                        url: '{{aurl('reportbranche/show')}}',
                        type:'get',
                        dataType:'html',
                        data:{branche : branche},
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
        <h3 class="box-title">{{trans('admin.Reports_Branches')}}</h3>
    </div>
@include('admin.layouts.message')
<!-- /.box-header -->
<div class="box-body">

    <div class="form-group">
        {{ Form::label('branches', trans('admin.Branches'), ['class' => 'control-label']) }}
        <select name="branche_id" class="branche form-control" id='e2_2' placeholder="{{trans('admin.select')}}">
            <option></option>
            @foreach ($branches as $branche)
                <option value="{{$branche->id}}">{{session_lang($branche->name_en,$branche->name_ar)}}</option>
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









@else
    <div class="alert alert-danger">{{trans('admin.you_cannt_see_invoice_because_you_dont_have_role_to_access')}}</div>

@endhasanyrole






@endsection