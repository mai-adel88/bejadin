<script>
    $(function () {
        'use strict'
        if ("{{$fromtree,$totree}}"){
            var fromtree = $('.fromtree').val();
            var totree = $('.totree').val();
            var to = $('.to').val();
            var from = $('.from').val();
            var level = '{{isset($level) ? $level : null}}';
            var kind = '{{$kind}}';
            $("#loadingmessage-2").css("display","block");
            $(".column-account-date").css("display","none");
            if (this) {
                $.ajax({
                    url: '{{aurl('trialbalance/details')}}',
                    type: 'get',
                    dataType: 'html',
                    data: {level: level, kind: kind, fromtree: fromtree, totree: totree, from: from, to: to},
                    success: function (data) {
                        $("#loadingmessage-2").css("display", "none");
                        $('.column-account-date').css("display", "block").html(data);

                    }
                });
            }
        } if($(".fromtree,.totree").change()){
            $(".fromtree,.totree").on("change",function(){
                var fromtree = $('.fromtree').val();
                var totree = $('.totree').val();
                var to = $('.to').val();
                var from = $('.from').val();
                var level = '{{isset($level) ? $level : null}}';
                var kind = '{{$kind}}';
                $("#loadingmessage-2").css("display","block");
                $(".column-account-date").css("display","none");
                if (this){
                    $.ajax({
                        url: '{{aurl('trialbalance/details')}}',
                        type:'get',
                        dataType:'html',
                        data:{level: level,kind: kind,fromtree: fromtree,totree: totree,from: from,to: to},
                        success: function (data) {
                            $("#loadingmessage-2").css("display","none");
                            $('.column-account-date').css("display","block").html(data);

                        }
                    });
                }else{
                    $('.column-account-date').html('');
                }
            });
        }
        if($(".from,.to").change()){
            $(".from,.to").on("change",function(){
                var fromtree = $('.fromtree').val();
                var totree = $('.totree').val();
                var to = $('.to').val();
                var from = $('.from').val();
                var level = '{{isset($level) ? $level : null}}';
                var kind = '{{$kind}}';
                $("#loadingmessage-2").css("display","block");
                $(".column-account-date").css("display","none");
                if (this){
                    $.ajax({
                        url: '{{aurl('trialbalance/details')}}',
                        type:'get',
                        dataType:'html',
                        data:{level: level,kind: kind,fromtree: fromtree,totree: totree,from: from,to: to},
                        success: function (data) {
                            $("#loadingmessage-2").css("display","none");
                            $('.column-account-date').css("display","block").html(data);

                        }
                    });
                }else{
                    $('.column-account-date').html('');
                }
            });
        }



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
<div class="form-group row">
    <div class="col-md-3">
        {{ Form::label('form',trans('admin.from'), ['class' => 'control-label']) }}
        {{ Form::select('fromtree',$departments,$fromtree, array_merge(['class' => 'form-control e2 fromtree','placeholder'=> trans('admin.select') ])) }}
    </div>
    <div class="col-md-3">
        {{ Form::label('to', trans('admin.to'), ['class' => 'control-label']) }}
        {{ Form::select('totree',$departments,$totree, array_merge(['class' => 'form-control e2 totree','placeholder'=> trans('admin.select') ])) }}
    </div>
    <div class="col-md-3">
        {{ Form::label('From', trans('admin.From'), ['class' => 'control-label']) }}
        {{ Form::text('From',\Carbon\Carbon::today()->format('Y-'.\Carbon\Carbon::now()->diffInYears(\Carbon\Carbon::now()->copy()->addYear()).'-'.\Carbon\Carbon::now()->diffInYears(\Carbon\Carbon::now()->copy()->addYear())), array_merge(['class' => 'form-control from datepicker','required'=>'required','autocomplete'=>'off'])) }}
    </div>
    <div class="col-md-3">
        {{ Form::label('To', trans('admin.To'), ['class' => 'control-label']) }}
        {{ Form::text('To',\Carbon\Carbon::today()->format('Y-m-d'), array_merge(['class' => 'form-control to datepicker','required'=>'required','autocomplete'=>'off'])) }}
    </div>
</div>
<div id='loadingmessage-2' style='display:none; margin-top: 20px' class="text-center">
    <img src="{{ url('/') }}/images/ajax-loader.gif"/>
</div>
<div class="column-account-date">

</div>
<br>
