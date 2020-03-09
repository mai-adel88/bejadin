<script>
    $(function () {
        'use strict';

        // var schedule = $('.schedules').val();
        $('.from,.to,.fromtree,.totree').on('change',function () {
            var from = $('.from').val();
            var to = $('.to').val();
            var fromtree = $('.fromtree').val();
            var totree = $('.totree').val();
            $("#loadingmessage-2").css("display","block");
            $(".column-account-date").css("display","none");
            if (this){
                $.ajax({
                    url: '{{aurl('cc/report/checkReports/details')}}',
                    type:'get',
                    dataType:'html',
                    data:{from : from,to: to,fromtree: fromtree,totree: totree},
                    success: function (data) {
                        $("#loadingmessage-2").css("display","none");
                        $('.column-account-date').css("display","block").html(data);

                    }
                });
            }else{
                $('.column-account-date').html('');
            }
        });


    });


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
        $('.e3').select2({
            placeholder: "{{trans('admin.select')}}",
            dir: '{{direction()}}'
        });
    });

</script>

<div class="form-group row" style="padding: 0 10px">
    <div class="col-md-3">
        {{ Form::label('form',trans('admin.from'), ['class' => 'control-label']) }}
        {{ Form::select('fromtree',$glcc,null, array_merge(['class' => 'form-control e3 fromtree','placeholder'=> trans('admin.select') ])) }}
    </div>
    <div class="col-md-3">
        {{ Form::label('to', trans('admin.to'), ['class' => 'control-label']) }}
        {{ Form::select('totree',$glcc,null, array_merge(['class' => 'form-control e3 totree','placeholder'=> trans('admin.select') ])) }}
    </div>
    <div class="col-md-3">
        {{ Form::label('from', trans('admin.From'), ['class' => 'control-label']) }}
        {{ Form::text('from',\Carbon\Carbon::today()->format('Y-'.\Carbon\Carbon::now()->diffInYears(\Carbon\Carbon::now()->copy()->addYear()).'-'.\Carbon\Carbon::now()->diffInYears(\Carbon\Carbon::now()->copy()->addYear())), array_merge(['class' => 'form-control date from','required'=>'required'])) }}
    </div>
    <div class="col-md-3">
        {{ Form::label('to', trans('admin.To'), ['class' => 'control-label']) }}
        {{ Form::text('to',\Carbon\Carbon::today()->format('Y-m-d'), array_merge(['class' => 'form-control date to','required'=>'required'])) }}
    </div>
</div>
<div id='loadingmessage-2' style='display:none; margin-top: 20px' class="text-center">
    <img src="{{ url('/') }}/images/ajax-loader.gif"/>
</div>
<div class="column-account-date">

</div>
<br>
