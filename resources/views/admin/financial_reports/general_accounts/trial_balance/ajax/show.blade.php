<script>

    $(document).on('change','.fromtree',function () {
        var fromtreee = $(this).val();
        $('.number_fromtree').val(fromtreee);
        var MainCompany = '{{isset($MainCompany) ? $MainCompany : null}}';
        var level = '{{isset($level) ? $level : null}}';
        var fromtree = $(this).val();
        var totree = $('.totree').val();
        var radiodepartment =  $('input[name="department"]:checked').val();
        var from =  $('input[name="From"]').val();
        var to =  $('input[name="To"]').val();
        var but_level_check =  $('input[id="but_level_check"]:checked').val();

        $(".print_div").css("display","none");
        if (this) {
            $.ajax({
                url: '{{route('trialbalance.details')}}',
                type: 'get',
                dataType: 'html',
                data: {MainCompany: MainCompany,
                    level: level,
                    fromtree: fromtree, totree: totree,
                    from: from,
                    to: to,
                    radiodepartment: radiodepartment,
                    but_level_check: but_level_check,
                },
                success: function (data) {
                    $("#loadingmessage-2").css("display", "none");
                    $('.print_div').css("display", "block").html(data);

                }
            });
        }

    });

    $(document).on('change','.totree',function () {
        var totree = $(this).val();
        $('.number_totree').val(totree);

        var MainCompany = '{{isset($MainCompany) ? $MainCompany : null}}';
        var level = '{{isset($level) ? $level : null}}';
        var fromtree = $('.fromtree').val();
        var totree = $(this).val();
        var radiodepartment =  $('input[name="department"]:checked').val();
        var from =  $('input[name="From"]').val();
        var to =  $('input[name="To"]').val();
        var but_level_check =  $('input[id="but_level_check"]:checked').val();

        $(".print_div").css("display","none");
        if (this) {
            $.ajax({
                url: '{{route('trialbalance.details')}}',
                type: 'get',
                dataType: 'html',
                data: {MainCompany: MainCompany,
                    level: level,
                    fromtree: fromtree, totree: totree,
                    from: from,
                    to: to,
                    radiodepartment: radiodepartment,
                    but_level_check: but_level_check,
                },
                success: function (data) {
                    $("#loadingmessage-2").css("display", "none");
                    $('.print_div').css("display", "block").html(data);

                }
            });
        }

    });

    $(document).ready(function () {
        if ("{{$fromtree,$totree}}"){
            var MainCompany = '{{isset($MainCompany) ? $MainCompany : null}}';
            var level = '{{isset($level) ? $level : null}}';
            var fromtree = $('.efirst').val();
            var totree = $('.elast').val();
            var radiodepartment =  $('input[name="department"]:checked').val();
            var from =  $('input[name="From"]').val();
            var to =  $('input[name="To"]').val();
            var but_level_check =  $('input[id="but_level_check"]:checked').val();

            $(".print_div").css("display","none");
            if (this) {
                $.ajax({
                    url: '{{route('trialbalance.details')}}',
                    type: 'get',
                    dataType: 'html',
                    data: {MainCompany: MainCompany,
                        level: level,
                        fromtree: fromtree, totree: totree,
                        from: from,
                        to: to,
                        radiodepartment: radiodepartment,
                        but_level_check: but_level_check,
                    },
                    success: function (data) {
                        $("#loadingmessage-2").css("display", "none");
                        $('.print_div').css("display", "block").html(data);

                    }
                });
            }
        }
        $('.total_department').change(function () {
            var MainCompany = '{{isset($MainCompany) ? $MainCompany : null}}';
            var level = '{{isset($level) ? $level : null}}';
            var fromtree = $('.fromtree').val();
            var totree = $('.totree').val();
            var radiodepartment =  $(this).val();
            var from =  $('input[name="From"]').val();
            var to =  $('input[name="To"]').val();
            var but_level_check =  $('input[id="but_level_check"]:checked').val();

            $(".print_div").css("display","none");
            if (this) {
                $.ajax({
                    url: '{{route('trialbalance.details')}}',
                    type: 'get',
                    dataType: 'html',
                    data: {MainCompany: MainCompany,
                        level: level,
                        fromtree: fromtree, totree: totree,
                        from: from,
                        to: to,
                        radiodepartment: radiodepartment,
                        but_level_check: but_level_check,
                    },
                    success: function (data) {
                        $("#loadingmessage-2").css("display", "none");
                        $('.print_div').css("display", "block").html(data);

                    }
                });
            }
        });
        $('#but_level_check').change(function () {
            var MainCompany = '{{isset($MainCompany) ? $MainCompany : null}}';
            var level = '{{isset($level) ? $level : null}}';
            var fromtree = $('.fromtree').val();
            var totree = $('.totree').val();
            var radiodepartment =  $('input[name="department"]').val();
            var from =  $('input[name="From"]').val();
            var to =  $('input[name="To"]').val();
            var but_level_check =  $(this).val();

            $(".print_div").css("display","none");
            if (this) {
                $.ajax({
                    url: '{{route('trialbalance.details')}}',
                    type: 'get',
                    dataType: 'html',
                    data: {MainCompany: MainCompany,
                        level: level,
                        fromtree: fromtree, totree: totree,
                        from: from,
                        to: to,
                        radiodepartment: radiodepartment,
                        but_level_check: but_level_check,
                    },
                    success: function (data) {
                        $("#loadingmessage-2").css("display", "none");
                        $('.print_div').css("display", "block").html(data);

                    }
                });
            }
        });

        $('#toDate,#fromDate').on('blur',function(){
            var to =  $('input[name="To"]').val();
            var MainCompany = '{{isset($MainCompany) ? $MainCompany : null}}';
            var level = '{{isset($level) ? $level : null}}';
            var fromtree = $('.efirst').val();
            var totree = $('.elast').val();

            var radiodepartment =  $('input[name="department"]:checked').val();

            var from =  $('input[name="From"]').val();


            var but_level_check =  $('input[id="but_level_check"]:checked').val();

            $(".print_div").css("display","none");
            if (this) {
                $.ajax({
                    url: '{{route('trialbalance.details')}}',
                    type: 'get',
                    dataType: 'html',
                    data: {MainCompany: MainCompany,
                        level: level,
                        fromtree: fromtree, totree: totree,
                        from: from,
                        to: to,
                        radiodepartment: radiodepartment,
                        but_level_check: but_level_check,
                    },
                    success: function (data) {
                        $("#loadingmessage-2").css("display", "none");
                        $('.print_div').css("display", "block").html(data);

                    }
                });
            }
        });
    });
    $(document).ready(function () {
        $('#level_check').on('keyup',function(){
            var MainCompany = '{{isset($MainCompany) ? $MainCompany : null}}';
            var level = $(this).val();
            var radiodepartment =  $('input[name="department"]:checked').val();
            var from =  $('input[name="From"]').val();
            var to =  $('input[name="To"]').val();
            var but_level_check =  $('input[id="but_level_check"]:checked').val();

            $(".details_level").css("display","none");
            if (this) {
                $.ajax({
                    url:'{{route('trialbalance.level')}}',
                    type: 'get',
                    dataType: 'html',
                    data: {MainCompany: MainCompany,
                        level: level,

                        from: from,
                        to: to,
                        radiodepartment: radiodepartment,
                        but_level_check: but_level_check,
                    },
                    success: function (data) {
                        $("#loadingmessage-2").css("display", "none");
                        $('.details_level').css("display", "block").html(data);

                    }
                });
            }
        });
    });

