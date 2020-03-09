@extends('admin.index')
@section('title','القيود اليومية للموردين')

@section('content')
@push('css')
<style>
    .bg-warning {
        background-color: #ffc107!important;

    }

</style>

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
@push('js')
    <script>
        $(function () {
            'use strict'

            $(".date_limition").on("change",function(){
                var MainCompany = $('.MainCompany').val();
                var type = $('.type').val();
                var date_limition = $('input[name="date_limition"]:checked').val();


                $("#loadingmessage-1").css("display","block");
                $(".show_row").css("display","none");
                if (this){
                    $.ajax({
                        url: '{{route('sup_daily_restriction.show')}}',
                        type:'get',
                        dataType:'html',
                        data:{MainCompany: MainCompany,type: type,date_limition: date_limition},
                        success: function (data) {
                            $("#loadingmessage-1").css("display","none");
                            $('.show_row').css("display","block").html(data);

                        }
                    });
                }else{
                    $('.    show_row').html('');
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
<div class="box">
    <div class="box-header">
        <h3 class="box-title">القيود اليومية للموردين</h3>
    </div>
    <div class="box-body">
        <div class="row">
                <div class="col-md-12">

                        <div class="col-md-4" style="display: flex; flex-direction: row">
                            {{ Form::label('maincompany','الشركات', ['class' => 'control-label','style'=>'margin:1%']) }}
                            {{ Form::select('MainCompany',$MainCompany,null, array_merge(['class' => 'form-control MainCompany','placeholder'=> trans('admin.select') ])) }}
                        </div>


                        <div class="col-md-4" style="display: flex; flex-direction: row;">
                            {{ Form::label('type',trans('admin.TypeOfConstraintOrBond'), ['class' => 'control-label','style'=>'margin:1%']) }}
                            {{ Form::select('type', $limitationReceipts,null, array_merge(['class' => 'form-control type','placeholder'=>trans('admin.select')])) }}


                        </div>
                        <div class="col-md-2">

                            <input type="radio" class="date_limition" id="TYPE_limition" name="date_limition" value="0">
                            <label for="TYPE_limition"> {{trans('admin.date')}} </label>

                        </div>
                        <div class="col-md-2">
                            <input type="radio" class="date_limition" id="TYPE_limition" name="date_limition" value="1">
                            <label for="TYPE_limition"> {{trans('admin.limitation')}} </label>
                        </div>
                </div>




        </div>









        <div class="show_row">

        </div>
       <div class="details_row">

        </div>



    </div>







</div>



@endsection
