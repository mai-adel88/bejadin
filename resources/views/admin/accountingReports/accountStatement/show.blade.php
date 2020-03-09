<script>
    $(function () {
        'use strict'

        $(".from,.to,.fromtree,.totree").on("change",function(){
            var from = $('.from').val();
            var to = $('.to').val();
            var fromtree = $('.fromtree').val();
            var totree = $('.totree').val();
            var operations = $('.operations option:selected').val();
            var branches = $('.branches option:selected').val();
            $("#loadingmessage-2").css("display","block");
            $(".column-account-date").css("display","none");
            if (this){
                $.ajax({
                    url: '{{aurl('accountStatement/details')}}',
                    type:'get',
                    dataType:'html',
                    data:{from: from,to: to,fromtree: fromtree,totree: totree,operations : operations,branches: branches},
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
{{ Form::label('date', trans('admin.account_statement').' '.session_lang($operation->name_en,$operation->name_ar), ['class' => 'control-label text-center']) }}
    <div class="form-group row">
        <div class="col-md-3">
            {{ Form::label('tree', trans('admin.from_account').session_lang($operation->name_en,$operation->name_ar), ['class' => 'control-label']) }}
            {{ Form::select('fromtree',$tree,null, array_merge(['class' => 'form-control e2 fromtree','placeholder'=> trans('admin.select') ])) }}
        </div>
        <div class="col-md-3">
            {{ Form::label('tree', trans('admin.to_account').session_lang($operation->name_en,$operation->name_ar), ['class' => 'control-label']) }}
            {{ Form::select('totree',$tree,null, array_merge(['class' => 'form-control e2 totree','placeholder'=> trans('admin.select') ])) }}
        </div>
        <div class="col-md-3">
            {{ Form::label('receipts', trans('admin.From'), ['class' => 'control-label']) }}
            {{ Form::text('From',\Carbon\Carbon::today()->format('Y-'.\Carbon\Carbon::now()->diffInYears(\Carbon\Carbon::now()->copy()->addYear()).'-'.\Carbon\Carbon::now()->diffInYears(\Carbon\Carbon::now()->copy()->addYear())), array_merge(['class' => 'form-control from date','required'=>'required','autocomplete'=>'off'])) }}
        </div>
        <div class="col-md-3">
            {{ Form::label('receipts', trans('admin.To'), ['class' => 'control-label']) }}
            {{ Form::text('To',\Carbon\Carbon::today()->format('Y-m-d'), array_merge(['class' => 'form-control to date','required'=>'required','autocomplete'=>'off'])) }}
        </div>
    </div>
{{--loader spinner--}}
<div id='loadingmessage-2' style='display:none; margin-top: 20px' class="text-center">
    <img src="{{ url('/') }}/images/ajax-loader.gif"/>
</div>
    <div class="column-account-date">

    </div>
    <br>

