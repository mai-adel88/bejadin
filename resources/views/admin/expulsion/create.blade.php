<script>
    $(function () {
        'use strict'
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.send').on('click',function () {
            var from = '{{$from}}';
            var to = '{{$to}}';
            $("#loadingmessage").css("display","block");
            $(".column-send").css("display","none");
            $(".send").css("display","none");
            if (this){
                $.ajax({
                    url: '{{route('expulsion.store')}}',
                    type:'post',
                    dataType:'html',
                    data:{token: '{{csrf_token()}}',from : from,to: to},
                   success(data){
                       if (data){
                           $("#loadingmessage").css("display","none");
                           $('.column-send').css("display","block").html(data);
                           $(".send").css("display","block");
                           location.reload();
                       }
                   },
                    error: function () {
                        $("#loadingmessage").css("display","none");
                        $('.column-send').css("display","block").html(data);
                        $(".send").css("display","block");
                        location.reload();
                    }
                });
            }else{
                $('.column-send').html('<div class="alert alert-danger">يوجد شيء خاطيء من فضلك ارجع للدعم الفني</div>');
            }
        })
    })
</script>


<button class="btn btn-primary send" type="button">{{__('admin.send')}}</button>
<div class="clearfix"></div>
{{--loader spinner--}}
<div id='loadingmessage' style='display:none; margin-top: 20px' class="text-center">
    جاري تنفيذ طلبك من فضلك انتظر قليلا
    <img src="{{ url('/') }}/images/ajax-loader.gif"/>
</div>
<div class="column-send">

</div>
