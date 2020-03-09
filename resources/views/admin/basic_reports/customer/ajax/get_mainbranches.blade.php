{{--<script>--}}
{{--    $(document).ready(function(){--}}

{{--        $('.MainBranch').on('change',function(){--}}
{{--            $("#loadingmessage").css("display","block");--}}
{{--            $(".branch_data").css("display","none");--}}
{{--            var mainCompany = '{{$mainCompany}}';--}}
{{--            var MainBranch = $('.MainBranch').val();--}}

{{--            console.log(MainBranch);--}}
{{--            if (this){--}}
{{--                $.ajax({--}}
{{--                    url: '{{route('get_data_client')}}',--}}
{{--                    type:'get',--}}
{{--                    dataType:'html',--}}
{{--                    data:{mainCompany : mainCompany,MainBranch : MainBranch},--}}
{{--                    success: function (data) {--}}
{{--                        $("#loadingmessage").css("display","none");--}}
{{--                        $('.branch_data').css("display","block").html(data);--}}

{{--                    }--}}
{{--                });--}}
{{--            }else{--}}
{{--                $('.branch_data').html('');--}}
{{--            }--}}


{{--        });--}}
{{--    });--}}
{{--</script>--}}




    <select class="form-control e2 MainBranch col-md-9">
        <option  value="-1"> {{trans('admin.select')}}</option>
        @foreach($MainBranch as $one)

            <option value="{{$one->Brn_No}}">{{$one->{'Brn_Nm'.ucfirst(session('lang'))} }}
            </option>
        @endforeach

    </select>