</script>

<script>
    $(function () {
        'use strict'
        $('.e2').select2();
    });

</script>
<div class="row">

    <div class="col-md-12 col-xs-12">
        {{ Form::label('level','المستوى', ['class' => 'col-md-2 control-label']) }}
        {{ Form::text('level',$level,array_merge(['class' => 'form-control col-xs-10', 'id'=>'level_check','disabled'=>'disabled'])) }}
    </div>
</div>
<br>

<div class="details_level">
    <div class="row" >
        <div class="col-xs-9">
            {{ Form::label('tree','من حساب', ['class' => 'col-xs-3 control-label']) }}
            {{ Form::select('fromtree',$MtsChartAc,$fromtree, array_merge(['class' => 'form-control col-xs-9 e2 efirst fromtree'])) }}
        </div>
        <div class="col-xs-3">
            {{ Form::text('number_fromtree',$MtsChartAc3->first(), array_merge(['class' => 'form-control number_fromtree'])) }}
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-xs-9">
            {{ Form::label('tree','الى حساب', ['class' => 'col-xs-3']) }}
            {{ Form::select('totree',$MtsChartAc, $totree, array_merge(['class' => 'form-control col-xs-9 e2 elast totree'])) }}
        </div>
        <div class="col-xs-3">
            {{ Form::text('number_totree',$MtsChartAc5, array_merge(['class' => 'form-control number_totree'])) }}
        </div>
    </div>

</div>

