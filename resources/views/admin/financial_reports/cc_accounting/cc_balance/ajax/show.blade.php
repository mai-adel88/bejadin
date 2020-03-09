<script>
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
                    url: '{{route('cc_balance.level')}}',
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
                url: '{{route('cc_balance.details')}}',
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
    $(document).on('change','.fromtreee',function () {
        var fromtreee = $(this).val(),
            selectHtml = $('.fromtreee option[value="'+fromtreee+'"]'),
            selectHtml2 = $('#totree option[value="'+fromtreee+'"]'),

            optionSelected = '<option value="'+fromtreee+'" selected>'+selectHtml.html()+'</option>';
        $('#totree option:not([value="'+fromtreee+'"])').removeAttr('selected');
        $('.fromtreee').prepend(optionSelected);

        $('.number_fromtree').val(fromtreee);
        $('.number_totree').val(fromtreee);
        $('#totree').val(fromtreee);

        $('#totree').prepend(optionSelected);

        if (selectHtml.length === 1){
            $('#totree ul.select2-results__options').prepend(`
            <li class="select2-results__option" role="treeitem" aria-selected="true" data-select2-id="`+selectHtml.val()+`">`+selectHtml.html()+`</li>
        `);

            $('.fromtreee ul.select2-results__options').prepend(`
            <li class="select2-results__option" role="treeitem" aria-selected="true" data-select2-id="`+selectHtml.val()+`">`+selectHtml.html()+`</li>
        `);

        }
        selectHtml.remove();
        selectHtml2.remove();
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
                url: '{{route('cc_balance.details')}}',
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
                    url: '{{route('cc_balance.details')}}',
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
                    url: '{{route('cc_balance.details')}}',
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

        $(document).on('change','.number_fromtree',function(){
            var number_fromtree = $(this).val(),
                selectHtml = $('.fromtree option[value="'+number_fromtree+'"]'),
                optionSelected = '<option value="'+number_fromtree+'" selected>'+selectHtml.html()+'</option>';

            $('.number_fromtree').val(number_fromtree);
            $('#fromtree option:not([value="'+number_fromtree+'"])').removeAttr('selected');
            $('#fromtree').prepend(optionSelected);
            if (selectHtml.length === 1){
                $('#fromtree ul.select2-results__options').prepend(`
                            <li class="select2-results__option" role="treeitem" aria-selected="true" data-select2-id="`+selectHtml.val()+`">`+selectHtml.html()+`</li>
                        `);
            }
            selectHtml.remove();
        });

        $(document).on('change','.number_totree',function(){
            var number_totree = $(this).val(),
                selectHtml = $('.totree option[value="'+number_totree+'"]'),
                optionSelected = '<option value="'+number_totree+'" selected>'+selectHtml.html()+'</option>';

            $('.number_totree').val(number_totree);
            $('#totree option:not([value="'+number_totree+'"])').removeAttr('selected');
            $('#totree').prepend(optionSelected);
            if (selectHtml.length === 1){
                $('#totree ul.select2-results__options').prepend(`
                            <li class="select2-results__option" role="treeitem" aria-selected="true" data-select2-id="`+selectHtml.val()+`">`+selectHtml.html()+`</li>
                        `);
            }
            selectHtml.remove();
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
            {{ Form::label('tree','من مركز تكلفه', ['class' => 'col-xs-3 control-label']) }}
            {{ Form::select('fromtree',$MtsCostcntr->pluck('Costcntr_Nm'.session('lang'),'Costcntr_No'),$fromtree, array_merge(['class' => 'form-control col-xs-9 e2 efirst fromtree', 'id'=>'fromtree'])) }}
        </div>
        <div class="col-xs-3">
            {{ Form::text('number_fromtree',$MtsCostcntr3->first(), array_merge(['class' => 'form-control number_fromtree'])) }}
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-xs-9">
            {{ Form::label('tree','الى مركز تكلفه', ['class' => 'col-xs-3']) }}
            {{ Form::select('totree',$MtsCostcntr->orderByDesc('Costcntr_No')->pluck('Costcntr_Nm'.session('lang'),'Costcntr_No'),$totree, array_merge(['class' => 'form-control col-xs-9 e2 elast totree', 'id'=>'totree'])) }}
        </div>
        <div class="col-xs-3">
            {{ Form::text('number_totree',$MtsCostcntr3->last(), array_merge(['class' => 'form-control number_totree'])) }}
        </div>
    </div>

</div>

