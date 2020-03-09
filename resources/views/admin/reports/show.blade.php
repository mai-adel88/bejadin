<style>
    @if(session('lang') == 'ar')
        .datepicker{
            direction: rtl !important;
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
            var subscriber = '{{{$subscriber->id}}}';
            $("#loadingmessage-2").css("display","block");
            $(".column-driver-date").css("display","none");
            if (this){
                $.ajax({
                    url: '{{aurl('reports/create')}}',
                    type:'get',
                    dataType:'html',
                    data:{from : from,to: to,subscriber: subscriber},
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
    <div class="col-md-4">
        <strong>{{trans('admin.full_name')}}</strong>
        : {{session_lang($subscriber->name_en,$subscriber->name_ar)}}
    </div>
    @if($subscriber->type == 3)
    <div class="col-md-4">
        <strong>{{trans('admin.image')}}</strong>
        : <img src="{{asset('storage/'.$subscriber->image)}}" alt="" class="img-reponsive" style="margin: 0 auto;width: 100px;display: block">
    </div>
    @else
    <div class="col-md-4">
        <strong>{{trans('admin.image')}}</strong>
        @if($subscriber->image != null)
        : <img src="{{asset('storage/'.$subscriber->image)}}" alt="" class="img-reponsive" style="margin: 0 auto;width: 100px;display: block">
            @else
          <img src="{{asset('/')}}adminlte/previewImage.png" class="img-responsive" alt="" style="margin: 0 auto;width: 100px;display: block">
        @endif
    </div>
        @endif
    <div class="col-md-4">
        <strong>{{trans('admin.price')}}</strong>
        : {{$subscriber->price}}
    </div>
</div>
<br>
@if($subscriber->type == 3)
<div class="row">
    <div class="col-md-3">
        <strong>{{trans('admin.addriss')}}</strong>
        : {{$subscriber->addriss}}
    </div>
    <div class="col-md-3">
        <strong>{{trans('admin.Cr_number')}}</strong>
        : <div class="badge">{{$subscriber->cr_num}}</div>
    </div>
    <div class="col-md-3">
        <strong>{{trans('admin.Tax_Number')}}</strong>
        : <div class="badge">{{$subscriber->tax_num}}</div>
    </div>
    <div class="col-md-3">
        <strong>{{trans('admin.phone')}}</strong>
        : <div class="badge">{{$subscriber->phone_1}}</div>
    </div>
</div>
@else
    <div class="row">
        <div class="col-md-6">
            <strong>{{trans('admin.addriss')}}</strong>
            : {{$subscriber->addriss}}
        </div>
        <div class="col-md-6">
            <strong>{{trans('admin.phone')}}</strong>
            : <div class="badge">{{$subscriber->phone_1}}</div>
        </div>
    </div>
    @endif
    <br>
<div class="row">
    <div class="col-md-3">
        <strong>{{trans('admin.depart')}}</strong>
        : <div class="badge">{{session_lang($subscriber->departs->state_name_en,$subscriber->departs->state_name_ar)}}</div>
    </div>
    <div class="col-md-3">
        <strong>{{trans('admin.desname')}}</strong>
        : <div class="badge">{{session_lang($subscriber->desnames->state_name_en,$subscriber->desnames->state_name_ar)}}</div>
    </div>
    <div class="col-md-3">
        <strong>{{trans('admin.start_subscription')}}</strong>
        : <div class="badge">{{date('Y-m-d', strtotime($subscriber->start))}}</div>
    </div>
    <div class="col-md-3">
        <strong>{{trans('admin.end_subscription')}}</strong>
        : <div class="badge">{{date('Y-m-d', strtotime($subscriber->end))}}</div>
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
