<script>
    $(function () {
        'use strict';

        // var schedule = $('.schedules').val();
        $('.type,.typeRange').on('change',function () {
            var type = $('.type').val();
            var typeRange = $('.typeRange').val();
            $("#loadingmessage-2").css("display","block");
            $(".column-data-report").css("display","none");
            if (this){
                $.ajax({
                    url: '{{aurl('departments/reports/details')}}',
                    type:'get',
                    dataType:'html',
                    data:{type : type,typeRange : typeRange},
                    success: function (data) {
                        $("#loadingmessage-2").css("display","none");
                        $('.column-data-report').css("display","block").html(data);

                    }
                });
            }else{
                $('.column-data-report').html('');
            }
        });

        $('.selecd_input').on('change',function(){

            var selecd_input = $(this).val();
            var mainCompany = '{{$mainCompany}}';
            var myradio = '{{$myradio}}';
            var active = '{{$active}}';
            var notactive = '{{$notactive}}';

            $("#loadingmessage").css("display","block");
            if (this){
                $.ajax({
                    url: '{{route('Dep_report_print')}}',
                    type:'get',
                    dataType:'html',
                    data:{selecd_input : selecd_input,mainCompany:mainCompany,myradio:myradio,active:active,notactive:notactive},
                    success: function (data) {
                        $("#loadingmessage").css("display","none");
                        $('.div_print').css("display","block").html(data);

                    }
                });
            }else{
                $('.div_print').html('');
            }

        });


    });
</script>



<div class="form-group row" style="padding: 0 10px;">
@if($myradio == 'level')
<div class="col-md-9">

    <select class="form-control selecd_input">
        <option value="">اختر ..</option>
        @foreach($levels as $level)
            <option value="{{$level}}">{{$level}}</option>
        @endforeach
    </select>
</div>

    @elseif($myradio == 'accTarseed')
        <div class="col-md-9">
    <select class="form-control selecd_input">
        <option value="">اختر ..</option>
        @foreach($acc_tarseed as $acc)
            <option value="{{$acc->ID_No}}">{{$acc->Acc_NmAr}}</option>
        @endforeach
    </select>
        </div>
    @endif
</div>
<div id='loadingmessage-2' style='display:none; margin-top: 20px' class="text-center">
    <img src="{{ url('/') }}/images/ajax-loader.gif"/>
</div>
<br>

<div class="div_print">

</div>









