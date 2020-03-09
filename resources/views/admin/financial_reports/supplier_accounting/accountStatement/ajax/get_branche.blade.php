<script>
    $(function () {
        'use strict'

        $(".MainBranch").on("change",function(){
            var MainBranch = $(this).val();
            var mainCompany = '{{$mainCompany}}';

            $("#loadingmessage-2").css("display","block");
            $(".details_row").css("display","none");
            if (this){
                $.ajax({
                    url: '{{route('acc_state')}}',
                    type:'get',
                    dataType:'html',
                    data:{mainCompany: mainCompany,MainBranch:MainBranch},
                    success: function (data) {
                        $("#loadingmessage-2").css("display","none");
                        $('.details_row').css("display","block").html(data);

                    }
                });
            }else{
                $('.column_account').html('');
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

<div>
    {{ Form::label('MainBranch','الفروع', ['class' => 'control-label']) }}
    {{ Form::select('MainBranch',$MainBranch,null, array_merge(['class' => 'form-control MainBranch e2','placeholder'=> trans('admin.select') ])) }}
</div>
<div id='loadingmessage-2' style='display:none' class="text-center">
    <img src="{{ url('/') }}/images/ajax-loader.gif"/>
</div>

