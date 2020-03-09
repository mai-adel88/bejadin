@extends('admin.index')
@section('title',trans('admin.movement_statement'))

@section('content')
    @push('css')
        <style>
            .bg-warning {
                background-color: #ffc107!important;

            }
            .select2-container--default .select2-selection--multiple .select2-selection__choice{
                background-color: #333;
            }
            @if(session('lang') == 'ar')
                .datepicker{
                direction: rtl
            }
            @endif
        </style>
        {{--    Date Hijri--}}
        <link rel="stylesheet" href="{{url('/')}}/public/adminlte/dateHijri/dist/css/bootstrap-datetimepicker.min.css">

    @endpush

    @push('js')
        <script src="{{url('/')}}/public/adminlte/dateHijri/dist/js/bootstrap-hijri-datepicker.min.js"></script>

        <script>
            $(document).on('change','.MainCompany',function(){
                var mainCompany = $(this).val();

                $("#loadingmessage-1").css("display","block");
                $(".details_row").css("display","none");
                if(this){
                    $.ajax({
                        url: "{{route('movement_acc_cc')}}",
                        type: 'get',
                        datatype: 'html',
                        data:{mainCompany:mainCompany},
                        success:function (data) {
                            $("#loadingmessage-1").css("display","none");
                            $('.details_row').css("display","block").html(data);
                        }
                    });
                }else{
                    $('.column_account').html('');
                }
            });
            $(document).on('change','.fromtreee',function () {
                var fromtreee = $(this).val(),
                    selectHtml = $('.fromtreee option[value="'+fromtreee+'"]'),
                    selectHtml2 = $('#totree option[value="'+fromtreee+'"]'),
                    optionSelected = '<option value="'+fromtreee+'" selected>'+selectHtml.html()+'</option>';
                $('#totree option:not([value="'+fromtreee+'"])').removeAttr('selected');
                $('.fromtreee').prepend(optionSelected);

                $('.acc_fromtree').val(fromtreee);
                $('.acc_totree').val(fromtreee);
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
            $(document).on('change','#totree',function () {
                var totree = $(this).val();

                var  selectHtml = $('.fromtreee option[value="'+totree+'"]');
                var selectHtml2 = $('#totree option[value="'+totree+'"]');

                var  optionSelected = '<option value="'+totree+'" selected>'+selectHtml.html()+'</option>';

                $('#totree option:not([value="'+totree+'"])').removeAttr('selected');
                $('.fromtreee').prepend(optionSelected);

                $('.acc_fromtree').val(totree);
                $('.acc_totree').val(totree);
                $('#fromtree').val(totree);

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
            $(document).on('change','.acc_fromtree',function(){
                var acc_fromtree = $(this).val(),
                    selectHtml = $('.fromtreee option[value="'+acc_fromtree+'"]'),
                    selectHtml2 = $('#totree option[value="'+acc_fromtree+'"]'),

                    optionSelected = '<option value="'+acc_fromtree+'" selected>'+selectHtml.html()+'</option>';

                $('.acc_fromtree').val(acc_fromtree);
                $('.acc_totree').val(acc_fromtree);

                $('#fromtree option:not([value="'+acc_fromtree+'"])').removeAttr('selected');
                $('#totree option:not([value="'+acc_fromtree+'"])').removeAttr('selected');
                $('#totree').prepend(optionSelected);
                $('#fromtree').prepend(optionSelected);
                if (selectHtml.length === 1){

                    $('#fromtree ul.select2-results__options').prepend(`
                            <li class="select2-results__option" role="treeitem" aria-selected="true" data-select2-id="`+selectHtml.val()+`">`+selectHtml.html()+`</li>
                        `);
                    $('#totree ul.select2-results__options').prepend(`
                            <li class="select2-results__option" role="treeitem" aria-selected="true" data-select2-id="`+selectHtml.val()+`">`+selectHtml.html()+`</li>
                        `);
                }

                selectHtml.remove();
                selectHtml2.remove();

            });
            $(document).on('change','.acc_totree',function(){
                var acc_totree = $(this).val(),
                    selectHtml = $('.acc_totree option[value="'+acc_totree+'"]'),
                    selectHtml2 = $('#fromtree option[value="'+acc_totree+'"]'),
                    optionSelected = '<option value="'+acc_totree+'" selected>'+selectHtml.html()+'</option>';

                $('.acc_totree').val(acc_totree);
                $('.acc_fromtree').val(acc_totree);

                $('#fromtree option:not([value="'+acc_totree+'"])').removeAttr('selected');
                $('#totree option:not([value="'+acc_totree+'"])').removeAttr('selected');
                $('#totree').prepend(optionSelected);
                $('#fromtree').prepend(optionSelected);
                if (selectHtml.length === 1){

                    $('#fromtree ul.select2-results__options').prepend(`
                            <li class="select2-results__option" role="treeitem" aria-selected="true" data-select2-id="`+selectHtml.val()+`">`+selectHtml.html()+`</li>
                        `);
                    $('#totree ul.select2-results__options').prepend(`
                            <li class="select2-results__option" role="treeitem" aria-selected="true" data-select2-id="`+selectHtml.val()+`">`+selectHtml.html()+`</li>
                        `);
                }

                selectHtml.remove();
                selectHtml2.remove();

            });
            $(document).on("change","#fromtree, #totree,.acc_fromtree,.acc_totree",function()
            {
                var maincompany = $('.MainCompany').val();
                var fromtree = $('#fromtree').val();
                var totree = $('#totree').val();
                var acc_fromtree = $('.acc_fromtree').val();
                var acc_totree = $('.acc_totree').val();
                var from = $('#froxsate').val();
                var to = $('#toDate').val();

                $("#loadingmessage_1").css("display","block");
                $(".button_print").css("display","none");
                if (this){
                    $.ajax({
                        url: '{{route('movement_details')}}',
                        type:'get',
                        dataType:'html',
                        data:{maincompany: maincompany,totree: totree,from: from,to : to,fromtree:fromtree,acc_fromtree:acc_fromtree,acc_totree:acc_totree},
                        success: function (data) {
                            $("#loadingmessage_1").css("display","none");
                            $('.button_print').css("display","block").html(data);

                        }
                    });
                }else{
                    $('.button_print').html('');
                }
            });
            $("#froxsate ,#toDate").blur(function(){

                var maincompany = $('.MainCompany').val();
                var fromtree = $('#fromtree').val();
                var totree = $('#totree').val();
                var acc_fromtree = $('.acc_fromtree').val();
                var acc_totree = $('.acc_totree').val();
                var from = $('#froxsate').val();
                var to = $('#toDate').val();

                $("#loadingmessage_1").css("display","block");
                $(".button_print").css("display","none");

                if (this){
                    $.ajax({
                        url: '{{route('movement_details')}}',
                        type:'get',
                        dataType:'html',
                        data:{maincompany: maincompany,totree: totree,from: from,to : to,fromtree:fromtree,acc_fromtree:acc_fromtree,acc_totree:acc_totree},
                        success: function (data) {
                            $("#loadingmessage_1").css("display","none");
                            $('.button_print').css("display","block").html(data);

                        }
                    });
                }else{
                    $('.button_print').html('');
                }
            });
            $(".hijri-date-input").hijriDatePicker({
                    hijri : false,
                    format: "YYYY-MM-DD",
                    hijriFormat: 'iYYYY-iMM-iDD',
                    showTodayButton:true,
            });

        </script>

    @endpush

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">كشف بحركة مراكز التكلفه</h3>
        </div>
        <div class="box-body row">
            <div class="col-xs-7">
                <div class="col-xs-12">
                    {{ Form::label('maincompany','الشركات', ['class' => 'col-xs-2']) }}
                    {{ Form::select('MainCompany',$MainCompany,null, array_merge(['class' => 'col-xs-10 form-control MainCompany e2'])) }}
                </div>

                <br>
                <br>
                <div class=" col-xs-12">
                    <div class="details_row">
                    <div class="row">
                        <div class="col-xs-10">
                            {{ Form::label('tree','من مركز تكلفه', ['class' => 'col-xs-3']) }}
                            {{ Form::select('fromtree',[],null, array_merge(['class' => 'col-xs-9  form-control  e2 ee fromtree' ])) }}
                        </div>

                        <div class="col-xs-2">
                            {{ Form::text('fromtree',null, array_merge(['class' => 'form-control e2 fromtree'])) }}

                        </div>
                    </div>

                    <br>
                    <div class="row">
                        <div class="col-xs-10">
                            {{ Form::label('tree','الى مركز تكلفه', ['class' => 'col-xs-3']) }}
                            {{ Form::select('totree',[],null, array_merge(['class' => 'col-xs-9  form-control  e2 ee totree'])) }}
                        </div>

                        <div class="col-xs-2">
                            {{ Form::text('totree',null, array_merge(['class' => 'form-control e2 totree'])) }}

                        </div>
                    </div>
                    </div>
                </div>




            </div>

            <div class="col-xs-5 well">

                {{ Form::label('From', trans('admin.From'), ['class' => 'col-xs-2']) }}
                {{ Form::text('From',\Carbon\Carbon::today()->format('Y-'.\Carbon\Carbon::now()->diffInYears(\Carbon\Carbon::now()->copy()->addYear()).'-'.\Carbon\Carbon::now()->diffInYears(\Carbon\Carbon::now()->copy()->addYear())), array_merge(['class' => 'col-xs-6 form-control  hijri-date-input','id'=>'froxsate','autocomplete'=>'off'])) }}

                <br>
                <br>

                {{ Form::label('To', trans('admin.To'), ['class' => 'col-xs-2']) }}
                {{ Form::text('To',\Carbon\Carbon::today()->format('Y-m-d'), array_merge(['class' => 'col-xs-6 form-control  hijri-date-input date','id'=>'toDate'])) }}

            </div>
        </div>


        <div class="row">
            <div class="button_print">

            </div>
{{--            <div>--}}
{{--                <a class="btn btn-danger" href="javascript:history.back()">الرجوع</a>--}}

{{--            </div>--}}

        </div>



        {{--    loader spinner--}}
        <div id='loadingmessage-1' style='display:none; margin-top: 20px' class="text-center">
            <img src="{{ url('/') }}/public/images/ajax-loader.gif"/>
        </div>

    </div>

@endsection
