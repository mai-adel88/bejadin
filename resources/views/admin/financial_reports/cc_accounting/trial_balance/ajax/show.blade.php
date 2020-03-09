<script>
    $(document).ready(function () {
        $('.fromtree').change(function () {
            var MainCompany = '{{isset($MainCompany) ? $MainCompany : null}}';
            var fromtree = $(this).val();
            var level = $('#level_check').val();
            $.ajax({
                url: '{{route('get_levels')}}',
                type: 'get',
                dataType: 'html',
                data: {MainCompany: MainCompany, fromtree:fromtree, level:level},
                success:function (data) {

                    //console.log(response.level);

                    $('#level_check').html(data);


                }
            });
            $.ajax({
                url: '{{route('movementTrialbalance.details')}}',
                type: 'get',
                dataType: 'html',


                data: {MainCompany: '{{isset($MainCompany) ? $MainCompany : null}}',
                    level: $('#level_check').val(),

                    fromtree:  $('.fromtree').val(),
                    from: $('input[name="From"]').val(),
                    to: $('input[name="To"]').val(),
                    radiodepartment: $('input[name="department"]:checked').val(),
                },
                success: function (data) {
                    $("#loadingmessage-2").css("display", "none");
                    $('.print_div').css("display", "block").html(data);
                }
            });
        });
    });


    $(document).ready(function () {
        if ("{{$fromtree,$totree}}"){
            var MainCompany = '{{isset($MainCompany) ? $MainCompany : null}}';
            var level = $('#level_check').val();
            var fromtree = $('.efirst').val();

            var radiodepartment =  $('input[name="department"]:checked').val();
            var from =  $('input[name="From"]').val();
            var to =  $('input[name="To"]').val();


            $(".print_div").css("display","none");
            if (this) {
                $.ajax({
                    url: '{{route('movementTrialbalance.details')}}',
                    type: 'get',
                    dataType: 'html',
                    data: {MainCompany: MainCompany,
                        level: level,
                        fromtree: fromtree,
                        from: from,
                        to: to,
                        radiodepartment: radiodepartment,

                    },
                    success: function (data) {
                        $("#loadingmessage-2").css("display", "none");
                        $('.print_div').css("display", "block").html(data);

                    }
                });
            }
        }
        $('#toDate,#fromDate').on('blur',function(){
            var to =  $('input[name="To"]').val();
            var MainCompany = '{{isset($MainCompany) ? $MainCompany : null}}';
            var level = $('#level_check').val();
            var fromtree = $('.efirst').val();
            var radiodepartment =  $('input[name="department"]:checked').val();
            var from =  $('input[name="From"]').val();

            $(".print_div").css("display","none");
            if (this) {
                $.ajax({
                    url: '{{route('movementTrialbalance.details')}}',
                    type: 'get',
                    dataType: 'html',
                    data: {MainCompany: MainCompany,
                        level: level,
                        fromtree: fromtree,
                        from: from,
                        to: to,
                        radiodepartment: radiodepartment,
                    },
                    success: function (data) {
                        $("#loadingmessage-2").css("display", "none");
                        $('.print_div').css("display", "block").html(data);

                    }
                });
            }
        });

    $(document).on('change','#level_check',function () {
        var MainCompany = '{{isset($MainCompany) ? $MainCompany : null}}';
        var level = $(this).val();
        var fromtree = $('.fromtree').val();
        $('.number_fromtree').val(fromtree);
        var from =  $('input[name="From"]').val();
        var to =  $('input[name="To"]').val();

        $(".print_div").css("display","none");
        if (this) {
            $.ajax({
                url: '{{route('movementTrialbalance.details')}}',
                type: 'get',
                dataType: 'html',
                data: {MainCompany: MainCompany,
                    level: level,
                    fromtree: fromtree,
                    from: from,
                    to: to,
                    radiodepartment: radiodepartment,
                },
                success: function (data) {
                    $("#loadingmessage-2").css("display", "none");
                    $('.print_div').css("display", "block").html(data);

                }
            });
        }

    });
    });






</script>
<div class="details_level">
    <div class="row" >
        <div class="col-xs-9">
            {{ Form::label('tree','مراكز التكلفه', ['class' => 'col-xs-3 control-label']) }}
            {{ Form::select('fromtree',$MtsCostcntr,$fromtree, array_merge(['class' => 'form-control col-xs-9 e2 efirst fromtree'])) }}
        </div>
        <div class="col-xs-3">
            {{ Form::text('number_fromtree',$MtsCostcntr3->first(), array_merge(['class' => 'form-control number_fromtree'])) }}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 col-xs-12">
        {{ Form::label('level','المستوى', ['class' => 'col-md-2 control-label']) }}
        <select name="level" class="form-control col-xs-10" id="level_check">

            @foreach($level as $key=>$one)

                <option value="{{$one}}">{{$key+1}}</option>
            @endforeach
        </select>
    </div>
</div>




