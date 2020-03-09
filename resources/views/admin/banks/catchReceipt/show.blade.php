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

        $(".type").on("change",function(){
            event.preventDefault();
            var type = $(this).last().val();
            var receipts_id = '{{$receipts_id}}';
            var invoice = $('.invoice').val();
            $("#loadingmessage-2").css("display","block");
            $(".column-account-date").css("display","none");
            if (this){
                $.ajax({
                    url: '{{aurl('banks/Receipt/detailsSelect')}}',
                    type:'get',
                    dataType:'html',
                    data:{type : type,invoice: invoice,receipts_id: receipts_id},
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
<div class="row">
    <div class="col-md-10">
        <div class="form-group">
            {{ Form::label('type', trans('admin.account_type'), ['class' => 'control-label']) }}
            {{ Form::select('type',$operations,null, array_merge(['class' => 'form-control type','placeholder'=> trans('admin.select') ])) }}
        </div>
    </div>
    <div class="col-md-2">
        <h5 class="box-title" style="line-height: 60px">{{trans('admin.receipt_num')}}:{{checkIdReceipts($receiptsId)}}</h5>
    </div>
</div>
{{--loader spinner--}}
<div id='loadingmessage-2' style='display:none; margin-top: 20px' class="text-center">
    <img src="{{ url('/') }}/images/ajax-loader.gif"/>
</div>
<div class="column-account-date">

</div>