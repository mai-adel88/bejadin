{{--<script>--}}

{{--    $(document).ready(function () {--}}
{{--        $('.fromtree').change(function () {--}}
{{--            var fromtree = $(this).val();--}}
{{--            $('.number_fromtree').val(fromtree);--}}
{{--            var MainCompany = '{{isset($MainCompany) ? $MainCompany : null}}';--}}
{{--            var level = $('#level_check').val();--}}

{{--            // var level = $('#level_check option:selected').val();--}}
{{--            alert(level);--}}
{{--            // var level = $('#level_check').val();--}}

{{--            var radiodepartment =  $('input[name="department"]:checked').val();--}}
{{--            var from =  $('input[name="From"]').val();--}}
{{--            var to =  $('input[name="To"]').val();--}}

{{--            $(".print_div").css("display","none");--}}
{{--            if (this) {--}}
{{--                $.ajax({--}}
{{--                    url: '{{route('movementTrialbalance.details')}}',--}}
{{--                    type: 'get',--}}
{{--                    dataType: 'html',--}}
{{--                    data: {MainCompany: MainCompany,--}}
{{--                        level: level,--}}
{{--                        fromtree: fromtree,--}}
{{--                        from: from,--}}
{{--                        to: to,--}}
{{--                        radiodepartment: radiodepartment,--}}
{{--                    },--}}
{{--                    success: function (data) {--}}
{{--                        $("#loadingmessage-2").css("display", "none");--}}
{{--                        $('.print_div').css("display", "block").html(data);--}}
{{--                    }--}}
{{--                });--}}
{{--            }--}}
{{--        });--}}
{{--    });--}}

{{--</script>--}}

@if($level)

    @foreach($level as $key=>$one)
        <option value="{{$one}}">{{$key+1}}</option>
    @endforeach
@endif

