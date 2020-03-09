@extends('admin.index')
@section('title',trans('admin.edit_catch_receipt'))
@section('content')
    @push('js')
        <script>
            $(document).ready(function(){

                var catch_data = [],
                    old = 0,
                    Ln_No = 0;

                // convert Tr_Dt ro hijry
                let Hijri = $('input#Tr_Dt').val();
                $.ajax({
                    url: "{{route('hijri')}}",
                    type: 'get',
                    data:{Hijri: Hijri},
                    dataType: 'json',
                    success: function (data) {
                        $('#Tr_DtAr').val(data);
                    }
                });

                // $('#Acc_No_Select').select2({});
                // $('#Costcntr_No').select2({});

                //get branches and salesmen of specific company selection
                $.ajax({
                    url: "{{route('limitationBranchForEdit')}}",
                    type: "post",
                    dataType: 'html',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        Cmp_No: $('#Cmp_No').val()
                    },
                    success: function(data){
                        $('#Dlv_Stor').html(data);
                        $.ajax({
                            url: "{{route('limitationCreateTrNoN')}}",
                            type: "POST",
                            dataType: 'json',
                            data: {
                                "_token": "{{ csrf_token() }}",
                                Brn_No: $('#Dlv_Stor').val(),
                                Cmp_No: $('#Cmp_No').val()
                            },
                            success: function(data){
                                $('#Tr_No').val(data.last_no);
                                $('#Tr_No1').val(data.activity+data.company+data.branch);
                                $('.Tr_No3').val(parseInt(data.activity+data.company+data.branch+data.last_no))
                            }
                        });
                    }
                });

                //سعر الصرف حسب اختيار العمله
                $.ajax({
                    url: "{{route('getCurencyRate')}}",
                    type: "POST",
                    dataType: 'html',
                    data: {"_token": "{{ csrf_token() }}", Curncy_No: $('#Curncy_No').children('option:selected').val() },
                    success: function(data){
                        $('#Curncy_Rate').val(data);
                    }
                });

                $.ajax({
                    url: "{{route('checkSetting')}}",
                    type: "post",
                    dataType: 'json',
                    data: {"_token": "{{ csrf_token() }}", Cmp_No: $('#Cmp_No').children('option:selected').val()},
                    success: function(data){
                        if (data.settings.Foreign_Curncy === 0){
                            $('.all_about_currency').removeClass('hidden')
                        } else if(data.settings.Foreign_Curncy === 1) {
                            $('.all_about_currency').addClass('hidden')
                        }
                        if(data.settings.Alw_slmacc === 0){
                            $('.sales_man_content').removeClass('hidden');
                            $.ajax({
                                url: "{{route('limitationGetCmpSalesMen')}}", //ReceiptCatchController
                                type: "post",
                                dataType: 'html',
                                data: {"_token": "{{ csrf_token() }}", Cmp_No: $('#Cmp_No').children('option:selected').val() },
                                success: function(data){
                                    $('#Slm_No_Name').html(data);
                                    $('#Slm_No').val($('#Slm_No_Name').children('option:selected').val());
                                }
                            });
                        } if (data.settings.Foreign_Curncy === 0){
                            $('.all_about_currency').removeClass('hidden')
                        }
                    }
                });

                $('#Cmp_No').change(function(){
                    $('#Tr_No').val('');
                    $('#Tr_No1').val('');
                    $.ajax({
                        url: "{{route('limitationBranchForEdit')}}",
                        type: "POST",
                        dataType: 'html',
                        data: {"_token": "{{ csrf_token() }}", Cmp_No: $(this).val() },
                        success: function(data){
                            $('#Dlv_Stor').html(data);
                            let Brn_No = $('#Dlv_Stor').val();

                            if(Brn_No === ''){
                                Brn_No = 0;
                            } else {
                                Brn_No = $('#Dlv_Stor').val()
                            }

                            $.ajax({
                                url: "{{route('limitationCreateTrNoN')}}",
                                type: "POST",
                                dataType: 'json',
                                data: {
                                    "_token": "{{ csrf_token() }}",
                                    Brn_No: Brn_No,
                                    Cmp_No: $('#Cmp_No').val()
                                },
                                success: function(data){
                                    $('#Tr_No').val(data.last_no);
                                    $('#Tr_No1').val(data.activity+data.company+data.branch);
                                    $('.Tr_No3').val(parseInt(data.activity+data.company+data.branch+data.last_no));

                                }
                            });

                        }
                    });

                    $.ajax({
                        url: "{{route('checkSetting')}}",
                        type: "post",
                        dataType: 'json',
                        data: {"_token": "{{ csrf_token() }}", Cmp_No: $(this).val()},
                        success: function(data){
                            if (data.settings.Foreign_Curncy === 0){
                                $('.all_about_currency').removeClass('hidden')
                            } else if(data.settings.Foreign_Curncy === 1) {
                                $('.all_about_currency').addClass('hidden')
                            }
                            if(data.settings.Alw_slmacc === 0){
                                $('.sales_man_content').removeClass('hidden');
                                $.ajax({
                                    url: "{{route('limitationGetCmpSalesMen')}}", //ReceiptCatchController
                                    type: "post",
                                    dataType: 'html',
                                    data: {"_token": "{{ csrf_token() }}", Cmp_No: $('#Cmp_No').children('option:selected').val() },
                                    success: function(data){
                                        $('#Slm_No_Name').html(data);
                                        $('#Slm_No').val($('#Slm_No_Name').children('option:selected').val());
                                    }
                                });
                            } else if(data.settings.Alw_slmacc === 1){
                                $('.sales_man_content').addClass('hidden');
                            }
                        }
                    });
                });

                $('#Dlv_Stor').change(function(){
                    let Cmp_No = $('#Cmp_No option:selected').val(), Brn_No = $('#Dlv_Stor').val();
                    if(Brn_No == ''){
                        Brn_No = 0;
                    } else {
                        Brn_No = $('#Dlv_Stor').val()
                    }
                    $.ajax({
                        url: "{{route('limitationCreateTrNoN')}}",
                        type: "POST",
                        dataType: 'json',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            Brn_No: Brn_No,
                            Cmp_No: Cmp_No
                        },
                        success: function(data){
                            $('#Tr_No').val(data.last_no);
                            $('#Tr_No1').val(data.activity+''+data.company+''+data.branch);
                            $('.Tr_No3').val(data.activity+''+data.company+''+data.branch+''+data.last_no);
                        }
                    });
                });

                $('#Slm_No_Name').change(function () {
                    $('#Slm_No').val($(this).val())
                });

                $('#Curncy_No').change(function(){
                    if($('#FTot_Amunt').val() != '' && $('#Curncy_Rate').val() != ''){
                        $('#Tot_Amunt').val(parseFloat($('#Curncy_Rate').val()) * parseFloat($('#FTot_Amunt').val()));
                    }
                    $.ajax({
                        url: "{{route('getCurencyRate')}}", // ReceiptCatchController
                        type: "POST",
                        dataType: 'html',
                        data: {"_token": "{{ csrf_token() }}", Curncy_No: $(this).val() },
                        success: function(data){
                            $('#Curncy_Rate').val(data);
                        }
                    });
                });

                var debit_sum = 0, credit_sum = 0, old_credit_sum = 0, old_debit_sum = 0;

                if($('.debit').prop("checked") === true){
                    $('#Tr_Cr').attr('readonly', 'readonly').val('');
                    $('#Tr_Db').removeAttr('readonly').val($('#Tot_Amunt').val());
                    debit_sum = parseFloat($('#Tot_Amunt').val());
                    $('#debit_sum').val(old_debit_sum);

                }

                if($('.credit').prop("checked") === true){
                    $('#Tr_Db').attr('readonly', 'readonly').val('');
                    $('#Tr_Cr').removeAttr('readonly').val($('#Tot_Amunt').val());
                    credit_sum = parseFloat($('#Tot_Amunt').val());
                    $('#credit_sum').val(old_credit_sum);

                }

                $('.debit').change(function () {
                    $('#Tr_Db').removeAttr('readonly').val($('#Tot_Amunt').val());
                    $('#Tr_Cr').attr('readonly', 'readonly').val(0);
                    if($('.debit').prop("checked") === true){
                        $('#Tr_Cr').attr('readonly', 'readonly').val(0);
                        $('#Tr_Db').removeAttr('readonly').val($('#Tot_Amunt').val());
                        debit_sum = parseFloat($('#Tot_Amunt').val());
                        $('#debit_sum').val(old_debit_sum);
                    }
                });

                $('.credit').change(function () {
                    $('#Tr_Cr').removeAttr('readonly').val($('#Tot_Amunt').val());
                    $('#Tr_Db').attr('readonly', 'readonly').val(0);
                    if($('.credit').prop("checked") === true){
                        $('#Tr_Db').attr('readonly', 'readonly').val(0);
                        $('#Tr_Cr').removeAttr('readonly').val($('#Tot_Amunt').val());
                        credit_sum = parseFloat($('#Tot_Amunt').val());
                        $('#credit_sum').val(old_credit_sum);
                    }
                });

                $('#FTot_Amunt, #Curncy_Rate, #Tot_Amunt').change(function(){
                    if($('#FTot_Amunt').val() != null && $('#Curncy_Rate').val() != null || $('#Tot_Amunt').val() != null){
                        $('#Tot_Amunt').val(parseFloat($('#Curncy_Rate').val()) * parseFloat($('#FTot_Amunt').val()));

                        if($('.debit').prop("checked") === true){
                            $('#Tr_Cr').attr('readonly', 'readonly').val(0);
                            $('#Tr_Db').removeAttr('readonly').val($('#Tot_Amunt').val());
                            debit_sum = parseFloat($('#Tot_Amunt').val());
                            // $('#debit_sum').val(old_debit_sum);
                        }

                        if($('.credit').prop("checked") === true){
                            $('#Tr_Db').attr('readonly', 'readonly').val(0);
                            $('#Tr_Cr').removeAttr('readonly').val($('#Tot_Amunt').val());
                            credit_sum = parseFloat($('#Tot_Amunt').val());
                            // $('#credit_sum').val(old_credit_sum);
                        }
                    }

                });

                $('#Tr_Db, #Tr_Cr').change(function () {
                    if ($(this).val() !== ''){
                        $(''+$(this).data("db-cr")+'').attr('readonly', 'readonly');
                    } else {
                        $(''+$(this).data("db-cr")+'').removeAttr('readonly');
                    }
                });

                $('#Ac_Ty').change(function(){
                    var Cmp_No = $('#Cmp_No').children('option:selected').val();
                    var Brn_No = $('#Dlv_Stor').children('option:selected').val();
                    var Acc_Ty = $(this).val();

                    if (Acc_Ty === '2' || Acc_Ty === '3'){
                        $('.main_account_chart').removeClass('hidden');
                    } else {
                        $('.main_account_chart').addClass('hidden');
                    }

                    $('#main_acc').val('');
                    $('#Acc_No').val('');
                    $('#Sysub_Account').val('');

                    //get all leaf accounts when selecting account type (leaf acounts: customers / suppliers / employees...)
                    $.ajax({
                        url: "{{route('limitationGetSubAccN')}}",
                        type: "POST",
                        dataType: 'html',
                        data: {"_token": "{{ csrf_token() }}", Brn_No: Brn_No, Cmp_No: Cmp_No, Acc_Ty: Acc_Ty},
                        success: function(data){
                            $('#Acc_No_Select').html(data);
                        }
                    });
                });

                $('#Acc_No_Select').change(function(){
                    var Cmp_No = $('#Cmp_No').children('option:selected').val();
                    var Brn_No = $('#Dlv_Stor').children('option:selected').val();
                    var Acc_Ty = $('#Ac_Ty').children('option:selected').val();
                    var Acc_No = $(this).val();

                    if (Acc_No === 2 || Acc_No === 3){
                        $('.main_account_chart').removeClass('hidden')
                    }

                    //get parent account number on account select
                    $.ajax({
                        url: "{{route('limitationGetMainAccNoN')}}", //ReceiptCatchController
                        type: "POST",
                        dataType: 'json',
                        data: {"_token": "{{ csrf_token() }}", Brn_No: Brn_No, Cmp_No: Cmp_No, Acc_Ty: Acc_Ty, Acc_No: Acc_No },
                        success: function(data){
                            $('#Sysub_Account').val($('#Acc_No_Select').val());
                            $('#Acc_No').val(data.mainAccNo.acc_no);
                            $('#main_acc').val(data.mainAccNm.acc_name);

                            if(data.AccNm && data.AccNm.cc_flag && data.AccNm.cc_no){
                                $('.Costcntr_No_content').removeClass('hidden');
                            }
                            else{
                                $('.Costcntr_No_content').addClass('hidden');
                                $('.Costcntr_No').val(null);
                            }
                        }
                    });

                    //get salesman in case Acc_Ty == 2 (customers)
                    if(Acc_Ty == 2){
                        $.ajax({
                            url: "{{route('limitationGetSalesMan')}}", //ReceiptCatchController
                            type: "POST",
                            dataType: 'html',
                            data: {"_token": "{{ csrf_token() }}", Acc_No: Acc_No },
                            success: function(data){
                                $('#sales_man_content').html(data);
                            }
                        });
                    }
                });

                $('#Sysub_Account').change(function () {
                    let SysubAccount = $(this).val(),
                        selectHtml = $('#Acc_No_Select option[value="'+SysubAccount+'"]'),
                        optionSelected = '<option value="'+SysubAccount+'" selected>'+selectHtml.html()+'</option>';
                    $('#Acc_No_Select option:not([value="'+SysubAccount+'"])').removeAttr('selected');
                    $('#Acc_No_Select').prepend(optionSelected);
                    if (selectHtml.length === 1){
                        $('#Acc_No_Select ul.select2-results__options').prepend(`
                            <li class="select2-results__option" role="treeitem" aria-selected="true" data-select2-id="`+selectHtml.val()+`">`+selectHtml.html()+`</li>
                        `);
                    }
                    selectHtml.remove();
                });

                $('#Costcntr_No').change(function () {
                    $('#Costcntr_No_input').val($(this).val())
                });

                $('#Costcntr_No_input').change(function () {
                    let SysubAccount = $(this).val(),
                        selectHtml = $('#Costcntr_No option[value="'+SysubAccount+'"]'),
                        optionSelected = $('<option value="'+SysubAccount+'" selected>'+selectHtml.html()+'</option>');
                    $('#Costcntr_No option:not([value="'+SysubAccount+'"])').removeAttr('selected');

                    $('#Costcntr_No').prepend(optionSelected);

                    if (selectHtml.length === 1){
                        $('#Costcntr_No ul.select2-results__options').prepend(`
                            <li class="select2-results__option" role="treeitem" aria-selected="true" data-select2-id="`+selectHtml.val()+`">`+selectHtml.html()+`</li>
                        `);
                    }

                    selectHtml.remove();
                });

                //اضافة سطر فى الجدول
                var lastRow = $('table.limitation_table tbody').children('tr').length;

                $('#add_line').click(function(e){
                    e.preventDefault();

                    if($('#debit').prop('checked') === true){
                        old_debit_sum += parseFloat($('#Tot_Amunt').val());
                    }

                    if($('#credit').prop('checked') === true){
                        old_credit_sum += parseFloat($('#Tot_Amunt').val());
                    }

                    $('#credit_sum').val(old_credit_sum);
                    $('#debit_sum').val(old_debit_sum);

                    if(old_credit_sum === old_debit_sum){
                        $('#credit_debit_dif').val(0);
                    } else if(old_credit_sum > old_debit_sum){
                        $('#credit_debit_dif').val(old_credit_sum - old_debit_sum)
                    } else if(old_credit_sum < old_debit_sum){
                        $('#credit_debit_dif').val(old_debit_sum-old_credit_sum)
                    }

                    if($(this).hasClass('append_new_line')){
                        $.ajax({
                            url: "{{route('limitationValidate')}}",
                            type: "post",
                            dataType: 'json',
                            data: {
                                "_token": "{{ csrf_token() }}",
                                Cmp_No: $('#Cmp_No').val(),
                                Brn_No: $('#Dlv_Stor').val(),
                                Jr_Ty: $('#Jr_Ty').val(),
                                // Tr_No: parseInt($('#Tr_No1').val())+''+parseInt($('#Tr_No').val()),
                                Tr_No: $('#trans_no').val(),
                                Tr_Dt: $('#Tr_Dt').val(),
                                Tr_DtAr: $('#Tr_DtAr').val(),
                                Curncy_No: $('#Curncy_No').val(),
                                FTot_Amunt: $('#FTot_Amunt').val(),
                                Curncy_Rate: $('#Curncy_Rate').val(),
                                Tot_Amunt: $('#Tot_Amunt').val(),
                                Ac_Ty: $('#Ac_Ty').val(),
                                Acc_No_Select: $('#Acc_No_Select').val(),
                                Sysub_Account: $('#Sysub_Account').val(),
                                Tr_Cr: $('#Tr_Cr').val(),
                                Tr_Db: $('#Tr_Db').val(),
                                Tr_Ds: $('#Tr_Ds').val(),
                                Tr_Ds1: $('#Tr_Ds1').val(),
                                Dc_No: $('#Dc_No').val(),
                                Costcntr_No: $('#Costcntr_No').val(),
                                Acc_No: $('#Acc_No').val(),
                                Slm_No_Name: $('#Slm_No_Name').val(),
                                Slm_No: $('#Slm_No').val(),
                                last_record : $('#last_record').val(),
                                debit_sum: $('#debit_sum').val(),
                                credit_sum: $('#credit_sum').val(),
                                Ln_No: lastRow

                            },

                            success: function(data){
                                if(data.success == true){
                                    let Tr_Db = $('#Tr_Db').val(),Tr_Cr = $('#Tr_Cr').val();
                                    if(Tr_Db === ''){$('#Tr_Db').val(0.0)}
                                    if(Tr_Cr === ''){$('#Tr_Cr').val(0.0)}

                                    var trClass = '';

                                    if($('#debit').prop('checked') === true){
                                        trClass = 'debit_row';
                                    }

                                    if($('#credit').prop('checked') === true){
                                        trClass = 'credit_row';
                                    }

                                    if(trClass === ''){
                                        alert("{{trans('admin.credit_or_debit')}}");
                                        return false;
                                    }

                                    lastRow++;

                                    $('#table tbody').append(`
                                        <tr data-line-no="`+lastRow+`" class='`+trClass+ ` append_tr'>
                                            <td class="line_no">`+lastRow+`</td>
                                            <td>`+$('#Sysub_Account').val()+`</td>
                                            <td>`+$('#Acc_No_Select option:selected').html()+`</td>
                                            <td class="tr_db_td">`+Tr_Db+`</td>
                                            <td class="tr_cr_td">`+Tr_Cr+`</td>
                                            <td>`+$('#Tr_Ds').val()+`</td>
                                            <td>`+$('#Dc_No').val()+`</td>
                                            <td>`+$('#Tr_Ds1').val()+`</td>
                                        </tr>`);

                                    var rows = document.getElementById('table').rows;
                                    var debit_sum = 0;
                                    var credit_sum = 0;
                                    for (var i=1; i<rows.length; i++){
                                        if(rows[i].cells.length > 0){
                                            debit_sum += parseFloat(rows[i].cells[3].innerHTML);
                                            credit_sum += parseFloat(rows[i].cells[4].innerHTML);
                                        }
                                    }

                                    calcDbAndCrSumAndDif();

                                    var item = {
                                        Cmp_No: $('#Cmp_No').val(),
                                        Brn_No: $('#Dlv_Stor').val(),
                                        Jr_Ty: $('#Jr_Ty').val(),
                                        // Tr_No: parseInt($('#Tr_No1').val())+''+parseInt($('#Tr_No').val()),
                                        Tr_No: parseInt($('#trans_no').val()),
                                        Tr_Dt: $('#Tr_Dt').val(),
                                        Tr_DtAr: $('#Tr_DtAr').val(),
                                        Curncy_No: $('#Curncy_No').val(),
                                        FTot_Amunt: $('#FTot_Amunt').val(),
                                        Curncy_Rate: $('#Curncy_Rate').val(),
                                        Tot_Amunt: $('#Tot_Amunt').val(),
                                        Ac_Ty: $('#Ac_Ty').val(),
                                        Acc_No_Select: $('#Acc_No_Select').val(),
                                        Sysub_Account: $('#Sysub_Account').val(),
                                        Tr_Cr: $('#Tr_Cr').val(),
                                        Tr_Db: $('#Tr_Db').val(),
                                        Tr_Ds: $('#Tr_Ds').val(),
                                        Tr_Ds1: $('#Tr_Ds1').val(),
                                        Dc_No: $('#Dc_No').val(),
                                        Costcntr_No: $('#Costcntr_No').val(),
                                        Acc_No: $('#Acc_No').val(),
                                        Slm_No_Name: $('#Slm_No_Name').val(),
                                        Slm_No: $('#Slm_No').val(),
                                        last_record : $('#last_record').val(),
                                        debit_sum: $('#debit_sum').val(),
                                        credit_sum: $('#credit_sum').val(),
                                        Ln_No: lastRow
                                    };

                                    catch_data.push(item);

                                    console.log(catch_data)


                                    // $('#FTot_Amunt').val('');
                                    // $('#Tot_Amunt').val('');
                                    // $('#Ac_Ty').val('');
                                    // $('#Acc_No_Select').val('');
                                    // $('#Sysub_Account').val('');
                                    // $('#Tr_Cr').val('');
                                    // $('#Tr_Ds').val('');
                                    // $('#Tr_Ds1').val('');
                                    // $('#Dc_No').val('');
                                    // $('#Costcntr_No').val('');
                                    // $('#Acc_No').val('');
                                    // $('#Slm_No_Name').val('');
                                    // $('#Slm_No').val('');
                                    $('#Ln_No').val(-1);

                                }
                                else{
                                    $('#alert').removeClass('hidden');
                                    $('#alert').html(``);
                                    $('#alert').append(`<div class='alert alert-danger'>`+data.message+`</div>`);
                                }
                            }

                        });

                        return false
                    } else {

                        $.ajax({
                            url: "{{route('limitationValidate')}}",
                            type: "post",
                            dataType: 'json',
                            data: {
                                "_token": "{{ csrf_token() }}",
                                Cmp_No: $('#Cmp_No').val(),
                                Brn_No: $('#Dlv_Stor').val(),
                                Jr_Ty: $('#Jr_Ty').val(),
                                // Tr_No: parseInt($('#Tr_No1').val())+''+parseInt($('#Tr_No').val()),
                                Tr_No: $('#trans_no').val(),
                                Tr_Dt: $('#Tr_Dt').val(),
                                Tr_DtAr: $('#Tr_DtAr').val(),
                                Curncy_No: $('#Curncy_No').val(),
                                FTot_Amunt: $('#FTot_Amunt').val(),
                                Curncy_Rate: $('#Curncy_Rate').val(),
                                Tot_Amunt: $('#Tot_Amunt').val(),
                                Ac_Ty: $('#Ac_Ty').val(),
                                Acc_No_Select: $('#Acc_No_Select').val(),
                                Sysub_Account: $('#Sysub_Account').val(),
                                Tr_Cr: $('#Tr_Cr').val(),
                                Tr_Db: $('#Tr_Db').val(),
                                Tr_Ds: $('#Tr_Ds').val(),
                                Tr_Ds1: $('#Tr_Ds1').val(),
                                Dc_No: $('#Dc_No').val(),
                                Costcntr_No: $('#Costcntr_No').val(),
                                Acc_No: $('#Acc_No').val(),
                                Slm_No_Name: $('#Slm_No_Name').val(),
                                Slm_No: $('#Slm_No').val(),
                                last_record : $('#last_record').val(),
                                debit_sum: $('#debit_sum').val(),
                                credit_sum: $('#credit_sum').val(),
                                Ln_No: parseInt($('.active_row td.line_no').html())

                            },

                            success: function(data){
                                if(data.success === true){

                                    $('.active_row').children().each(function () {
                                        $(this).index() === 1 ? $(this).html($('#Sysub_Account').val()): '';
                                        $(this).index() === 2 ? $(this).html($('#Acc_No_Select option:selected').html()): '';
                                        $(this).index() === 3 ? $(this).html(parseFloat($('#Tr_Db').val())): '';
                                        $(this).index() === 4 ? $(this).html(parseFloat($('#Tr_Cr').val())): '';
                                        $(this).index() === 5 ? $(this).html($('#Tr_Ds').val()): '';
                                        $(this).index() === 6 ? $(this).html($('#Dc_No').val()): '';
                                        $(this).index() === 7 ? $(this).html($('#Tr_Ds1').val()): '';
                                    });


                                    let Tr_Db = $('#Tr_Db').val(),Tr_Cr = $('#Tr_Cr').val();
                                    if(Tr_Db === ''){$('#Tr_Db').val(0.0)}
                                    if(Tr_Cr === ''){$('#Tr_Cr').val(0.0)}
                                    // var trClass = '';

                                    if($('#debit').prop('checked') === true){
                                        trClass = 'debit_row';
                                    } else if($('#credit').prop('checked') === true){
                                        trClass = 'credit_row';
                                    }else {
                                        alert("{{trans('admin.credit_or_debit')}}");
                                        return false
                                    }

                                    $('.active_row').css({
                                        background: 'none',
                                        color: '#000'
                                    });

                                    // if ($('#add_line').hasClass('empty_table')){
                                    //     $('#table tbody').append(`
                                    //     <tr class='tr `+trClass+`'>
                                    //         <td>`+(parseInt($('#table tbody tr:last-child td:first-child').html())+parseInt('1'))+`</td>
                                    //         <td>`+$('#Sysub_Account').val()+`</td>
                                    //         <td>`+$('#Acc_No_Select option:selected').html()+`</td>
                                    //         <td class="tr_db_td">`+$('#Tr_Db').val()+`</td>
                                    //         <td class="tr_cr_td">`+$('#Tr_Cr').val()+`</td>
                                    //         <td>`+$('#Tr_Ds').val()+`</td>
                                    //         <td>`+$('#Dc_No').val()+`</td>
                                    //         <td>`+$('#Tr_Ds1').val()+`</td>
                                    //     </tr>`);
                                    //
                                    //     calcDbAndCrSumAndDif()
                                    //
                                    // }

                                    // $('#add_line').addClass('empty_table');

                                    var item = {
                                        Cmp_No: $('#Cmp_No').val(),
                                        Brn_No: $('#Dlv_Stor').val(),
                                        Jr_Ty: $('#Jr_Ty').val(),
                                        Tr_No: $('#trans_no').val(),
                                        Tr_Dt: $('#Tr_Dt').val(),
                                        Tr_DtAr: $('#Tr_DtAr').val(),
                                        Curncy_No: $('#Curncy_No').val(),
                                        FTot_Amunt: $('#FTot_Amunt').val(),
                                        Curncy_Rate: $('#Curncy_Rate').val(),
                                        Tot_Amunt: $('#Tot_Amunt').val(),
                                        Ac_Ty: $('#Ac_Ty').val(),
                                        Acc_No_Select: $('#Acc_No_Select').val(),
                                        Sysub_Account: $('#Sysub_Account').val(),
                                        Tr_Cr: $('#Tr_Cr').val(),
                                        Tr_Db: $('#Tr_Db').val(),
                                        Tr_Ds: $('#Tr_Ds').val(),
                                        Tr_Ds1: $('#Tr_Ds1').val(),
                                        Dc_No: $('#Dc_No').val(),
                                        Costcntr_No: $('#Costcntr_No').val(),
                                        Acc_No: $('#Acc_No').val(),
                                        Slm_No_Name: $('#Slm_No_Name').val(),
                                        Slm_No: $('#Slm_No').val(),
                                        last_record : $('#last_record').val(),
                                        debit_sum: $('#debit_sum').val(),
                                        credit_sum: $('#credit_sum').val(),
                                        Ln_No: parseInt($('.active_row td.line_no').html()),
                                        index:parseInt($('.active_row').index()) - 1
                                    };

                                    catch_data.splice(lastRow, 1)
                                    catch_data.push(item);
                                    console.log(catch_data)
                                    calcDbAndCrSumAndDif();

                                    $('.debit_row, .credit_row ').css({
                                        background: '#757272',
                                        color: '#fff'
                                    }).siblings('tr').css({
                                        background: '#ecf0f5',
                                        color: '#000'
                                    }).removeClass('active_row');

                                }
                                else{
                                    $('#alert').removeClass('hidden');
                                    $('#alert').html(``);
                                    $('#alert').append(`<div class='alert alert-danger'>`+data.message+`</div>`);
                                }
                            }

                        });
                    }

                    $(this).addClass('append_new_line');

                });

                // handle click table rows click
                // var table = document.getElementById("table");
                // if (table != null) {
                //     for (var i = 1; i < table.rows.length; i++) {
                //         for (var j = 0; j < table.rows[i].cells.length; j++){
                //             table.rows[i].onclick = function () {
                //                 tableText(this, catch_data);
                //                 // this.innerHTML = '';
                //             };
                //         }
                //     }
                // }

                //حفظ السند فى قاعدة البيانات
                $('#save').click(function(e){
                    e.preventDefault();
                    if($('#credit_debit_dif').val() !== '0'){
                        alert('القيد غير متزن');
                        return false
                    }
                    // catch_data = JSON.stringify(catch_data);
                    $.ajax({
                        url: "{{route('limitationUpdateTrns')}}",
                        type: "post",
                        dataType: 'html',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            catch_data:catch_data,
                            credit_sum: $('#credit_sum').val(),
                            debit_sum:$('#debit_sum').val(),
                            Jr_Ty: $('#Jr_Ty').val(),
                            Cmp_No: $('#Cmp_No').val(),
                            Brn_No: $('#Dlv_Stor').val(),
                            Tr_No: $('#trans_no').val(),
                        },
                        success: function(data){
                            $('#alert').removeClass('hidden');
                            $('#alert').html(`<div class='alert alert-info'>تمت الاضافة بنجاح</div>`);

                            window.location.href = "{{route('limitations.index')}}";


                            // $('#Cmp_No').val(null);
                            // $('#Dlv_Stor').val(null);
                            {{--$('#Tr_No').val(null);--}}
                            {{--// $('#Doc_Type').val(1);--}}
                            {{--$('#Curncy_No').val(1);--}}
                            {{--$('#Curncy_Rate').val(null);--}}
                            {{--$('#Tot_Amunt').val(null);--}}
                            {{--// $('#Taxp_Extra').val(null);--}}
                            {{--$('#Slm_No').val(null);--}}
                            {{--$('#Ac_Ty').val(null);--}}
                            {{--$('#Sysub_Account').val(null);--}}
                            {{--$('#Tr_Cr').val(null);--}}
                            {{--$('#Dc_No').val(null);--}}
                            {{--$('#Tr_Ds').val(null);--}}
                            {{--$('#Tr_Ds1').val(null);--}}
                            {{--$('#Acc_No').val(null);--}}
                            {{--$('#Acc_No_Select').val(null);--}}
                            {{--$('#Dc_No_Db').val(null);--}}
                            {{--$('#Tr_Ds_Db').val(null);--}}
                            {{--$('#Slm_No_Name').val(null);--}}
                            {{--$('#Rcpt_By').val(null);--}}
                            {{--$('#Tr_Db_Db').val(null);--}}
                            {{--$('#Tr_Cr_Db').val(null);--}}
                            {{--$('#FTot_Amunt').val(null);--}}
                            {{--$('#table_view').html(`<table class="table" id="table">--}}
                            {{--                        <thead>--}}
                            {{--                            <th>{{trans('admin.id')}}</th>--}}
                            {{--                            <th>{{trans('admin.account_number')}}</th>--}}
                            {{--                            <th>{{trans('admin.account_name')}}</th>--}}
                            {{--                            <th>{{trans('admin.motion_debtor')}}</th>--}}
                            {{--                            <th>{{trans('admin.motion_creditor')}}</th>--}}
                            {{--                            <th>{{trans('admin.note_ar')}}</th>--}}
                            {{--                            <th>{{trans('admin.receipt_number')}}</th>--}}
                            {{--                            <th>{{trans('admin.note_en')}}</th>--}}
                            {{--                        </thead>--}}
                            {{--                    </table>`);--}}
                        }
                    });
                });

                $(document).on('click', '#table_view tbody tr', function () {

                    $(this).addClass('active_row').siblings('tr').removeClass('active_row');
                    // $('#add_line').removeClass('empty_table')
                    $(this).css({
                        background: '#757272',
                        color: '#fff'
                    }).siblings('tr').css({
                        background: '#ecf0f5',
                        color: '#000'
                    });
                    tableText(this);
                    $('#add_line').removeClass('append_new_line')

                });

                $(document).on('dblclick', '#table_view tbody tr', function () {
                    if($(this).hasClass('append_tr')){
                        var line_index = parseInt($(this).index())-1,
                            tr_db_td = parseFloat($(this).children('.tr_db_td').html()),
                            tr_cr_td = parseFloat($(this).children('.tr_cr_td').html());

                        if($(this).hasClass('credit_row')){
                            $('#credit_sum').val(parseFloat($('#credit_sum').val())-tr_cr_td);

                        }

                        if($(this).hasClass('debit_row')){
                            $('#debit_sum').val(parseFloat($('#debit_sum').val())-tr_cr_td);
                        }

                        $('#credit_debit_dif').val(Math.abs($('#credit_sum').val() - $('#debit_sum').val()))

                        console.log(tr_cr_td);
                        console.log(tr_db_td);
                        $(this).remove();
                        catch_data.splice(line_index, 1);
                        return false
                    } else {
                        $('#delete_modal').modal()
                    }

                });

                // Delete line
                $('.delete_link').click(function(){
                    let Ln_No = $('.active_row').data('ln-no'), Tr_No = $('.hidden_tr_no').val();
                    $('#delete_modal').modal('toggle');
                    // $('#add_line').addClass('empty_table');

                    $.ajax({
                        url: "{{route('limitationDeleteTrns')}}",
                        type: 'post',
                        dataType: 'json',
                        data: {
                            _token: "{{csrf_token()}}",
                            Ln_No:Ln_No,
                            Tr_No: $('#trans_no').val(),
                        },
                        success: function(data){
                            $('#alert').removeClass('hidden').html(data.message);
                            $('.active_row').remove();
                            window.location.reload()

                        }
                    });


                });

                function tableText(tableCell) {
                    var Ln_No = parseInt(tableCell.cells[0].innerHTML), Tr_No = $('.hidden_tr_no').val();
                    $('#add_line').removeClass('hidden');
                    if(tableCell.classList[0] === 'credit_row'){
                        $('#credit').prop('checked', true);
                        $('#debit').prop('checked', false);
                        $('#Tr_Db').attr('readonly', 'readonly').val(0);
                        $('#Tr_Cr').removeAttr('readonly');
                    } else if(tableCell.classList[0] === 'debit_row'){
                        $('#debit').prop('checked', true);
                        $('#credit').prop('checked', false);
                        $('#Tr_Cr').attr('readonly', 'readonly').val(0);
                        $('#Tr_Db').removeAttr('readonly');

                    }

                    // $('.active_row').children().each(function () {
                    //
                    //
                    // });

                    tableCell.cells[1] ? $('#Sysub_Account').val(parseInt(tableCell.cells[1].innerHTML)): '';
                    tableCell.cells[2] ? $('#Acc_No_Select option:selected').html(tableCell.cells[2].innerHTML): '';
                    tableCell.cells[3] ? $('#Tr_Db').val(parseFloat(tableCell.cells[3].innerHTML)): '';
                    tableCell.cells[4] ? $('#Tr_Cr').val(parseFloat(tableCell.cells[4].innerHTML)): '';
                    tableCell.cells[5] ? $('#Tr_Ds').val(tableCell.cells[5].innerHTML): '';
                    tableCell.cells[6] ? $('#Dc_No').val(parseInt(tableCell.cells[6].innerHTML)): '';
                    tableCell.cells[7] ? $('#Tr_Ds1').val(tableCell.cells[7].innerHTML): '';



                    if(tableCell.cells[3].innerHTML !== '0'){
                        $('#Tr_Db').val(parseFloat(tableCell.cells[3].innerHTML));
                        $('#Tot_Amunt').val(parseFloat(tableCell.cells[3].innerHTML));
                        $('#FTot_Amunt').val(parseFloat(tableCell.cells[3].innerHTML)/parseFloat($('#Curncy_Rate').val()));
                    }

                    if(tableCell.cells[4].innerHTML !== '0'){
                        $('#Tr_Cr').val(parseFloat(tableCell.cells[4].innerHTML));
                        $('#Tot_Amunt').val(parseFloat(tableCell.cells[4].innerHTML));
                        $('#FTot_Amunt').val(parseFloat(tableCell.cells[4].innerHTML)/parseFloat($('#Curncy_Rate').val()));
                    }

                    if (!tableCell.classList.contains('append_tr')){
                        $.ajax({
                            url: "{{route('limitationGetRcptDetails')}}",
                            type: "post",
                            dataType: 'json',
                            data: {"_token": "{{ csrf_token() }}", Tr_No: Tr_No, Ln_No: Ln_No},
                            success: function(data){
                                // if(tableCell.classList[0] === 'credit_row'){
                                //     $('#Tot_Amunt').val(data.Tr_Cr);
                                //     $('#Tr_Cr').val(data.Tr_Cr)
                                // } else if(tableCell.classList[0] === 'debit_row'){
                                //     $('#Tot_Amunt').val(data.Tr_Db);
                                //     $('#Tr_Db').val(data.Tr_Db)
                                // }
                                // $('#FTot_Amunt').val(data.FTot_Amunt);
                                // $('#Tr_No3').val(data.Tr_No);
                                // $('#Tr_Dt').val(data.Tr_Dt);
                                // $('#Tr_DtAr').val(data.Tr_DtAr);
                                // $('#Sysub_Account').val(data.Sysub_Account);
                                // $('#Tr_Ds').val(data.Tr_Ds);
                                // $('#Tr_Ds1').val(data.Tr_Ds1);
                                // $('#Dc_No').val(data.Dc_No);
                                // $('#Costcntr_No_input').val(data.Costcntr_No);

                                var selectHtmlAcTy = $('#Ac_Ty option[value="'+data.Ac_Ty+'"]'),
                                    optionSelectedAcTy = '<option value="'+data.Ac_Ty+'" selected>'+selectHtmlAcTy.html()+'</option>';
                                $('#Ac_Ty option:not([value="'+data.Ac_Ty+'"])').removeAttr('selected');
                                $('#Ac_Ty').prepend(optionSelectedAcTy);
                                selectHtmlAcTy.remove();

                                if(data.Costcntr_No !== null){
                                    var selectHtmlCostcntrNo = $('#Costcntr_No option[value="'+data.Costcntr_No+'"]'),
                                        optionSelectedCostcntrNo = '<option value="'+data.Costcntr_No+'" selected>'+selectHtmlCostcntrNo.html()+'</option>';
                                    $('#Costcntr_No option:not([value="'+data.Costcntr_No+'"])').removeAttr('selected');
                                    $('#Costcntr_No').prepend(optionSelectedCostcntrNo);
                                    selectHtmlAcTy.remove();
                                }

                                $.ajax({
                                    url: "{{route('limitationGetSubAccN')}}",
                                    type: 'post',
                                    dataType: 'html',
                                    data:{
                                        '_token': "{{csrf_token()}}",
                                        Brn_No:data.Brn_No,
                                        Cmp_No:data.Cmp_No,
                                        Acc_Ty:data.Ac_Ty
                                    },
                                    success: function (dataOption) {
                                        var Acc_No_Select = $('#Acc_No_Select');
                                        Acc_No_Select.html(dataOption);
                                        var selectHtml = $('#Acc_No_Select option[value="'+data.Sysub_Account+'"]'),
                                            optionSelected = '<option value="'+data.Sysub_Account+'" selected>'+selectHtml.html()+'</option>';
                                        $('#Ac_Ty option:not([value="'+data.Sysub_Account+'"])').removeAttr('selected');
                                        Acc_No_Select.prepend(optionSelected);
                                        selectHtml.remove();
                                    }
                                });

                            }
                        });
                    }


                }

                function calcDbAndCrSumAndDif(){
                    var debitSum = 0, creditSum = 0;

                    $('html .tr_db_td').each(function () {
                        debitSum += parseFloat($(this).html());
                    });

                    $('html .tr_cr_td').each(function () {
                        creditSum += parseFloat($(this).html());

                    });

                    $('#debit_sum').val(debitSum);
                    $('#credit_sum').val(creditSum);

                    if(creditSum === debitSum){
                        $('#credit_debit_dif').val(0);
                    } else if(creditSum > debitSum){
                        $('#credit_debit_dif').val(creditSum - debitSum)
                    } else if(creditSum < debitSum){
                        $('#credit_debit_dif').val(debitSum-creditSum)
                    }
                }

                calcDbAndCrSumAndDif();



                /**
                 * finish to here
                 */

                $('#Dc_No').change(function(){
                    $('#Dc_No_Db').val($('#Dc_No').val());
                });

                $('#Tr_Ds').change(function(){
                    $('#Tr_Ds_Db').val($('#Tr_Ds').val());
                });

                //رقم حساب الصندوق الرئيسى
                $('#Tr_Db_Acc_No').val($('#Tr_Db_Select').children('option:selected').val());
                $('#Tr_Db_Select').change(function(){
                    $('#Tr_Db_Acc_No').val($('#Tr_Db_Select').val());
                });


                // var table = document.getElementById("table");
                // if (table != null) {
                //     for (var i = 0; i < table.rows.length; i++) {
                //         table.rows[i].onclick = function () {
                //             // if(this.cells[0].innerHTML != 1){
                //                 tableText(this);
                //
                //             // }
                //         };
                //     }
                // }
                //اضافة سطر فى الجدول في حالة حذفت كل السطور
                {{--$('.empty_table').click(function(e){--}}
                {{--    e.preventDefault();--}}

                {{--    $.ajax({--}}
                {{--        url: "{{route('limitationValidate')}}",--}}
                {{--        type: "post",--}}
                {{--        dataType: 'json',--}}
                {{--        data: {--}}
                {{--            "_token": "{{ csrf_token() }}",--}}
                {{--            Cmp_No: $('#Cmp_No').val(),--}}
                {{--            Brn_No: $('#Dlv_Stor').val(),--}}
                {{--            Jr_Ty: $('#Jr_Ty').val(),--}}
                {{--            Tr_No: parseInt($('#Tr_No1').val())+''+parseInt($('#Tr_No').val()),--}}
                {{--            Tr_Dt: $('#Tr_Dt').val(),--}}
                {{--            Tr_DtAr: $('#Tr_DtAr').val(),--}}
                {{--            Curncy_No: $('#Curncy_No').val(),--}}
                {{--            FTot_Amunt: $('#FTot_Amunt').val(),--}}
                {{--            Curncy_Rate: $('#Curncy_Rate').val(),--}}
                {{--            Tot_Amunt: $('#Tot_Amunt').val(),--}}
                {{--            Ac_Ty: $('#Ac_Ty').val(),--}}
                {{--            Acc_No_Select: $('#Acc_No_Select').val(),--}}
                {{--            Sysub_Account: $('#Sysub_Account').val(),--}}
                {{--            Tr_Cr: $('#Tr_Cr').val(),--}}
                {{--            Tr_Db: $('#Tr_Db').val(),--}}
                {{--            Tr_Ds: $('#Tr_Ds').val(),--}}
                {{--            Tr_Ds1: $('#Tr_Ds1').val(),--}}
                {{--            Dc_No: $('#Dc_No').val(),--}}
                {{--            Costcntr_No: $('#Costcntr_No').val(),--}}
                {{--            Acc_No: $('#Acc_No').val(),--}}
                {{--            Slm_No_Name: $('#Slm_No_Name').val(),--}}
                {{--            Slm_No: $('#Slm_No').val(),--}}
                {{--            last_record : $('#last_record').val(),--}}
                {{--            debit_sum: $('#debit_sum').val(),--}}
                {{--            credit_sum: $('#credit_sum').val(),--}}
                {{--            Ln_No: parseInt($('.active_row td.line_no').html())--}}

                {{--        },--}}

                {{--        success: function(data){--}}
                {{--            if(data.success === true){--}}

                {{--                $('.active_row').children().each(function () {--}}
                {{--                    $(this).index() === 1 ? $(this).html($('#Sysub_Account').val()): '';--}}
                {{--                    $(this).index() === 2 ? $(this).html($('#Acc_No_Select option:selected').html()): '';--}}
                {{--                    $(this).index() === 3 ? $(this).html(parseFloat($('#Tr_Db').val())): '';--}}
                {{--                    $(this).index() === 4 ? $(this).html(parseFloat($('#Tr_Cr').val())): '';--}}
                {{--                    $(this).index() === 5 ? $(this).html($('#Tr_Ds').val()): '';--}}
                {{--                    $(this).index() === 6 ? $(this).html($('#Dc_No').val()): '';--}}
                {{--                    $(this).index() === 7 ? $(this).html($('#Tr_Ds1').val()): '';--}}
                {{--                });--}}


                {{--                let Tr_Db = $('#Tr_Db').val(),Tr_Cr = $('#Tr_Cr').val();--}}
                {{--                if(Tr_Db === ''){$('#Tr_Db').val(0.0)}--}}
                {{--                if(Tr_Cr === ''){$('#Tr_Cr').val(0.0)}--}}
                {{--                var trClass = '';--}}

                {{--                if($('#debit').prop('checked') === true){--}}
                {{--                    trClass = 'debit_row';--}}
                {{--                } else if($('#credit').prop('checked') === true){--}}
                {{--                    trClass = 'credit_row';--}}
                {{--                }else {--}}
                {{--                    alert("{{trans('admin.credit_or_debit')}}");--}}
                {{--                    return false--}}
                {{--                }--}}

                {{--                $('.active_row').css({--}}
                {{--                    background: 'none',--}}
                {{--                    color: '#000'--}}
                {{--                });--}}

                {{--                if ($('#add_line').hasClass('empty_table')){--}}
                {{--                    var lineNo = 0;--}}
                {{--                    if($('#table tbody tr:last-child td:first-child').html() === undefined){--}}
                {{--                        lineNo = 1;--}}
                {{--                    } else {--}}
                {{--                        lineNo = (parseInt($('#table tbody tr:last-child td:first-child').html())+parseInt('1'));--}}
                {{--                    }--}}
                {{--                    $('#table tbody').append(`--}}
                {{--                <tr class='tr `+trClass+`'>--}}
                {{--                    <td class="line_no">`+lineNo+`</td>--}}
                {{--                    <td>`+$('#Sysub_Account').val()+`</td>--}}
                {{--                    <td>`+$('#Acc_No_Select option:selected').html()+`</td>--}}
                {{--                    <td class="tr_db_td">`+$('#Tr_Db').val()+`</td>--}}
                {{--                    <td class="tr_cr_td">`+$('#Tr_Cr').val()+`</td>--}}
                {{--                    <td>`+$('#Tr_Ds').val()+`</td>--}}
                {{--                    <td>`+$('#Dc_No').val()+`</td>--}}
                {{--                    <td>`+$('#Tr_Ds1').val()+`</td>--}}
                {{--                </tr>`);--}}

                {{--                    calcDbAndCrSumAndDif()--}}

                {{--                }--}}

                {{--                var item = {--}}
                {{--                    Cmp_No: $('#Cmp_No').val(),--}}
                {{--                    Brn_No: $('#Dlv_Stor').val(),--}}
                {{--                    Jr_Ty: $('#Jr_Ty').val(),--}}
                {{--                    Tr_No: parseInt($('#Tr_No1').val())+''+parseInt($('#Tr_No').val()),--}}
                {{--                    Tr_Dt: $('#Tr_Dt').val(),--}}
                {{--                    Tr_DtAr: $('#Tr_DtAr').val(),--}}
                {{--                    Curncy_No: $('#Curncy_No').val(),--}}
                {{--                    FTot_Amunt: $('#FTot_Amunt').val(),--}}
                {{--                    Curncy_Rate: $('#Curncy_Rate').val(),--}}
                {{--                    Tot_Amunt: $('#Tot_Amunt').val(),--}}
                {{--                    Ac_Ty: $('#Ac_Ty').val(),--}}
                {{--                    Acc_No_Select: $('#Acc_No_Select').val(),--}}
                {{--                    Sysub_Account: $('#Sysub_Account').val(),--}}
                {{--                    Tr_Cr: $('#Tr_Cr').val(),--}}
                {{--                    Tr_Db: $('#Tr_Db').val(),--}}
                {{--                    Tr_Ds: $('#Tr_Ds').val(),--}}
                {{--                    Tr_Ds1: $('#Tr_Ds1').val(),--}}
                {{--                    Dc_No: $('#Dc_No').val(),--}}
                {{--                    Costcntr_No: $('#Costcntr_No').val(),--}}
                {{--                    Acc_No: $('#Acc_No').val(),--}}
                {{--                    Slm_No_Name: $('#Slm_No_Name').val(),--}}
                {{--                    Slm_No: $('#Slm_No').val(),--}}
                {{--                    last_record : $('#last_record').val(),--}}
                {{--                    debit_sum: $('#debit_sum').val(),--}}
                {{--                    credit_sum: $('#credit_sum').val(),--}}
                {{--                    Ln_No: parseInt($('.active_row td.line_no').html()),--}}
                {{--                    index:parseInt($('.active_row').index()) - 1--}}
                {{--                };--}}

                {{--                catch_data[item.index] = item;--}}

                {{--                calcDbAndCrSumAndDif();--}}

                {{--                // handle click table rows click--}}
                {{--                var table = document.getElementById("table");--}}
                {{--                if (table != null) {--}}
                {{--                    for (var i = 1; i < table.rows.length; i++) {--}}
                {{--                        for (var j = 0; j < table.rows[i].cells.length; j++){--}}
                {{--                            table.rows[i].onclick = function () {--}}
                {{--                                tableText(this, catch_data);--}}
                {{--                                this.innerHTML = '';--}}
                {{--                            };--}}
                {{--                        }--}}
                {{--                    }--}}
                {{--                }--}}

                {{--            }--}}
                {{--            else{--}}
                {{--                $('#alert').removeClass('hidden');--}}
                {{--                $('#alert').html(``);--}}
                {{--                $('#alert').append(`<div class='alert alert-danger'>`+data.message+`</div>`);--}}
                {{--            }--}}
                {{--        }--}}

                {{--    });--}}

                {{--});--}}




            });
        </script>
    @endpush
    <div class="alert row hidden" id="alert">
        <div class="col-md-12">
            <div class="alert-info">asdasda</div>
        </div>
    </div>
    <form action="{{route('rcatchs.update', $gl->Tr_No)}}" method="POST" id="create_cache">
        {{ csrf_field() }}
        {{ method_field('PUT') }}

        <div style="display:flex; justify-content: flex-end; margin-bottom: 10px">
            <div>
                {{--            <a data-toggle="modal" href="#delete_modal" class="btn btn-danger" id="delete_button"><i class="fa fa-trash-o" aria-hidden="true"></i></a>--}}
                <button type="submit" class="btn btn-primary"  id="save"><i class="fa fa-floppy-o"></i></button>
            </div>
        </div>
        <input type="hidden" name="Tr_No" id="trans_no" class="trans_no" value="{{$gl->Tr_No}}">

        {{-- header start --}}
        {{-- بداية القيود اليومية --}}
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="panel-title">
                    {{trans('admin.create_limitations')}}
                </div>
            </div>
            <div class="panel-body">
                {{-- الشركه --}}
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="Cmp_No">{{trans('admin.company')}}</label>
                        <select name="Cmp_No" id="Cmp_No" class="form-control" disabled>
                            @if(count($companies) > 0)
                                @foreach($companies as $cmp)
                                    <option @if($cmp->Cmp_No == $gl->Cmp_No) selected @endif value="{{$cmp->Cmp_No}}">{{$cmp->{'Cmp_Nm'.ucfirst(session('lang'))} }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                {{-- نهاية الشركه --}}

                {{-- الفرع --}}
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="Dlv_Stor">{{trans('admin.section')}}</label>
                        <div id="Brn_No_content">
                            <select name="Dlv_Stor" id="Dlv_Stor" class="form-control" disabled>
                                <option value="{{null}}">{{trans('admin.select')}}</option>
                            </select>
                        </div>
                    </div>
                </div>
                {{-- نهاية الفرع --}}

                {{-- نوع القيد --}}
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="Jr_Ty">{{trans('admin.Jr_Ty')}}</label>
                        <input type="text"  class="form-control" value="{{\App\Models\Admin\GLAstJrntyp::where('Jr_Ty','6')->first()->{'Jrty_Nm'.ucfirst(session('lang'))} }}" readonly>
                        <input type="hidden" id="Jr_Ty" name="Jr_Ty" class="Jr_Ty" value="{{\App\Models\Admin\GLAstJrntyp::where('Jr_Ty','6')->first()->Jr_Ty}}">
                    </div>
                </div>
                {{-- نهاية نوع القيد --}}

                {{-- رقم القيد --}}
                <div class="col-md-2">
                    <label for="Tr_No">{{trans('admin.Tr_No')}}</label>
                    <div class="form-group" style="display: flex">
                        <input type="text" name="" id="Tr_No" value="" class="form-control" disabled>
                        <input type="text" name="" id="Tr_No1" value="" class="form-control" disabled>
                        <input type="hidden" name="Tr_No" id="Tr_No3" class="Tr_No3" value="">
                    </div>

                </div>
                {{-- نهاية رقم القيد --}}

                {{-- تاريخ القيد --}}
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="Tr_Dt">{{trans('admin.receipt_date')}}</label>
                        <input type="text" name="Tr_Dt" id="Tr_Dt" class="form-control" value="{{Carbon\Carbon::now()->format('Y-m-d')}}" readonly>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="Tr_DtAr">{{trans('admin.higri_date')}}</label>
                        <input type="text" name="Tr_DtAr" id="Tr_DtAr" class="form-control" readonly>
                    </div>
                </div>
                {{-- نهاية تاريخ القيد --}}
                {{-- مندوب المبيعات --}}
                <div id="sales_man_content" class="sales_man_content hidden">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="Slm_No_Name">{{trans('admin.sales_officer2')}}</label>
                            <select name="Slm_No_Name" id="Slm_No_Name" class="form-control" disabled></select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="Slm_No">{{trans('admin.Slm_No')}}</label>
                            <input type="text" name="Slm_No" id="Slm_No" class="form-control" disabled>
                        </div>
                    </div>
                </div>
                {{-- نهاية مندوب المبيعات --}}
                <div class="col-md-12">
                    <div class="panel panel-primary">
                        <div class="panel-body">
                            <div class="row">
                                {{-- العمله --}}
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="Curncy_No">{{trans('admin.currency')}}</label>
                                        <select name="Curncy_No" id="Curncy_No" class="form-control">
                                            @foreach($crncy as $crn)
                                                <option value="{{$crn->Curncy_No}}">{{$crn->{'Curncy_Nm'.ucfirst(session('lang'))} }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                {{-- نهاية العمله --}}
                                {{-- المبلغ بالعمله الاجنبيه --}}
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="FTot_Amunt">{{trans('admin.Linv_Net')}}</label>
                                        <input type="text" name="FTot_Amunt" id="FTot_Amunt" class="form-control">
                                    </div>
                                </div>
                                {{-- نهاية المبلغ بالعمله الاجنبيه --}}
                                {{-- سعر الصرف --}}
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="Curncy_Rate">{{trans('admin.exchange_rate')}}</label>
                                        <input type="text" name="Curncy_Rate" id="Curncy_Rate" class="form-control">
                                    </div>
                                </div>
                                {{-- نهاية سعر الصرف --}}
                                {{-- المبلغ المطلوب --}}
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="Tot_Amunt">{{trans('admin.amount')}}</label>
                                        <input type="text" name="Tot_Amunt" id="Tot_Amunt" class="form-control">
                                    </div>
                                </div>
                                {{-- نهاية المبلغ المطلوب --}}

                                {{--دائن ومدين --}}
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="debit">{{trans('admin.Fbal_Db_')}}</label>
                                        <input type="radio" name="cr_db" id="debit" class="debit">
                                        <label for="credit">{{trans('admin.Fbal_CR_')}}</label>
                                        <input type="radio" name="cr_db" id="credit" class="credit">
                                    </div>
                                </div>
                                {{--نهاية الدائن والمدين--}}
                            </div>
                            {{-- الحساب الرئيسى --}}
                            <div class="main_account_chart row hidden">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="main_acc">{{trans('admin.main_account_chart')}}</label>
                                        <input type="text" name="main_acc" id="main_acc" class="form-control" disabled>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for=Tot_Amunt"Acc_No">{{trans('admin.Acc_No')}}</label>
                                        <input type="text" name="Acc_No" id="Acc_No" class="form-control" disabled>
                                    </div>
                                </div>
                            </div>
                            {{-- نهاية الحساب الرئيسى --}}
                            {{-- نوع الحساب --}}
                            {{-- نوع الحساب عملاء - موردين - موظفين - .... --}}
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="Ac_Ty">{{trans('admin.account_type')}}</label>
                                        <select name="Ac_Ty" id="Ac_Ty" class="form-control">
                                            <option value="{{null}}">{{trans('admin.select')}}</option>
                                            @foreach(\App\Enums\AccountType::toSelectArray() as $key => $value)
                                                <option value="{{$key}}">{{$value}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                {{-- رقم حساب العملاء - رقم حساب الموظفين - رقم حساب الموردين - .... --}}
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="Acc_No_Select">{{trans('admin.account_name')}}</label>
                                        <select name="Acc_No_Select" id="Acc_No_Select" class="form-control select2">
                                            <option value="{{null}}">{{trans('admin.select')}}</option>
                                        </select>
                                    </div>
                                </div>
                                {{-- رقم العميل - رقم المورد - رقم الموظف --}}
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="Sysub_Account">{{trans('admin.account_number')}}</label>
                                        <input type="text" name="Sysub_Account" id="Sysub_Account" class="form-control">
                                    </div>
                                </div>
                                {{-- نهاية نوع الحساب --}}

                                {{-- المبلغ مدين --}}
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="Tr_Db">{{trans('admin.amount_db')}}</label>
                                        <input data-db-cr="#Tr_Cr" type="text" name="Tr_Db" id="Tr_Db" class="form-control">
                                    </div>
                                </div>
                                {{-- نهاية المبلغ مدين --}}
                                {{-- المبلغ دائن --}}
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="Tr_Cr">{{trans('admin.amount_cr')}}</label>
                                        <input data-db-cr="#Tr_Db" type="text" name="Tr_Cr" id="Tr_Cr" class="form-control">
                                    </div>
                                </div>
                                {{-- نهاية المبلغ دائن --}}
                            </div>
                            {{--جمع المدين والداين والفرق بينهما--}}
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <p>{{trans('admin.receipt_total')}}</p>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input id="debit_sum" type="text" name="debit_sum" class="form-control" placeholder="{{trans('admin.Fbal_Db_')}}" value="0">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input id="credit_sum" type="text" name="credit_sum" class="form-control" placeholder="{{trans('admin.Fbal_CR_')}}" value="0">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input id="credit_debit_dif" type="text" name="" class="form-control" placeholder="{{trans('admin.subtract')}}" value="0">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{--نهاية جمع المدين والداين والفرق بينهما--}}
                            <div class="row">
                                {{-- البيان عربى --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="Tr_Ds" id="Tr_Ds" class="form-control" placeholder="{{trans('admin.Statement_ar')}}">
                                    </div>
                                </div>
                                {{-- نهاية البيان عربى --}}
                                {{-- البيان انجليزى --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="Tr_Ds1" id="Tr_Ds1" class="form-control" placeholder="{{trans('admin.Statement_en')}}">
                                    </div>
                                </div>
                                {{-- نهاية البيان انجليزى --}}
                            </div>

                            <div class="row">
                                {{-- رقم المستند --}}
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="Dc_No">{{trans('admin.receipt_number')}}</label>
                                        <input type="text" name="Dc_No" id="Dc_No" class="form-control">
                                    </div>
                                </div>
                                {{-- نهاية رقم المستند --}}
                                {{-- مركز التكلفه --}}
                                <div class="col-md-6 Costcntr_No_content" id="Costcntr_No_content">
                                    <div class="form-group">
                                        <label for="Costcntr_No">{{trans('admin.with_cc')}}</label>
                                        <select name="Costcntr_No" id="Costcntr_No" class="form-control">
                                            <option value="{{null}}">{{trans('admin.select')}}</option>
                                            @if(count($cost_center) > 0)
                                                @foreach($cost_center as $cc)
                                                    <option value="{{$cc->Costcntr_No}}">{{ $cc->{'Costcntr_Nm'.session('lang')} }}</option>
                                                @endforeach
                                            @endif
                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-2 Costcntr_No_content">
                                    <div class="form-group">
                                        <label for="Costcntr_No_input">{{trans('admin.costcntr_no_input')}}</label>
                                        <input id="Costcntr_No_input" type="text" name="" class="form-control Costcntr_No_input">
                                    </div>
                                </div>
                                {{-- نهاية مركز التكلفه --}}

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <a style="margin-top: 19.2%" href="#" id="add_line" class="form-control btn btn-primary append_new_line">{{trans('admin.add_line')}}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- نهاية القيود اليومية --}}

        {{-- عرض السطور --}}
        <div class="row">
            <div class="col-md-12" id="table_view">
                <table class="table limitation_table" id="table" style="cursor: pointer;">
                    <thead>
                    <th>{{trans('admin.Ln_No')}}</th>
                    <th>{{trans('admin.account_number')}}</th>
                    <th>{{trans('admin.account_name')}}</th>
                    <th>{{trans('admin.motion_debtor')}}</th>
                    <th>{{trans('admin.motion_creditor')}}</th>
                    <th>{{trans('admin.note_ar')}}</th>
                    <th>{{trans('admin.receipt_number')}}</th>
                    <th>{{trans('admin.note_en')}}</th>
                    </thead>
                    <tbody>

                    @if(count($gltrns) > 0)
                        <input type="hidden" class="hidden_tr_no" value="{{$gltrns->first()->Tr_No}}">
                        @foreach($gltrns as $trns)
                            <tr data-ln-no="{{$trns->Ln_No}}" class="@if($trns->Tr_Db == '0.0'){{'credit_row'}}@else{{'debit_row'}}@endif">
                                <td class="line_no">{{$trns->Ln_No}}</td>
                                <td>{{$trns->Sysub_Account == 0 ? $trns->Acc_No : $trns->Sysub_Account}}</td>
                                <td>
                                    @if($trns->Ac_Ty == 1)
                                        {{\App\Models\Admin\MtsChartAc::where('Acc_No', $trns->Sysub_Account)->first()->{'Acc_Nm'.ucfirst(session('lang'))} }}
                                    @endif
                                    @if($trns->Ac_Ty == 2)
                                        {{\App\Models\Admin\MTsCustomer::where('Cstm_No', $trns->Sysub_Account)->first()->{'Cstm_Nm'.ucfirst(session('lang'))} }}
                                    @endif
                                    @if($trns->Ac_Ty == 3)
                                        {{\App\Models\Admin\MtsSuplir::where('Sup_No', $trns->Sysub_Account)->first()->{'Sup_Nm'.ucfirst(session('lang'))} }}
                                    @endif
                                    @if($trns->Ac_Ty == 4)
{{--                                        {{\App\Models\Admin\MTsCustomer::where('Cstm_No', $trns->Sysub_Account)->first()->{'Cstm_Nm'.ucfirst(session('lang'))} }}--}}
                                    @endif
                                </td>
                                <td class="tr_db_td">{{$trns->Tr_Db}}</td>
                                <td class="tr_cr_td">{{$trns->Tr_Cr}}</td>
                                <td>{{$trns->Tr_Ds}}</td>
                                <td>{{$trns->Dc_No}}</td>
                                <td>{{$trns->Tr_Ds1}}</td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
        {{-- نهاية عرض السطور --}}
    </form>
    <div class="modal fade" id="delete_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">{{trans('admin.Delete_Record')}}</h4>
                </div>
                <div class="modal-body">
                    {{trans('admin.You_Want_You_Sure_Delete_This_Record')}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-right" data-dismiss="modal">{{trans('admin.close')}}</button>
                    <button type="button" class="btn btn-danger delete_link">{{trans('admin.delete')}}</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection
