<style>
    @if(session('lang') == 'ar')
        .datepicker{
            direction: rtl;
        }
    @endif
</style>

<script>
    $(function () {
        'use strict'

        $( ".datepicker" ).datepicker({ dateFormat: "y-m-d" });
        $(".from , .to").on("change",function(){
            var from = $('.from').val();
            var to = $('.to').val();
            var branche = '{{{$branche->id}}}';
            $("#loadingmessage-2").css("display","block");
            $(".column-driver-date").css("display","none");
            if (this){
                $.ajax({
                    url: '{{aurl('reportbranche/create')}}',
                    type:'get',
                    dataType:'html',
                    data:{from : from,to: to,branche: branche},
                    success: function (data) {
                        $("#loadingmessage-2").css("display","none");
                        $('.column-driver-date').css("display","block").html(data);

                    }
                });
            }else{
                $('.column-date').html('');
            }
        });


    });
</script>



<div class="row">
    <div class="col-md-3">
        <strong>{{trans('admin.branche')}}</strong>
        : {{session_lang($branche->name_en,$branche->name_ar)}}
    </div>
    <div class="col-md-3">
        <strong>{{trans('admin.buses_count')}}</strong>
        : <div class="badge bg-green">{{count($branche->buses)}}</div>
    </div>
    <div class="col-md-3">
        <strong>{{trans('admin.driver_count')}}</strong>
        : <div class="badge bg-green">{{count($branche->drivers)}}</div>
    </div>
    <div class="col-md-3">
        <strong>{{trans('admin.subscriber_count')}}</strong>
        : <div class="badge bg-green">{{count($branche->subscribers)}}</div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-6">
        {{ Form::label('from', trans('admin.From'), ['class' => 'control-label']) }}
        {{ Form::text('from',old('from'), array_merge(['class' => 'form-control datepicker from','placeholder'=>trans('admin.select_date')])) }}
    </div>
    <div class="col-md-6">
        {{ Form::label('to', trans('admin.To'), ['class' => 'control-label']) }}
        {{ Form::text('to',old('to'), array_merge(['class' => 'form-control datepicker to','placeholder'=>trans('admin.select_date')])) }}
    </div>
</div>
{{--loader spinner--}}
<div id='loadingmessage-2' style='display:none; margin-top: 20px' class="text-center">
    <img src="{{ url('/') }}/images/ajax-loader.gif"/>
</div>
<div class="column-date">

</div>
{{--<div class="form-group">--}}
{{--{{ Form::label('transport', 'transport', ['class' => 'control-label']) }}--}}
{{--{{ Form::select('transport_id', $transports,old('transport_id'), array_merge(['class' => 'form-control transport','placeholder'=>'select ...'])) }}--}}
{{--</div>--}}
