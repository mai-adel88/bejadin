<script>
    $(document).ready(function(){
        if('{{$MainCompany}}','{{$type}}'){
            var MainCompany = $('.MainCompany').val();
            var type = $('.type').val();
            var date_limition = $('input[name="date_limition"]:checked').val();
            var fromDate = $('.fromDate').val();
            var toDate = $('.toDate').val();


            $("#loadingmessage-1").css("display","block");
            $(".details_row").css("display","none");
            if (this){
                $.ajax({
                    url: '{{route('sup_daily_restriction.details')}}',
                    type:'get',
                    dataType:'html',
                    data:{MainCompany: MainCompany,type: type,date_limition: date_limition,

                        fromDate: fromDate,
                        toDate: toDate
                    },
                    success: function (data) {
                        $("#loadingmessage-1").css("display","none");
                        $('.details_row').css("display","block").html(data);

                    }
                });
            }else{
                $('.details_row').html('');
            }
        };


    });
</script>

<div class="row" style="margin-top: 2%">
<div class="col-md-12">
    <div class="col-xs-4" style="display: flex;flex-direction: row">

        {{ Form::label('From', trans('admin.From'), ['class' => 'col-md-2 col-xs-3','style'=>'margin:1%']) }}
        {{ Form::text('From',\Carbon\Carbon::today()->format('Y-'.\Carbon\Carbon::now()->diffInYears(\Carbon\Carbon::now()->copy()->addYear()).'-'.\Carbon\Carbon::now()->diffInYears(\Carbon\Carbon::now()->copy()->addYear())), array_merge(['class' => 'col-md-10 col-xs-9 form-control  date fromDate ','id'=>'fromDate','autocomplete'=>'off'])) }}
    </div>
    <div class="col-xs-4">
        {{ Form::label('To', trans('admin.To'), ['class' => 'col-md-2 col-xs-3']) }}
        {{ Form::text('To',\Carbon\Carbon::today()->format('Y-m-d'), array_merge(['class' => 'col-md-10 col-xs-9 form-control  date  toDate','id'=>'toDate'])) }}

    </div>

</div>


</div>



