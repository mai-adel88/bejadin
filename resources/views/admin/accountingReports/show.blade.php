<script>
    $(function () {
        'use strict'

        $(".from,.to").on("change",function(){
            var kind = '{{$kind}}';
            var from = $('.from').val();
            var to = $('.to').val();
            var operations = $('.operations option:selected').val();
            var branches = $('.branches option:selected').val();
            var type = $('.type option:selected').val();
            if (this){
                $.ajax({
                    url: '{{aurl('dailyReport/details')}}',
                    type:'get',
                    dataType:'html',
                    data:{kind: kind,from: from,to: to,operations : operations,branches: branches,type: type},
                    success: function (data) {
                        $('.column-account-date').html(data);

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
            $('#e2').select2({
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
@if($kind == 0)

    {{ Form::label('date', trans('admin.by_date'), ['class' => 'control-label text-center']) }}
    <div class="form-group row">
        <div class="col-md-6">
            {{ Form::label('date', trans('admin.From'), ['class' => 'control-label']) }}
            {{ Form::text('date',\Carbon\Carbon::today()->format('Y-m-d'), array_merge(['class' => 'form-control date from','required'=>'required'])) }}
        </div>
        <div class="col-md-6">
            {{ Form::label('date', trans('admin.To'), ['class' => 'control-label']) }}
            {{ Form::text('date',\Carbon\Carbon::today()->format('Y-m-d'), array_merge(['class' => 'form-control date to','required'=>'required'])) }}
        </div>

    </div>
    @else
    {{ Form::label('date', trans('admin.by_receipt'), ['class' => 'control-label text-center']) }}
    <div class="form-group row">
        <div class="col-md-6">
            {{ Form::label('receipts', trans('admin.From'), ['class' => 'control-label']) }}
            {{ Form::text('From',null, array_merge(['class' => 'form-control from','required'=>'required'])) }}
        </div>
        <div class="col-md-6">
            {{ Form::label('receipts', trans('admin.To'), ['class' => 'control-label']) }}
            {{ Form::text('To',null, array_merge(['class' => 'form-control to','required'=>'required'])) }}
        </div>
    </div>
@endif

    <div class="column-account-date">

    </div>
    <br>



