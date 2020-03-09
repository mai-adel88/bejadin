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


    });
</script>



<div class="form-group" style="padding: 0 10px;">
@if($search == 0)
    {{ Form::selectRange('typeRange', 1,$max_count,null, array_merge(['class' => 'form-control typeRange','placeholder'=>trans('admin.select')])) }}
@elseif($search == 1)
    {{ Form::select('type', $max_count,null, array_merge(['class' => 'form-control type','placeholder'=>trans('admin.select')])) }}
@endif
</div>
<div id='loadingmessage-2' style='display:none; margin-top: 20px' class="text-center">
    <img src="{{ url('/') }}/images/ajax-loader.gif"/>
</div>
<br>
<div class="column-data-report">


</div>









