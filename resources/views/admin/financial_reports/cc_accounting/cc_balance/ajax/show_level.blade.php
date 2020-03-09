<script>
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

       if('{{$level}}'){
            var MainCompany = '{{isset($MainCompany) ? $MainCompany : null}}';
            var level = $('#level_check').val();
            var fromtree = $('.efirst2').val();
            var totree = $('.elast2').val();
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
        };

       $(document).on('change','.fromtree',function () {
           var fromtreee = $(this).val();
           $('.number_fromtree').val(fromtreee);
       });

       $(document).on('change','.totree',function () {
           var totree = $(this).val();
           $('.number_totree').val(totree);
       });

</script>


<div class="row" >
    <div class="col-xs-9">
        {{ Form::label('tree','من مركز حساب', ['class' => 'col-xs-3 control-label']) }}
        {{ Form::select('fromtree',$MtsCostcntr->pluck('Costcntr_Nm'.session('lang'),'Costcntr_No'),$fromtree, array_merge(['class' => 'form-control col-xs-9 e2 efirst2 fromtree', 'id'=>'fromtree'])) }}
    </div>
    <div class="col-xs-3">
        {{ Form::text('number_fromtree',$MtsCostcntr3->first(), array_merge(['class' => 'form-control number_fromtree'])) }}
    </div>
</div>
<br>
<div class="row">
    <div class="col-xs-9">
        {{ Form::label('tree','الى مركز تكلفه', ['class' => 'col-xs-3']) }}
        {{ Form::select('totree',$MtsCostcntr->orderByDesc('Costcntr_No')->pluck('Costcntr_Nm'.session('lang'),'Costcntr_No'),$totree, array_merge(['class' => 'form-control col-xs-9 e2 elast2 totree2 totree','id'=>'totree'])) }}
    </div>
    <div class="col-xs-3">
        {{ Form::text('number_totree',$MtsCostcntr3->last(), array_merge(['class' => 'form-control number_totree'])) }}
    </div>
</div>
