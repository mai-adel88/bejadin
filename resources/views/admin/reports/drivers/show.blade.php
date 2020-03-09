<style>
    @if(session('lang') == 'ar')
        .datepicker{
        direction: rtl;
    }
    @endif
</style>
<script>
    $(function () {
        'use strict';

        $( ".datepicker" ).datepicker({ dateFormat: "y-m-d" });
        $(".from , .to").on("change",function(){
            var from = $('.from').val();
            var to = $('.to').val();
            var driver = '{{{$driver->id}}}';
            $("#loadingmessage-2").css("display","block");
            $(".column-driver-date").css("display","none");
            if (this){
                $.ajax({
                    url: '{{aurl('reportdriver/create')}}',
                    type:'get',
                    dataType:'html',
                    data:{from : from,to: to,driver: driver},
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
        : {{session_lang($driver->name_en,$driver->name_ar)}}
    </div>


    <div class="col-md-4">
        <strong>{{trans('admin.image')}}</strong>
        @if($driver->image != null)
        : <img src="{{asset('storage/'.$driver->image)}}" alt="" class="img-reponsive" style="margin: 0 auto;width: 100px;display: block">
            @else
          <img src="{{asset('/')}}adminlte/previewImage.png" class="img-responsive" alt="" style="margin: 0 auto;width: 100px;display: block">
        @endif
    </div>
    <div class="col-md-4">
        <strong>{{trans('admin.salary')}}</strong>
        : {{$driver->salary}}
    </div>
</div>
<br>



    <div class="row">
        <div class="col-md-6">
            <strong>{{trans('admin.addriss')}}</strong>
            : {{$driver->addriss}}
        </div>
        <div class="col-md-6">
            <strong>{{trans('admin.phone')}}</strong>
            : {{$driver->phone}}
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-6">
            <strong>{{trans('admin.state_date')}}</strong>
            : {{$driver->state_date}}
        </div>
        <div class="col-md-6">
            <strong>{{trans('admin.work_date')}}</strong>
            : {{$driver->work_date}}
        </div>
    </div>
    <br>
<div class="row">
    <div class="col-md-4">
        <strong>{{trans('admin.license_num')}}</strong>
        : <div class="badge">{{$driver->license_num}}</div>
    </div>
    <div class="col-md-4">
        <strong>{{trans('admin.date_issuance')}}</strong>
        : <div class="badge">{{date('Y-m-d', strtotime($driver->date_issuance))}}</div>
    </div>
    <div class="col-md-4">
        <strong>{{trans('admin.expired_date')}}</strong>
        : <div class="badge">{{date('Y-m-d', strtotime($driver->expired_date))}}</div>
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
<div class="column-driver-date">

</div>
{{--<div class="form-group">--}}
{{--{{ Form::label('transport', 'transport', ['class' => 'control-label']) }}--}}
{{--{{ Form::select('transport_id', $transports,old('transport_id'), array_merge(['class' => 'form-control transport','placeholder'=>'select ...'])) }}--}}
{{--</div>--}}
