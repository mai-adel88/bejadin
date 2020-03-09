@extends('admin.index')
@section('title', trans('admin.delay_bill'))
@section('content')
    @push('css')
        <style>
            .datepicker{direction: rtl;}
            .delete_row{cursor: pointer;}
            table tr td input, table tr td select{width: 100%; text-align: center}
        </style>
    @endpush

    @push('js')
        <script>

            $(document).ready(function () {
                let count = 1, tableBody = $('.table_body'), id = $('#Doc_No').val();
                $('.print_save').attr('href', 'print/'+id);
                $('.print_save').click(function(){
                    window.open("{{url('admin/salesInvoices/print/')}}/"+id);
                    window.location.href = "{{route('salesInvoices.index')}}";
                });

                $('input.Doc_Dt').change(function () {
                    let Hijri = $(this).val();
                    $.ajax({
                        url: "{{route('hijri')}}",
                        type: 'get',
                        data:{Hijri: Hijri} ,
                        dataType: 'json',
                        success: function (data) {
                            $('.Doc_DtAr').val(data);
                        }
                    })
                });

                $(document).on('click', '.delete_row', function () {

                    var lineNo = parseFloat($(this).children('input').val()),
                        totalItemSal = $('#Titm_Sal_'+lineNo).val(),
                        Disc1_Val = $('#Disc1_Val_'+lineNo).val(),
                        Taxv_ExtraDtl = $('#Taxv_ExtraDtl_'+lineNo).val(),
                        Tot_ODisc = $('.Tot_ODisc').val();

                    if(tableBody.children().length === 1){
                        count = 1;
                        let lineNo = parseFloat($(this).children('input').val());
                        $('.table_body tr input').val('');
                        $(this).children('input').val(1);
                        $(this).children('span').html(1);

                        $.ajax({
                            url: "{{route('deleteLine')}}",
                            type: 'get',
                            dataType: 'json',
                            data: {
                                Doc_No: $('.Doc_No').val(),
                                Doc_Ty: $('.Doc_Ty').val(),
                                Ln_No: lineNo,
                                Tot_Sal: 0,
                                Tot_Disc: 0,
                                Tot_ODisc: 0,
                                Taxv_ExtraHdr: 0,
                                AfterDiscount:0,
                                Net: 0,
                            },
                            success: function(data){
                                if (data.status === 1){
                                    var Tot_Sal = 0;

                                    $('.Titm_Sal').each(function () {
                                        Tot_Sal += parseFloat($(this).val());
                                        $('.Tot_Sal').val(Tot_Sal)
                                    });
                                    $('.Tot_Sal').val(0);
                                    $('.Tot_Disc').val(0);
                                    $('.AfterDiscount').val(0);
                                    $('.Taxv_ExtraHdr').val(0);
                                    $('.Net').val(0);
                                    $('.Tot_Prct').val(0);

                                }
                            }
                        });
                        return false
                    } else {

                        $('.Tot_Sal').val(parseFloat(localStorage.getItem('Tot_Sal')-totalItemSal));
                        $('.Tot_Disc').val(parseFloat(localStorage.getItem('Tot_Disc')-Disc1_Val));
                        $('.AfterDiscount').val(parseFloat($('.Tot_Sal').val()-$('.Tot_Disc').val()-Tot_ODisc));
                        $('.Taxv_ExtraHdr').val(parseFloat(localStorage.getItem('Taxv_ExtraHdr')-Taxv_ExtraDtl));
                        $('.Net').val(parseFloat($('.AfterDiscount').val())+parseFloat($('.Taxv_ExtraHdr').val()));

                        $.ajax({
                            url: "{{route('deleteLine')}}",
                            type: 'get',
                            dataType: 'json',
                            data: {
                                Doc_No: $('.Doc_No').val(),
                                Doc_Ty: $('.Doc_Ty').val(),
                                Ln_No: lineNo,
                                Tot_Sal: $('.Tot_Sal').val(),
                                Tot_Disc: $('.Tot_Disc').val(),
                                Taxv_ExtraHdr: $('.Taxv_ExtraHdr').val(),
                                AfterDiscount:$('.AfterDiscount').val(),
                                Net: $('.Net').val(),
                            },
                            success: function(data){
                                if (data.status === 1){
                                    $('#Titm_Sal_'+lineNo).parent('td').parent('tr').remove();

                                    var Tot_Sal = 0;

                                    $('.Titm_Sal').each(function () {
                                        Tot_Sal += parseFloat($(this).val());
                                        $('.Tot_Sal').val(Tot_Sal)
                                    });
                                }
                            }
                        });
                    }


                    count +=1;
                });

                tableBody.keypress(function (e) {
                    if(e.keyCode  === 13){
                        if(tableBody.children().length === 1){
                            count = 2;
                        }

                        var Tot_Sal = 0;

                        $('.Titm_Sal').each(function () {
                            Tot_Sal += parseFloat($(this).val());
                            $('.Tot_Sal').val(Tot_Sal)
                        });

                        $.ajax({
                            url: "{{route('createNewRow')}}",
                            type: 'get',
                            dataType: 'html',
                            data:{'rowNo': tableBody.children().length+1},
                            success:function (data) {
                                tableBody.append(data)
                            }
                        });
                        count =  parseInt(tableBody.children('tr:last-child').children('td:first-child').children('input').val())+1;
                    }

                });

                $(document).on('change', '.table_body tr input, .table_body tr select',function () {
                    let lineNo = $(this).parent('td').siblings('td.delete_row').children('input').val(),
                        Tot_Sal = 0;

                    $('.Tot_ODisc').val(0);
                    $('.Tot_OPrct').val(0);
                    operationCalc($(this));

                    $('.Titm_Sal').each(function () {
                        Tot_Sal += parseFloat($(this).val());
                        $('.Tot_Sal').val(Tot_Sal)
                    });

                    $.ajax({
                        url: "{{route('createNewLine')}}",
                        type: 'post',
                        dataType: 'json',
                        data:{
                            _token:"{{csrf_token()}}",
                            Ln_No: lineNo,
                            Cmp_No: $('.Cmp_No').val(),
                            Actvty_No: $('.Actvty_No').val(),
                            Brn_No: $('.Brn_No').val(),
                            Slm_No: $('.Slm_No option:selected').val(),
                            Cstm_No: $('.Cstm_No option:selected').val(),
                            Dlv_Stor: $('.Dlv_Stor option:selected').val(),
                            Pym_No: $('.Pym_No option:selected').val(),
                            Reftyp_No: $('.Reftyp_No option:selected').val(),
                            Ref_No: $('.Ref_No option:selected').val(),
                            Doc_No: $('.Doc_No').val(),
                            Doc_Ty: $('.Doc_Ty').val(),
                            Doc_Dt: $('.Doc_Dt').val(),
                            Doc_DtAr: $('.Doc_DtAr').val(),
                            AfterDiscount: $('.AfterDiscount').val(),
                            Titm_Sal: $('.Titm_Sal').val(),
                            Itm_No: $('#Itm_No_'+lineNo).val(),
                            Unit_No: $('#Unit_No_'+lineNo).val(),
                            Loc_No: $('#Loc_No_'+lineNo).val(),
                            Qty: $('#Qty_'+lineNo).val(),
                            Itm_Sal: $('#Itm_Sal_'+lineNo).val(),
                            Exp_Date: $('#Exp_Date_'+lineNo).val(),
                            Batch_No: $('#Batch_No_'+lineNo).val(),
                            Disc1_Prct: $('#Disc1_Prct_'+lineNo).val(),
                            Disc1_Val: $('#Disc1_Val_'+lineNo).val(),

                            Taxp_ExtraDtl: $('#Taxp_ExtraDtl_'+lineNo).val(), // 2
                            Taxv_ExtraDtl: $('#Taxv_ExtraDtl_'+lineNo).val(), // 2

                            Tot_Sal: Tot_Sal, // hdr
                            Tot_Disc: $('.Tot_Disc').val(), // hdr
                            Taxv_ExtraHdr: $('.Taxv_ExtraHdr').val(), // hdr
                            Tot_Prct: $('.Tot_Prct').val(), // hdr
                            Tot_ODisc: $('.Tot_ODisc').val(), //hdr
                            Tot_OPrct: $('.Tot_OPrct').val(), //hdr
                            Net: $('.Net').val(), //hdr
                        },
                        success: function (data) {
                            if(data.status === 0){
                                $('.error_message').removeClass('hidden').html(data.message);
                                $('.success_message').addClass('hidden')
                            } else {
                                $('.success_message').removeClass('hidden').html(data.message);
                                $('.error_message').addClass('hidden');
                            }
                        }
                    });

                    localStorage.setItem('Tot_Sal', parseFloat($('.Tot_Sal').val()));
                    localStorage.setItem('Tot_Disc', $('.Tot_Disc').val());
                    localStorage.setItem('Tot_ODisc', $('.Tot_ODisc').val());
                    localStorage.setItem('AfterDiscount', parseFloat($('.AfterDiscount').val()));
                    localStorage.setItem('Taxv_ExtraHdr', $('.Taxv_ExtraHdr').val());
                    localStorage.setItem('Net', parseFloat($('.Net').val()));

                });

                function operationCalc(parameter) {
                    let lineNo = parameter.parent('td').siblings('.delete_row').children('input').val(),
                        Qty = $('#Qty_'+lineNo).val(),
                        price = $('#Itm_Sal_'+lineNo).val(),
                        Tot_Sal = 0,
                        Tot_Disc = 0,
                        Taxv_ExtraHdr = 0,
                        Titm_Sal = $('#Titm_Sal_'+lineNo),
                        Disc1_Prct = $('#Disc1_Prct_'+lineNo),
                        Disc1_Val = $('#Disc1_Val_'+lineNo),
                        Taxp_ExtraDtl = $('#Taxp_ExtraDtl_'+lineNo),
                        Taxv_ExtraDtl = $('#Taxv_ExtraDtl_'+lineNo);

                    Titm_Sal.val(Qty*price);

                    // Calc Discount value and percentage
                    if (Disc1_Prct.val() !== ''){
                        Disc1_Val.val(0);
                        Disc1_Val.val((Titm_Sal.val()*parseInt(Disc1_Prct.val()))/100);
                    }

                    var itemAfterDisc = parseFloat(Titm_Sal.val())-parseFloat(Disc1_Val.val());
                    Taxv_ExtraDtl.val(parseFloat((itemAfterDisc*Taxp_ExtraDtl.val())/100));


                    // Calc total sale
                    $('.Titm_Sal').each(function () {
                        $(this).change(function () {
                            $(this).val('');
                        });
                        Tot_Sal += parseFloat($(this).val());
                        $('.Tot_Sal').val(Tot_Sal);
                    });

                    $('.Disc1_Val').each(function () {
                        if($(this).val() !== ''){
                            Tot_Disc += parseFloat($(this).val());
                            $('.Tot_Disc').val(Tot_Disc);
                        }
                    });

                    $('.Tot_Prct').val(Math.round(parseFloat(($('.Tot_Disc').val()/$('.Tot_Sal').val())*100)))

                    // After discount
                    $('.AfterDiscount').val(parseFloat($('.Tot_Sal').val()-$('.Tot_Disc').val()-$('.Tot_ODisc').val()))

                    $('.Taxv_ExtraDtl').each(function () {
                        if($(this).val() !== ''){
                            Taxv_ExtraHdr += parseFloat($(this).val());
                        }

                        $('.Taxv_ExtraHdr').val(Taxv_ExtraHdr);
                    });

                    $('.Net').val(parseFloat($('.AfterDiscount').val())+parseFloat($('.Taxv_ExtraHdr').val()))


                }

                $('.Tot_ODisc').keyup(function () {
                    let Tot_OPrct = $('.Tot_OPrct'),
                        AfterDiscount = localStorage.getItem('AfterDiscount'),
                        Net = localStorage.getItem('Net');

                    if ($('.Tot_ODisc').val() === ''){
                        $('.AfterDiscount').val(parseFloat(AfterDiscount));
                        $('.Net').val(Net);
                        localStorage.setItem('Tot_ODisc', '');
                        $('.Tot_ODisc').val(0);
                        Tot_OPrct.val(0)
                    } else {
                        localStorage.setItem('Tot_ODisc', parseFloat($(this).val()));
                        $('.AfterDiscount').val(AfterDiscount-parseFloat($(this).val()));
                        $('.Net').val(parseFloat($('.AfterDiscount').val())+parseFloat($('.Taxv_ExtraHdr').val()));
                        Tot_OPrct.val((parseFloat($(this).val())/$('.AfterDiscount').val()).toFixed(1));
                        localStorage.setItem('Tot_ODisc', parseFloat($(this).val()));
                    }
                });

                $('.Tot_ODisc').change(function () {
                    if ($(this).val() !== ''){
                        $.ajax({
                            url: "{{route('additionalDisc')}}",
                            type: 'get',
                            dataType: 'json',
                            data:{
                                _token:"{{csrf_token()}}",
                                Doc_No: $('.Doc_No').val(),
                                Doc_Ty: $('.Doc_Ty').val(),
                                Tot_ODisc: $('.Tot_ODisc').val(), //hdr
                                Tot_Sal: $('.Tot_Sal').val(),
                                AfterDiscount: $('.AfterDiscount').val(),
                                Taxv_ExtraHdr: $('.Taxv_ExtraHdr').val(),
                                Net: $('.Net').val(),
                            },
                            success: function (data) {
                                if(data.status === 0){
                                    $('.error_message').removeClass('hidden').html(data.message);
                                    $('.success_message').addClass('hidden')
                                } else {
                                    $('.success_message').removeClass('hidden').html(data.message);
                                    $('.error_message').addClass('hidden');
                                }
                            }
                        });
                    }

                });

                $('.Cmp_No').change(function () {
                    $('.Brn_No, .Cstm_No, .Dlv_Stor').html('');
                    if($(this).val() !== ''){
                        $.ajax({
                            url: "{{route('getActivityCustomer')}}",
                            type: 'get',
                            dataType: 'json',
                            data:{Cmp_No:$('.Cmp_No option:selected').val()},
                            success:function (data) {
                                $('.Brn_No, .Cstm_No, .Dlv_Stor').html('');

                                $('.Brn_No').append("<option value=''>{{trans('admin.select')}}</option>");
                                $('.Cstm_No').append("<option value=''>{{trans('admin.select')}}</option>");

                                {{--$('.Actvty_No').html("<option value=''>{{trans('admin.select')}}</option>");--}}
                                $('.Actvty_No').html("<option value='"+data.activity_id+"'>"+data.activity_name+"</option>");

                                for (let i =0; i < data.customers.length; i++){
                                    $('.Cstm_No').append("<option value='"+data.customers[i]['Cstm_No']+"'>"+data.customers[i]['Cstm_Nm'+"{{ucfirst(session('lang'))}}"]+"</option>");
                                }


                                for (let i =0; i < data.branches.length; i++){
                                    $('.Brn_No').append("<option value='"+data.branches[i]['ID_No']+"'>"+data.branches[i]['Brn_Nm'+"{{ucfirst(session('lang'))}}"]+"</option>");
                                }
                            }
                        })
                    }
                });

                $('.Brn_No').change(function () {
                    if($(this).val()){
                        $.ajax({
                            url: "{{route('getActivityCustomer')}}",
                            type: 'get',
                            dataType: 'json',
                            data:{Brn_No:$('.Brn_No option:selected').val()},
                            success:function (data) {
                                $('.Dlv_Stor').html("<option value=''>{{trans('admin.select')}}</option>");
                                for (let i =0; i < data.stores.length; i++){
                                    $('.Dlv_Stor').append("<option value='"+data.stores[i]['ID_No']+"'>"+data.stores[i]['Dlv_Nm'+"{{ucfirst(session('lang'))}}"]+"</option>");
                                }

                                $('.Slm_No').html("<option value=''>{{trans('admin.select')}}</option>");
                                for (let i =0; i < data.salesMan.length; i++){
                                    $('.Slm_No').append("<option value='"+data.salesMan[i]['Slm_No']+"'>"+data.salesMan[i]['Slm_Nm'+"{{ucfirst(session('lang'))}}"]+"</option>");
                                }
                            }
                        })
                    }
                });

                $('.Cstm_No').change(function () {
                    $('.cstm_no_input').val($(this).val())
                });

                $('.Doc_Dt, .Credit_Days').change(function () {
                    if($('.Doc_Dt').val() !== '' &&  $('.Credit_Days').val() !== ''){
                        $.ajax({
                            url: "{{route('returnCountOfDays')}}",
                            type: 'get',
                            dataType: 'json',
                            data:{
                                DateEn: $('.Doc_Dt').val(),
                                daysNo:$('.Credit_Days').val()
                            },
                            success: function (data) {
                                $('.Pym_Dt').val(data.date)
                            }
                        });
                    }
                });

                // Create header
                $('.Cmp_No, .Actvty_No, .Brn_No, .Slm_No, .Cstm_No, .Dlv_Stor, .Doc_Dt, .Doc_DtAr, .SubCstm_Filno, .Pym_No, .Credit_Days, .Pym_Dt, .Notes, .Tax_Allow').change(function () {

                    if($(this).hasClass('Cmp_No')){$('.Actvty_No').val(null)}
                    if($(this).hasClass('Brn_No')){$('.Slm_No').val(null)}
                    if ($('.Notes').val() !== ''){
                        $.ajax({
                            url: "{{route('salesInvoices.store')}}",
                            type: 'POST',
                            dataType: 'json',
                            data:{
                                _token:"{{csrf_token()}}",
                                'requestType': 'createHeader',
                                Cmp_No: $('.Cmp_No').val(),
                                Actvty_No: $('.Actvty_No').val(),
                                Brn_No: $('.Brn_No').val(),
                                Slm_No: $('.Slm_No option:selected').val(),
                                Cstm_No: $('.Cstm_No option:selected').val(),
                                Dlv_Stor: $('.Dlv_Stor option:selected').val(),
                                Pym_No: $('.Pym_No option:selected').val(),
                                Reftyp_No: $('.Reftyp_No option:selected').val(),
                                Ref_No: $('.Ref_No option:selected').val(),
                                Doc_No: $('.Doc_No').val(),
                                Doc_Ty: $('.Doc_Ty').val(),
                                Doc_Dt: $('.Doc_Dt').val(),
                                Doc_DtAr: $('.Doc_DtAr').val(),
                                SubCstm_Filno: $('.SubCstm_Filno').val(),
                                Credit_Days: $('.Credit_Days').val(),
                                Pym_Dt: $('.Pym_Dt').val(),
                                Tax_Allow: $('input.Tax_Allow:checked').val(),
                                Notes: $('.Notes').val(),
                                // Notes1: $('.Notes1').val(),
                            },
                            success: function (data) {
                                if(data.status === 0){
                                    $('.error_message').removeClass('hidden').html(data.message);
                                    $('.success_message').addClass('hidden')
                                } else {
                                    // $('.Doc_No').val(parseInt($('.Doc_No').val())+1);
                                    $('.success_message').removeClass('hidden').html(data.message);
                                    $('.error_message').addClass('hidden');

                                    var buffer = setInterval(function () {
                                        $('.error_message, .success_message').addClass('hidden');
                                        clearInterval(buffer)
                                    }, 5000)
                                }
                            }
                        })
                    }
                });

                $(document).on('change', '.Itm_No, .itm_no_input', function () {

                    var lineNo = $(this).parent('td').siblings('.delete_row').children('input').val(),
                        Itm_No = $(this).val();

                    $('#Qty_'+lineNo).val('');
                    $('#Itm_Sal_'+lineNo).val('');
                    $('#Titm_Sal_'+lineNo).val('');
                    $('#itm_no_input_'+lineNo).val(Itm_No);

                    if (Itm_No === ''){
                        $('#Unit_No_'+lineNo).html("<option value=''>{{trans('admin.select')}}</option>");
                    }

                    if(Itm_No !== ''){
                        $.ajax({
                            url: "{{route('returnItemInfo')}}",
                            type: 'get',
                            dataType: 'json',
                            data: {
                                _token: "{{csrf_token()}}",
                                Itm_No: Itm_No,
                            },
                            success: function (data) {
                                $('#Itm_Sal_'+lineNo).val(data.price);
                                $('#Unit_No_'+lineNo).html("<option value=''>{{trans('admin.select')}}</option>");
                                for (let i =0; i < data.units.length; i++){
                                    $('#Unit_No_'+lineNo).append("<option value='"+data.units[i]['ID_No']+"'>"+data.units[i]['Unit_Nm'+"{{ucfirst(session('lang'))}}"]+"</option>");
                                }
                            }
                        })
                    }
                });

                $(document).on('change', '.Unit_No', function () {
                    var lineNo = $(this).parent('td').siblings('.delete_row').children('input').val(),
                        Itm_No = $('#Itm_No_'+lineNo).val(),
                        Unit_No = $('#Unit_No_'+lineNo).val();

                    $('#Qty_'+lineNo).val('');
                    $('#Itm_Sal_'+lineNo).val('');
                    $('#Titm_Sal_'+lineNo).val('');

                    if(Unit_No !== ''){
                        $.ajax({
                            url: "{{route('returnUnitPrice')}}",
                            type: 'get',
                            dataType: 'json',
                            data: {
                                _token: "{{csrf_token()}}",
                                Itm_No: Itm_No,
                                Unit_No: Unit_No,
                            },
                            success: function (data) {
                                $('#Itm_Sal_'+lineNo).val(data.price);
                            }
                        })
                    }


                });

                $(document).on('change', '.itm_no_input', function () {
                    let element = $(this), itmNoInput = $(this).val(),
                        selectHtml = element.parent('td').next('td').children('.Itm_No').children('option[value="'+itmNoInput+'"]'),
                        optionSelected = '<option value="'+itmNoInput+'" selected>'+selectHtml.html()+'</option>';

                    element.parent('td').next('td').children('.Itm_No').children('option[value="'+itmNoInput+'"]').removeAttr('selected');
                    if(selectHtml.html() !== undefined){
                        element.parent('td').next('td').children('.Itm_No').prepend(optionSelected);
                    } else {
                        element.parent('td').next('td').next('td').children('.Unit_No').html("<option value=''>{{trans('admin.select')}}</option>");

                    }


                    // if (selectHtml.length === 1){
                    //     $('#Acc_No_Select ul.select2-results__options').prepend(`
                    //         <li class="select2-results__option" role="treeitem" aria-selected="true" data-select2-id="`+selectHtml.val()+`">`+selectHtml.html()+`</li>
                    //     `);
                    // }

                    selectHtml.remove();

                    $.ajax({
                        url: "{{route('returnItemInfo')}}",
                        type: 'get',
                        dataType: 'json',
                        data: {
                            _token: "{{csrf_token()}}",
                            Itm_No: itmNoInput
                        },
                        success: function (data) {
                            element.parent('td').next('td').next('td').children('.Unit_No').html("<option value=''>{{trans('admin.select')}}</option>");
                            for (let i =0; i < data.units.length; i++){
                                element.parent('td').next('td').next('td').children('.Unit_No').append("<option value='"+data.units[i]['ID_No']+"'>"+data.units[i]['Unit_Nm'+"{{ucfirst(session('lang'))}}"]+"</option>");
                            }
                        }
                    })
                });
            })

        </script>
    @endpush
    @hasrole('admin')
    @can('create')

        <div class="box">

            @include('admin.layouts.message')
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <a href="" target="_blank" class="btn btn-primary pull-left print_save"><i class="fa fa-print"></i> <i class="fa fa-save"></i></a>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-danger error_message hidden"></div>
                    </div>
                    <div class="col-md-12">
                        <div class="alert alert-success success_message hidden"></div>
                    </div>
                </div>
                <input type="hidden" name="Doc_Ty" id="Doc_Ty" class="Doc_Ty" value="13">

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group" style="display: flex">
                            <label style="width: 25%" for="Cmp_No">{{trans('admin.companies')}}</label>
                            <input type="text" readonly style="background: #fff" class="form-control" value="{{$header->company->{'Cmp_Nm'.ucfirst(session('lang'))} }}">
                            <input type="hidden" name="Cmp_No" class="Cmp_No" id="Cmp_No" value="{{$header->Cmp_No}}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group" style="display: flex">
                            <label style="width: 25%" for="Actvty_No" >{{trans('admin.activity')}}</label>
                            <input type="text" readonly style="background: #fff" class="form-control" value="{{$header->company->activity->{'Name_'.ucfirst(session('lang'))} }}">
                            <input type="hidden" name="Actvty_No" class="Actvty_No" id="Actvty_No" value="{{$header->Actvty_No}}">
                        </div>
                    </div>
                </div>
                <div>
                    <div class="col-md-3">
                        <div class="form-group">
                            @php
                                $branch = $header->company->branches->where('ID_No', $header->Brn_No)->first();
                            @endphp
                            {{ Form::label('Brn_No', trans('admin.Branches') , ['class' => 'control-label']) }}
                            <input type="text" readonly style="background: #fff" class="form-control" value="{{$branch?$branch->{'Brn_Nm'.ucfirst(session('lang'))}:'' }}">
                            <input type="hidden" name="Brn_No" class="Brn_No" id="Brn_No" value="{{$header->Brn_No}}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="Slm_No" class="control-label">مندوب المبيعات</label>
                            <select name="Slm_No" id="Slm_No"  class="form-control Slm_No">
                                <option value="">{{trans('admin.select')}}</option>
                                @foreach($header->company->salesMan as $salesMan)
                                    <option @if($salesMan->Slm_No == $header->Slm_No) selected @endif value="{{$salesMan->Slm_No}}">{{$salesMan->{'Slm_Nm'.ucfirst(session('lang'))} }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="Cstm_No" class="control-label">العميل</label>
                            <select name="Cstm_No" id="Cstm_No"  class="form-control Cstm_No">
                                <option value="">{{trans('admin.select')}}</option>
                                @foreach(\App\Models\Admin\MTsCustomer::all() as $customer)
                                    <option @if($customer->Cstm_No == $header->Cstm_No) selected @endif value="{{$customer->Cstm_No}}">{{$customer->{'Cstm_Nm'.ucfirst(session('lang'))} }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="" class="control-label"> ر/فاتورة</label>
                            <input readonly style="background: #fff" type="text" name="Doc_No" id="Doc_No" class="form-control Doc_No" value="{{$header->Doc_No}}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="Dlv_Stor" class="control-label">مستودع</label>
                            <select name="Dlv_Stor" id="Dlv_Stor"  class="form-control Dlv_Stor">
                                <option value="">{{trans('admin.select')}}</option>
                                @if($header->branch)
                                    @foreach($header->branch->stores as $store)
                                        <option @if($store->ID_No == $header->Dlv_Stor) selected @endif value="{{$store->ID_No}}">{{$store->{'Dlv_Nm'.ucfirst(session('lang'))} }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="Doc_Dt" class="control-label">ميلادي</label>
                            <input type="text" name="Doc_Dt" class="form-control Doc_Dt datepicker" id="Doc_Dt" value="{{$header->Doc_Dt}}">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="" class="control-label">هجري</label>
                            <input type="text" name="Doc_DtAr"  class="form-control Doc_DtAr" value="{{$header->Doc_DtAr}}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">مستند</label>
                            <input type="text"  name="SubCstm_Filno" class="form-control SubCstm_Filno" id="SubCstm_Filno" value="{{$header->SubCstm_Filno}}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="Pym_No" class="control-label">طريقة الدفع</label>
                            <select name="Pym_No"  id="Pym_No" class="form-control Pym_No">
                                <option value="">{{trans('admin.select')}}</option>
                                @foreach(\App\Enums\PayType::toSelectArray() as $key => $type)
                                    <option  @if($key == $header->Pym_No) selected @endif value="{{$key}}">{{$type}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="Reftyp_No" class="control-label">نوع المرجع</label>
                            <select name="Reftyp_No" id="Reftyp_No" class="form-control Reftyp_No">
                                <option value="">{{trans('admin.select')}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="Ref_No" class="control-label">رقم المرجع</label>
                            <select name="Ref_No" id="Ref_No"  class="form-control Ref_No">
                                <option value="">{{trans('admin.select')}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group" style="display: flex">
                            <div style="width: 62%">
                                <label for="Credit_Days" class="control-label">مدة السداد</label>
                                <input type="text" name="Credit_Days" id="Credit_Days" class="form-control Credit_Days" placeholder="يوم" value="{{$header->Credit_Days}}">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="Pym_Dt">تاريخ السداد</label>
                            <input type="text"  style="background: #fff" name="Pym_Dt" id="Pym_Dt" class="form-control Pym_Dt" value="{{$header->Pym_Dt}}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="Tax_Allow">الضريبة المضافة</label>
                            <br>
                            <input @if($header->Tax_Allow == 1) checked @endif value="1" type="checkbox" name="Tax_Allow" id="Tax_Allow" class="checkbox-inline Tax_Allow" style="width: 20px; height: 20px;">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">ملاحظات</label>
                            <input name="Notes" id="Notes" class="form-control Notes" value="{{$header->Notes}}">
                        </div>
                    </div>
{{--                    <div class="col-md-6">--}}
{{--                        <div class="form-group">--}}
{{--                            <label for="">ملاحظات1</label>--}}
{{--                            <input name="Notes1" id="Notes1" class="form-control Notes1" value="{{$header->Notes1}}">--}}
{{--                        </div>--}}
{{--                    </div>--}}
                </div>

                {{--Start table--}}
                <div class="row items_table">
                    <div class="col-md-12" style="max-height: 300px; overflow: auto">
                        <table class="table table-bordered table-responsive">
                            <tr class="bg-aqua">
                                <th>م</th>
                                <th>رقم الصنف</th>
                                <th style="width: 13%">إسم الصنف</th>
                                <th style="width: 10%">الوحدة</th>
                                <th>رقم </th>
                                <th>الكمية</th>
                                <th>سعر البيع</th>
                                <th>إجمالي القيمة</th>
                                <th style="width: 10%;">تاريخ الصلاحية</th>
                                <th> الباتش</th>
                                <th>خصم بيع%</th>
                                <th>قيمة الخصم1</th>
                                <th>الضريبة%</th>
                                <th>قيمة الضريبة</th>
                            </tr>

                            <tbody class="table_body">
                            @if(count($header->details) > 0)
                                @foreach($header->details as $detail)
                                    <tr>
                                        <td class="delete_row bg-red"><span>{{$detail->Ln_No}}</span><input type="hidden" name="Ln_No" value="{{$detail->Ln_No}}"></td>
                                        <td><input type="text" id="itm_no_input_{{$detail->Ln_No}}" class="itm_no_input text-center" value="{{$detail->Unit_No}}"></td>
                                        <td>
                                            <select name="Itm_No" id="Itm_No_{{$detail->Ln_No}}" class="Itm_No">
                                                <option value="">{{trans('admin.select')}}</option>
                                                @foreach($items as $item)
                                                    <option @if($detail->Itm_No == $item->Itm_No) selected @endif value="{{$item->Itm_No}}">{{$item->{'Itm_Nm'.ucfirst(session('lang'))} }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <select name="Unit_No" id="Unit_No_{{$detail->Ln_No}}" class="Unit_No" >
                                                <option value="">{{trans('admin.select')}}</option>
                                                @foreach($units as $unit)
                                                    <option @if($detail->Unit_No == $unit->Unit_No) selected @endif value="{{$unit->Unit_No}}">{{$unit->{'Unit_Nm'.ucfirst(session('lang'))} }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td><input type="text" name="Loc_No" id="Loc_No_{{$detail->Ln_No}}" class="Loc_No" value="{{$detail->Loc_No}}"></td>
                                        <td><input type="number" min="1" name="Qty" id="Qty_{{$detail->Ln_No}}" class="Qty" value="{{$detail->Qty}}"></td>
                                        <td><input type="number" min="1" name="Itm_Sal" id="Itm_Sal_{{$detail->Ln_No}}" class="Itm_Sal" value="{{$detail->Itm_Sal}}"></td>
                                        <td><input type="text" id="Titm_Sal_{{$detail->Ln_No}}" class="Titm_Sal Titm_Sal" name="Titm_Sal" value="{{$detail->Titm_Sal}}"></td>
                                        <td><input type="text" name="Exp_Date" id="Exp_Date_{{$detail->Ln_No}}" class="Exp_Date datepicker" value="{{$detail->Exp_Date}}" style="padding: 0; border-radius: 0"></td>
                                        <td><input type="text" name="Batch_No" class="Batch_No" id="Batch_No_{{$detail->Ln_No}}" value="{{$detail->Batch_No}}"></td>
                                        <td><input type="text" name="Disc1_Prct" id="Disc1_Prct_{{$detail->Ln_No}}"  class="Disc1_Prct" value="{{$detail->Disc1_Prct}}"></td>
                                        <td><input type="text" name="Disc1_Val" id="Disc1_Val_{{$detail->Ln_No}}"  class="Disc1_Val" value="{{$detail->Disc1_Val}}"></td>
                                        <td><input type="text" name="Taxp_ExtraDtl" id="Taxp_ExtraDtl_{{$detail->Ln_No}}" class="Taxp_ExtraDtl" value="5"></td>
                                        <td><input type="text" name="Taxv_ExtraDtl" id="Taxv_ExtraDtl_{{$detail->Ln_No}}" class="Taxv_ExtraDtl" value="{{$detail->Taxv_ExtraDtl}}"></td>
                                    </tr>
                                @endforeach
                            @else
                                <tr class="first_row">
                                    <td class="delete_row bg-red"><span>1</span><input type="hidden" name="Ln_No" value="1"></td>
                                    <td><input type="text" id="itm_no_input_1" class="itm_no_input text-center"></td>
                                    <td>
                                        <select name="Itm_No" id="Itm_No_1" class="Itm_No">
                                            <option value="">{{trans('admin.select')}}</option>
                                            @foreach($items as $item)
                                                <option value="{{$item->Itm_No}}">{{$item->{'Itm_Nm'.ucfirst(session('lang'))} }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select name="Unit_No" id="Unit_No_1" class="Unit_No" >
                                            <option value="">{{trans('admin.select')}}</option>
                                            {{--                                @foreach($units as $unit)--}}
                                            {{--                                    <option value="{{$unit->Unit_No}}">{{$unit->{'Unit_Nm'.ucfirst(session('lang'))} }}</option>--}}
                                            {{--                                @endforeach--}}
                                        </select>
                                    </td>
                                    <td><input type="text" name="Loc_No" id="Loc_No_1" class="Loc_No"></td>
                                    <td><input type="number" min="1" name="Qty" id="Qty_1" class="Qty"></td>
                                    <td><input type="number" min="1" name="Itm_Sal" id="Itm_Sal_1" class="Itm_Sal"></td>
                                    <td><input type="text" id="Titm_Sal_1" class="Titm_Sal Titm_Sal" name="Titm_Sal"></td>
                                    <td><input type="text" name="Exp_Date" id="Exp_Date_1" class="Exp_Date datepicker" style="padding: 0; border-radius: 0"></td>
                                    <td><input type="text" name="Batch_No" class="Batch_No" id="Batch_No_1"></td>
                                    <td><input type="text" name="Disc1_Prct" id="Disc1_Prct_1" value="0" class="Disc1_Prct"></td>
                                    <td><input type="text" name="Disc1_Val" id="Disc1_Val_1" value="0" class="Disc1_Val"></td>
                                    <td><input type="text" name="Taxp_ExtraDtl" id="Taxp_ExtraDtl_1" value="5" class="Taxp_ExtraDtl"></td>
                                    <td><input type="text" name="Taxv_ExtraDtl" id="Taxv_ExtraDtl_1" value="0" class="Taxv_ExtraDtl"></td>
                                </tr>
                            @endif
                            </tbody>
                            <tfoot class="bg-primary" style="cursor: pointer">
                            {{--                <tr>--}}
                            {{--                    <td colspan="20" style="height: 40px; text-align: center"><i class="fa fa-plus"></i> <b>أضف</b></td>--}}
                            {{--                </tr>--}}
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="bill_details">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group" style="display: flex">
                                <label for="">الإجمالي</label>
                                <input type="text" value="{{$header->Tot_Sal}}" name="Tot_Sal" id="Tot_Sal" class="form-control Tot_Sal text-center">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group" style="display: flex">
                                <label for="">بعد الخصم</label>
                                <input type="text" name="AfterDiscount" value="{{$header->AfterDiscount}}" id="AfterDiscount" class="form-control AfterDiscount">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group" style="display: flex">
                                <label for="">حد الائتمان</label>
                                <input type="text" class="form-control secure_limit">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group" style="display: flex">
                                <label for="">رصيد الصنف</label>
                                <input type="text" class="form-control item_balance">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group" style="display: flex">
                                <label for="">خصم أصناف</label>
                                <input type="text" name="Tot_Disc" value="{{$header->Tot_Disc}}" id="Tot_Disc" class="form-control Tot_Disc">
                                <input style="width: 50%" type="text" name="Tot_Prct" value="0" id="Tot_Prct" class="form-control Tot_Prct">
                                <label>%</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group" style="display: flex">
                                <label for="">قيمة الضريبة</label>
                                <input type="text" name="Taxv_ExtraHdr" value="{{$header->Taxv_ExtraHdr}}" id="Taxv_ExtraHdr" class="form-control Taxv_ExtraHdr">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group" style="display: flex">
                                <label for="">الرصيد الحالي</label>
                                <input type="text" class="form-control current_balance">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group" style="display: flex">
                                <label for="">رصيد المستودعات</label>
                                <input type="text" class="form-control store_balance">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group" style="display: flex">
                                <label for="">خصم إضافي</label>
                                <input type="text" name="Tot_ODisc" value="{{$header->Tot_ODisc}}" id="Tot_ODisc" class="form-control Tot_ODisc">
                                <input style="width: 50%" type="text" name="Tot_OPrct" value="{{$header->Tot_OPrct}}" id="Tot_OPrct" class="form-control Tot_OPrct">
                                <label>%</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group" style="display: flex">
                                <label for="">الصافي</label>
                                <input type="text" value="{{$header->Net}}" name="Net" id="Net" class="form-control Net">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group" style="display: flex">
                                <label for="">الفرق</label>
                                <input type="text" class="form-control diff">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group" style="display: flex">
                                <label for="">سعر البيع</label>
                                <input type="text" class="form-control sale_price">
                            </div>
                        </div>
                    </div>
                </div>


                {{--End table--}}



                {{--        {{Form::submit(trans('admin.create'),['class'=>'btn btn-primary'])}}--}}
                {{--        {!! Form::close() !!}--}}
            </div>
        </div>
    @endcan
    @else
        <div class="alert alert-danger">{{trans('admin.you_cannt_see_invoice_because_you_dont_have_role_to_access')}}</div>

        @endhasrole







@endsection
