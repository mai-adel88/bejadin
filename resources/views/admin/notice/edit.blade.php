@extends('admin.index')
@section('title',trans('admin.edit_noti'))
@section('content')
    @push('css')
        <style>
            .panel-H{
                border-color: #26333a !important;
            }
            .panel-A {
                background-color: #26333a !important;
                border-color: #26333a !important;
            }
        </style>

    @endpush
    @push('js')
        <script>
            $(document).ready(function(){
                $('#Acc_No_Select').select2({});

                var catch_data = [];
                var old = 0;
                var Ln_No = 1;
                var tax = false;

                var Cmp_No = $('#Cmp_No').children('option:selected').val();
                var id = $('#id').val();
                //get branches of specific company selection
                $.ajax({
                    url: "{{route('branchForEdit')}}",
                    type: "POST",
                    dataType: 'html',
                    data: {"_token": "{{ csrf_token() }}", Cmp_No: Cmp_No, id: id },
                    success: function(data){
                        $('#Dlv_Stor').html(data);
                    }
                });
                //get tax value of selected company
                $.ajax({
                    url: "{{route('getTaxValueN')}}",
                    type: "POST",
                    dataType: 'html',
                    data: {"_token": "{{ csrf_token() }}", Cmp_No: Cmp_No },
                    success: function(data){
                        $('#Taxp_Extra').val(data);
                    }
                });

                $.ajax({
                    url: "{{route('getCurencyRateN')}}",
                    type: "POST",
                    dataType: 'html',
                    data: {"_token": "{{ csrf_token() }}", Curncy_No: $('#Curncy_No').children('option:selected').val() },
                    success: function(data){
                        $('#Curncy_Rate').val(data);
                        if($('#FTot_Amunt').val() && $('#Curncy_Rate').val()){
                            $('#Tot_Amunt').val(parseFloat($('#Curncy_Rate').val()) * parseFloat($('#FTot_Amunt').val()));
                            calcTax();
                            $('#Tr_Db_Db').val(parseFloat(old) + parseFloat($('#Tr_Cr').val()));
                            $('#Tr_Cr_Db').val(parseFloat(old) + parseFloat($('#Tr_Cr').val()));
                            $('#Tr_Dif').val( $('#Tr_Db_Db').val() - $('#Tr_Cr_Db').val() );
                        }
                    }
                });

                var Jr_Ty = $('#Jr_Ty').attr('val');
                if(Jr_Ty === '19'){
                    $('.panel_2').html('بيانات حساب دائن');
                    $('.panel_1').html('بيانات حساب المدين');
                    $('#label_db_cr').html('خصم مسموح به ');
                    $('#label_Tr_Cr').html('المبلغ الدائن');
                } else if(Jr_Ty === '18') {
                    $('.panel_2').html('بيانات حساب المدين');
                    $('.panel_1').html('بيانات حساب الدائن');
                    $('#label_db_cr').html('خصم مكتسب ');
                    $('#label_Tr_Cr').html('المبلغ المدين');
                }

                $(document).on('change', '#Cmp_No', function(){
                    //get branches of specific company selection
                    $.ajax({
                        url: "{{route('branchForEdit')}}",
                        type: "POST",
                        dataType: 'html',
                        data: {"_token": "{{ csrf_token() }}", Cmp_No: $(this).val() },
                        success: function(data){
                            $('#Dlv_Stor').html(data);
                        }
                    });
                    //get tax value of selected company
                    $.ajax({
                        url: "{{route('getTaxValue')}}",
                        type: "POST",
                        dataType: 'html',
                        data: {"_token": "{{ csrf_token() }}", Cmp_No: $(this).val() },
                        success: function(data){
                            $('#Taxp_Extra').val(data);
                        }
                    });
                });

                //get salesmen of specific branch selection
                $.ajax({
                    url: "{{route('getCmpSalesMenN')}}",
                    type: "POST",
                    dataType: 'html',
                    data: {"_token": "{{ csrf_token() }}", Cmp_No: $('#Cmp_No').children('option:selected').val() },
                    success: function(data){
                        $('#Slm_No_Name').html(data);
                        $('#Slm_No').val($('#Slm_No_Name').children('option:selected').val());
                    }
                });

                // //get salesmen of specific branch selection
                // $('#Slm_No').val($('#Slm_No_Name').children('option:selected').val());

                $(document).on('change', '#Ac_Ty', function(){
                    var Cmp_No = $('#Cmp_No').children('option:selected').val();
                    var Brn_No = $('#Dlv_Stor').children('option:selected').val();
                    var Acc_Ty = $(this).val();

                    //get all leaf accounts when selecting account type (leaf acounts: customers / suppliers / employees...)
                    $.ajax({
                        url: "{{route('getSubAccN')}}",
                        type: "POST",
                        dataType: 'html',
                        data: {"_token": "{{ csrf_token() }}", Brn_No: Brn_No, Cmp_No: Cmp_No, Acc_Ty: Acc_Ty},
                        success: function(data){
                            $('#Acc_No_Select').html(data);
                        }
                    });
                });

                $(document).on('change', '#Acc_No_Select', function(){
                    var Cmp_No = $('#Cmp_No').children('option:selected').val();
                    var Brn_No = $('#Dlv_Stor').children('option:selected').val();
                    var Acc_Ty = $('#Ac_Ty').children('option:selected').val();
                    var Acc_No = $(this).val();

                    //get parent account number on account select
                    $.ajax({
                        url: "{{route('getMainAccNoN')}}",
                        type: "POST",
                        dataType: 'json',
                        data: {"_token": "{{ csrf_token() }}", Brn_No: Brn_No, Cmp_No: Cmp_No, Acc_Ty: Acc_Ty, Acc_No: Acc_No },
                        success: function(data){
                            $('#Sysub_Account').val($('#Acc_No_Select').val());
                            $('#Acc_No').val(data.mainAccNo.acc_no);
                            $('#main_acc').val(data.mainAccNm.acc_name);

                            if(data.AccNm && data.AccNm.cc_flag && data.AccNm.cc_no){
                                $('#Costcntr_No_content').removeClass('hidden');
                            }
                            else{
                                $('#Costcntr_No_content').addClass('hidden');
                                $('#Costcntr_No').val(null);
                            }
                        }
                    });

                    //get salesman in case Acc_Ty == 2 (customers)
                    if(Acc_Ty == 2){
                        $.ajax({
                            url: "{{route('getSalesManN')}}",
                            type: "POST",
                            dataType: 'html',
                            data: {"_token": "{{ csrf_token() }}", Acc_No: Acc_No },
                            success: function(data){
                                $('#Slm_No_Name').html(data);
                            }
                        });
                    }
                });


                // handle click table rows click
                var table = document.getElementById("table");
                if (table != null) {
                    for (var i = 0; i < table.rows.length; i++) {
                        table.rows[i].onclick = function () {
                            if(this.cells[0].innerHTML != 1){
                                tableText(this);
                                this.innerHTML = '';
                            }
                        };
                    }
                }
                function tableText(tableCell) {

                    var row = tableCell;
                    var Ln_No = tableCell.cells[0].innerHTML;
                    var Tr_No = $('#Tr_No').val();
                    var Jr_Ty = $('#Jr_Ty').attr('val');

                    if(Jr_Ty == 18){
                        var updated_sum = parseFloat($('#Tr_Db_Db').val()) - parseFloat(tableCell.cells[4].innerHTML);
                    }else if(Jr_Ty == 19){
                        var updated_sum = parseFloat($('#Tr_Cr_Db').val()) - parseFloat(tableCell.cells[3].innerHTML);
                    }
                    old = updated_sum;
                    $('#Tr_Db_Db').val(updated_sum);
                    $('#Tr_Cr_Db').val(updated_sum);

                    if(Ln_No != 1){
                        $.ajax({
                            url: "{{route('getRcptDetailsN')}}",
                            type: "POST",
                            dataType: 'html',
                            data: {"_token": "{{ csrf_token() }}", Tr_No: Tr_No, Ln_No: Ln_No},
                            success: function(data){
                                $('#credit_data').html(data);
                                $('#Tot_Amunt').val($('#Tr_Cr').val());
                                $('#Slm_No').val($('#getSalNo').val());
                                $('#Cmp_No').removeAttr('disabled');
                                $('#Brn_No').removeAttr('disabled');
                                $('#Dlv_Stor').removeAttr('disabled');
                                $('#Tr_Dt').removeAttr('disabled');
                                $('#Tr_DtAr').removeAttr('disabled');
                                $('#Doc_Type').removeAttr('disabled');
                                $('#Curncy_No').removeAttr('disabled');
                                $('#FTot_Amunt').removeAttr('disabled');
                                $('#Curncy_Rate').removeAttr('disabled');
                                $('#Tot_Amunt').removeAttr('disabled');
                                $('#Taxp_Extra_check').removeAttr('disabled');
                                if($('#create_cache :checkbox[id=Taxp_Extra_check]').is(':checked')){
                                    $('#Taxp_Extra').removeAttr('disabled');
                                }
                                $('#Rcpt_By').removeAttr('disabled');
                                $('#Slm_No_Name').removeAttr('disabled');
                            }
                        });
                    }
                }

                //add tax
                $('#create_cache :checkbox[id=Taxp_Extra_check]').change(function(){
                    if($(this).is(':checked')){
                        $('#Taxp_Extra').removeAttr('disabled');
                        calcTax();
                    }
                    else{
                        $('#Taxp_Extra').attr('disabled','disabled');
                        // $('#Taxp_Extra').val(null);
                        $('#Tr_Cr').val($('#Tot_Amunt').val());
                        $('#Taxv_Extra').val(parseFloat($('#Tr_Cr').val()) - parseFloat($('#Tot_Amunt').val()));
                    }

                    $('#Tr_Db_Db').val(parseFloat(old) + parseFloat($('#Tr_Cr').val()));
                    $('#Tr_Cr_Db').val(parseFloat(old) + parseFloat($('#Tr_Cr').val()));
                    $('#Tr_Dif').val( $('#Tr_Db_Db').val() - $('#Tr_Cr_Db').val() );
                });

                $('#Tot_Amunt').change(function(){
                    calcTax();
                    $('#Tr_Db_Db').val(parseFloat(old) + parseFloat($('#Tr_Cr').val()));
                    $('#Tr_Cr_Db').val(parseFloat(old) + parseFloat($('#Tr_Cr').val()));
                    $('#Tr_Dif').val( $('#Tr_Db_Db').val() - $('#Tr_Cr_Db').val() );
                });

                $('#Taxp_Extra').change(function(){
                    calcTax();

                    $('#Tr_Db_Db').val(parseFloat(old) + parseFloat($('#Tr_Cr').val()));
                    $('#Tr_Cr_Db').val(parseFloat(old) + parseFloat($('#Tr_Cr').val()));
                    $('#Tr_Dif').val( $('#Tr_Db_Db').val() - $('#Tr_Cr_Db').val() );
                });

                $(document).on('change', '#Dc_No', function(){
                    $('#Dc_No_Db').val($('#Dc_No').val());
                });

                $(document).on('change', '#Tr_Ds', function(){
                    $('#Tr_Ds_Db').val($('#Tr_Ds').val());
                });

                //رقم حساب الصندوق الرئيسى
                $('#Tr_Db_Acc_No').val($('#Tr_Db_Select').children('option:selected').val());
                $('#Tr_Db_Select').change(function(){
                    $('#Tr_Db_Acc_No').val($('#Tr_Db_Select').val());
                });

                //اضافة سطر فى الجدول
                $(document).on('click', '#add_line', function(e){
                    e.preventDefault();

                    if($('#create_cache :checkbox[id=Taxp_Extra_check]').is(':checked')){
                        tax = true
                    }
                    else{
                        tax = false;
                    }

                    if($('#Ln_No').val() == -1){
                        Ln_No = Ln_No + 1;
                        $('#Ln_No').val(Ln_No);
                    }

                    $.ajax({
                        url: "{{route('validateCacheN')}}",
                        type: "post",
                        dataType: 'html',
                        data: {"_token": "{{ csrf_token() }}",Brn_No: $('#Dlv_Stor').children('option:selected').val(),
                            Cmp_No: $('#Cmp_No').children('option:selected').val(),
                            Tr_No: $('#Tr_No').val(),
                            Tr_Dt: $('#Tr_Dt').val(),
                            Tr_DtAr: $('#Tr_DtAr').val(),
                            Doc_Type: $('#Doc_Type').children('option:selected').val(),
                            Curncy_No: $('#Curncy_No').children('option:selected').val(),
                            Curncy_Rate: $('#Curncy_Rate').val(),
                            Tot_Amunt: $('#Tot_Amunt').val(),
                            Taxp_Extra: $('#Taxp_Extra').val(),
                            Rcpt_By: $('#Rcpt_By').val(),
                            Slm_No: $('#Slm_No').val(),
                            Ac_Ty: $('#Ac_Ty').children('option:selected').val(),
                            Sysub_Account: $('#Sysub_Account').val(),
                            Tr_Cr: $('#Tr_Cr').val(),
                            Dc_No: $('#Dc_No').val(),
                            Tr_Ds: $('#Tr_Ds').val(),
                            Tr_Ds1: $('#Tr_Ds1').val(),
                            Acc_No: $('#Acc_No').val(),
                            last_record : $('#last_record').val(),
                            Tr_Db_Acc_No: $('#Tr_Db_Acc_No').val(),
                            Tr_Db_Db: $('#Tr_Db_Db').val(),
                            Tr_Cr_Db: $('#Tr_Cr_Db').val(),
                            Tr_Ds_Db: $('#Tr_Ds_Db').val(),
                            Ln_No: Ln_No,
                            FTot_Amunt: $('#FTot_Amunt').val(),
                            Taxv_Extra: $('#Taxv_Extra').val(), },

                        success: function(data){
                            var response = JSON.parse(data);
                            var Jr_Ty = $('#Jr_Ty').attr('val');
                            if(response.success == true) {
                                if (Jr_Ty == 18) {
                                    var rows = document.getElementById('table').rows;
                                    var sum = 0.0;
                                    for (var i = 0; i < rows.length; i++) {
                                        var txt = rows[i].textContent || rows[i].innerText;
                                        if (txt.trim() === "") {
                                            rows[i].innerHTML = `
                                            <td>` + $('#Ln_No').val() + `</td>
                                            <td>` + $('#Sysub_Account').val() + `</td>
                                            <td>` + $('#Acc_No_Select option:selected').html() + `</td>
                                            <td>0.00</td>
                                            <td>` + $('#Tr_Cr').val() + `</td>
                                            <td>` + $('#Tr_Ds').val() + `</td>
                                            <td>` + $('#Dc_No').val() + `</td>
                                            <td>` + $('#Tr_Ds1').val() + `</td>
                                        `;
                                        }
                                    }

                                    var sum = 0.0;
                                    for (var i = 1; i < rows.length; i++) {
                                        sum += parseFloat(rows[i].cells[4].innerHTML);
                                    }
                                    rows[1].cells[3].innerHTML = sum;
                                }else if (Jr_Ty == 19) {
                                    var rows = document.getElementById('table').rows;
                                    var sum = 0.0;
                                    for (var i = 0; i < rows.length; i++) {
                                        var txt = rows[i].textContent || rows[i].innerText;
                                        if (txt.trim() === "") {
                                            rows[i].innerHTML = `
                                            <td>` + $('#Ln_No').val() + `</td>
                                            <td>` + $('#Sysub_Account').val() + `</td>
                                            <td>` + $('#Acc_No_Select option:selected').html() + `</td>
                                            <td>` + $('#Tr_Cr').val() + `</td>
                                            <td>0.00</td>
                                            <td>` + $('#Tr_Ds').val() + `</td>
                                            <td>` + $('#Dc_No').val() + `</td>
                                            <td>` + $('#Tr_Ds1').val() + `</td>
                                        `;
                                        }
                                    }

                                    var sum = 0.0;
                                    for (var i = 1; i < rows.length; i++) {
                                        sum += parseFloat(rows[i].cells[3].innerHTML);
                                    }
                                    rows[1].cells[4].innerHTML = sum;
                                }

                                $('#Tr_Db_Db').val(sum);
                                $('#Tr_Cr_Db').val(sum);

                                var item = {
                                    Brn_No: $('#Dlv_Stor').children('option:selected').val(),
                                    Cmp_No: $('#Cmp_No').children('option:selected').val(),
                                    Tr_No: $('#Tr_No').val(),
                                    Tr_Dt: $('#Tr_Dt').val(),
                                    Tr_DtAr: $('#Tr_DtAr').val(),
                                    Doc_Type: $('#Doc_Type').children('option:selected').val(),
                                    Curncy_No: $('#Curncy_No').children('option:selected').val(),
                                    Curncy_Rate: $('#Curncy_Rate').val(),
                                    Tot_Amunt: $('#Tot_Amunt').val(),
                                    Taxp_Extra: $('#Taxp_Extra').val(),
                                    Slm_No: $('#Slm_No').val(),
                                    Ac_Ty: $('#Ac_Ty').children('option:selected').val(),
                                    Sysub_Account: $('#Sysub_Account').val(),
                                    Tr_Cr: $('#Tr_Cr').val(),
                                    Dc_No: $('#Dc_No').val(),
                                    Tr_Ds: $('#Tr_Ds').val(),
                                    Tr_Ds1: $('#Tr_Ds1').val(),
                                    Acc_No: $('#Acc_No').val(),
                                    last_record : $('#last_record').val(),
                                    Tr_Db_Acc_No: $('#Tr_Db_Acc_No').val(),
                                    Tr_Db_Db: $('#Tr_Db_Db').val(),
                                    Tr_Cr_Db: $('#Tr_Cr_Db').val(),
                                    Tr_Ds_Db: $('#Tr_Ds_Db').val(),
                                    Ln_No: $('#Ln_No').val(),
                                    FTot_Amunt: $('#FTot_Amunt').val(),
                                    Taxv_Extra: $('#Taxv_Extra').val(),
                                    tax: tax,
                                };

                                catch_data.push(item);
                            }
                            else{
                                $('#alert').removeClass('hidden');
                                $('#alert').html(``);
                                var errors = Object.values(response.data);
                                for(var i = 0; i < errors.length; i++){
                                    $('#alert').append(`<div class='alert alert-danger'>`+errors[i]+`</div>`);
                                }
                            }

                        }
                    });

                    old = $('#Tr_Db_Db').val();
                });

                //حساب الضريبه
                var calcTax = function(){
                    var amount = $('#Tot_Amunt').val();
                    if($('#create_cache :checkbox[id=Taxp_Extra_check]').is(':checked')){
                        var tax = $('#Taxp_Extra').val();
                        if(tax !== null){
                            var total_amount = ((tax * amount) / 100);
                        }
                        else{
                            var total_amount = amount;
                        }
                        $('#Tr_Cr').val(parseFloat(amount) + parseFloat(total_amount));
                    }
                    else{
                        $('#Tr_Cr').val(parseFloat(amount));
                        $('#Taxv_Extra').val(parseFloat($('#Tr_Cr').val()) - parseFloat($('#Tot_Amunt').val()));
                        // $('#Taxp_Extra').val(null);
                    }

                    $('#Taxv_Extra').val(parseFloat($('#Tr_Cr').val()) - parseFloat($('#Tot_Amunt').val()));

                }

                //حفظ السند فى قاعدة البيانات
                $('#save').click(function(e){
                    e.preventDefault();
                    if($('#Tr_Dif').val() != 0){
                        alert('القيد غير متزن');
                    }
                    else{
                        catch_data = JSON.stringify(catch_data);
                        $.ajax({
                            url: "{{route('updateTrnsN')}}",
                            type: "post",
                            dataType: 'html',
                            data: {"_token": "{{ csrf_token() }}", catch_data},
                            success: function(data){
                                $('#alert').html(`<div class='alert alert-info'>تمت الاضافة بنجاح</div>`);
                                window.location.replace('{{ url('admin/notice')}}');
                                $('#Tr_No').val(null);
                                $('#Curncy_No').val(0);
                                $('#Curncy_Rate').val(null);
                                $('#Tot_Amunt').val(null);
                                $('#Taxp_Extra').val(null);
                                $('#Slm_No').val(null);
                                $('#Ac_Ty').val(null);
                                $('#Sysub_Account').val(null);
                                $('#Tr_Cr').val(null);
                                $('#Dc_No').val(null);
                                $('#Tr_Ds').val(null);
                                $('#Tr_Ds1').val(null);
                                $('#Acc_No').val(null);
                                $('#Acc_No_Select').val(null);
                                $('#Dc_No_Db').val(null);
                                $('#Tr_Ds_Db').val(null);
                                $('#Slm_No_Name').val(null);
                                $('#Chq_no').val(null);
                                $('#Bnk_Nm').val(null);
                                $('#Issue_Dt').val(null);
                                $('#Due_Issue_Dt').val(null);
                                $('#Rcpt_By').val(null);
                                $('#Tr_Db_Db').val(null);
                                $('#Tr_Ds_Db').val(null);
                                $('#Tr_Cr_Db').val(null);
                                $('#FTot_Amunt').val(null);
                                $('#Taxv_Extra').val(null);
                                $('#table_view').html(`<table class="table" id="table">


                                                    <thead>
                                                        <th>{{trans('admin.id')}}</th>
                                                        <th>{{trans('admin.account_number')}}</th>
                                                        <th>{{trans('admin.account_name')}}</th>
                                                        <th>{{trans('admin.motion_debtor')}}</th>
                                                        <th>{{trans('admin.motion_creditor')}}</th>
                                                        <th>{{trans('admin.note_ar')}}</th>
                                                        <th>{{trans('admin.receipt_number')}}</th>
                                                        <th>{{trans('admin.note_en')}}</th>
                                                    </thead>
                                                </table>`);
                            }
                        });
                    }
                });

                //حذف سطر من السند
                $('#delete_button').click(function(e){
                    e.preventDefault();
                    var Tr_No = $('#Tr_No').val();
                    var Ln_No = $('#Ln_No').val();
                    $.ajax({
                        url: "{{route('deleteTrnsN')}}",
                        type: 'post',
                        data:{"_token": "{{ csrf_token() }}", Tr_No: Tr_No, Ln_No: Ln_No},
                        dataType: 'html',
                        success: function (data) {
                            $('#alert').removeClass('hidden');
                            $('#alert').html(`<div class='alert alert-info'>تم الحذف بنجاح</div>`);
                        }
                    });
                });

                $(document).on('change', '#Curncy_No', function(){
                    $.ajax({
                        url: "{{route('getCurencyRateN')}}",
                        type: "POST",
                        dataType: 'html',
                        data: {"_token": "{{ csrf_token() }}", Curncy_No: $(this).val() },
                        success: function(data){
                            $('#Curncy_Rate').val(data);
                            if($('#FTot_Amunt').val() != null && $('#Curncy_Rate').val() != null){
                                $('#Tot_Amunt').val(parseFloat($('#Curncy_Rate').val()) * parseFloat($('#FTot_Amunt').val()));
                                calcTax();
                                $('#Tr_Db_Db').val(parseFloat(old) + parseFloat($('#Tr_Cr').val()));
                                $('#Tr_Cr_Db').val(parseFloat(old) + parseFloat($('#Tr_Cr').val()));
                                $('#Tr_Dif').val( $('#Tr_Db_Db').val() - $('#Tr_Cr_Db').val() );
                            }
                        }
                    });
                });

                $('#FTot_Amunt').change(function(){
                    if($('#FTot_Amunt').val() != null && $('#Curncy_Rate').val() != null){
                        $('#Tot_Amunt').val(parseFloat($('#Curncy_Rate').val()) * parseFloat($('#FTot_Amunt').val()));
                        calcTax();
                        $('#Tr_Db_Db').val(parseFloat(old) + parseFloat($('#Tr_Cr').val()));
                        $('#Tr_Cr_Db').val(parseFloat(old) + parseFloat($('#Tr_Cr').val()));
                        $('#Tr_Dif').val( $('#Tr_Db_Db').val() - $('#Tr_Cr_Db').val() );
                    }
                });

//              $('#Curncy_Rate').change(function(){
//                 if($('#FTot_Amunt').val() != null && $('#Curncy_Rate').val() != null){
//                     $('#Tot_Amunt').val(parseFloat($('#Curncy_Rate').val()) * parseFloat($('#FTot_Amunt').val()));
//                     calcTax();
//                     $('#Tr_Db_Db').val(parseFloat(old) + parseFloat($('#Tr_Cr').val()));
//                     $('#Tr_Cr_Db').val(parseFloat(old) + parseFloat($('#Tr_Cr').val()));
//                     $('#Tr_Dif').val( $('#Tr_Db_Db').val() - $('#Tr_Cr_Db').val() );
//                 }
//             });

            });
        </script>
    @endpush
    <div class="hidden" id="alert"></div>
    <form action="{{route('notice.update', $gl->Tr_No)}}" method="POST" id="create_cache">
        {{ csrf_field() }}
        {{ method_field('PUT') }}

        <div style="display: flex; justify-content: flex-end; margin-bottom: 10px">
            <div>
                <button type="submit" class="btn btn-danger" id="delete_button"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                <button type="submit" class="btn btn-primary"  id="save"><i class="fa fa-floppy-o"></i></button>

            </div>
        </div>
        <input type="text" name="id" id="id" hidden value="{{$gl->Tr_No}}">

        {{-- header start --}}
        <div class="panel panel-primary panel-H ">
            <div class="panel-heading panel-A">
                <div class="panel-title panel_1">
                    {{trans('admin.data_notice')}}
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                    {{-- الشركه --}}
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="Cmp_No">{{trans('admin.company')}}</label>
                            <select name="Cmp_No" id="Cmp_No" class="form-control" disabled>
                                <option value="{{null}}">{{trans('admin.select')}}</option>
                                @if(count($cmps) > 0)
                                    @foreach($cmps as $cmp)
                                        <option value="{{$cmp->Cmp_No}}" @if($gl->Cmp_No == $cmp->Cmp_No) selected @endif>
                                            {{$cmp->{'Cmp_Nm'.ucfirst(session('lang'))} }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    {{-- نهاية الشركه --}}
                    {{-- الفرع --}}
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="Dlv_Stor">{{trans('admin.section')}}</label>
                            <select name="Dlv_Stor" id="Dlv_Stor" class="form-control" disabled>
                                <option value="{{null}}">{{trans('admin.select')}}</option>
                            </select>
                        </div>
                    </div>
                    {{-- نهاية الفرع --}}
                    {{-- رقم القيد --}}
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="Tr_No">{{trans('admin.number_of_limitation')}}</label>
                            <input type="text" name="Tr_No" id="Tr_No" value="{{$gl->Tr_No}}" class="form-control" disabled>
                        </div>
                    </div>
                    {{-- نهاية رقم القيد --}}
                    {{-- تاريخ القيد --}}
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="Tr_Dt">{{trans('admin.receipt_date')}}</label>
                            <input type="text" name="Tr_Dt" id="Tr_Dt" class="form-control" value="{{$gl->Tr_Dt}}" disabled>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="Tr_DtAr">{{trans('admin.higri_date')}}</label>
                            <input type="text" name="Tr_DtAr" id="Tr_DtAr" class="form-control" value="{{$gl->Tr_DtAr}}" disabled>
                        </div>
                    </div>
                    {{-- نهاية تاريخ القيد --}}
                </div>

                <div class="row">
                    {{-- نوع الاشعار دائـن / مديـن --}}
                    <div class="col-md-2">
                        <label for="Jr_Ty">{{trans('admin.noti_type')}}</label>
                        <input type="text" name="Jr_Ty" id="Jr_Ty" val="{{$gl->Jr_Ty}}" class="form-control" disabled value="
                            @if($gl->Jr_Ty == 19) {{trans('admin.Fbal_CR_cr')}}
                        @elseif($gl->Jr_Ty == 18){{trans('admin.Fbal_Db_db')}}
                        @endif
                            ">

                    </div>
                    {{-- نهاية نوع الاشعار دائـن / مديـن --}}

                    {{-- العمله --}}
                    <div class="col-md-2">
                        <label for="Curncy_No">{{trans('admin.currency')}}</label>
                        <select name="Curncy_No" id="Curncy_No" class="form-control" disabled>
                            @foreach($crncy as $crn)
                                <option value="{{$crn->Curncy_No}}" @if($gl->Curncy_No == $crn->Curncy_No) selected @endif>{{$crn->{'Curncy_Nm'.ucfirst(session('lang'))} }}</option>
                            @endforeach
                        </select>
                    </div>
                    {{-- نهاية العمله --}}
                    {{-- المبلغ بالعمله الاجنبيه --}}
                    <div class="col-md-2">
                        <label for="FTot_Amunt">{{trans('admin.Linv_Net')}}</label>
                        <input type="text" name="FTot_Amunt" id="FTot_Amunt" class="form-control" value="{{$gl->FTot_Amunt}}" disabled>
                    </div>
                    {{-- نهاية المبلغ بالعمله الاجنبيه --}}
                    {{-- سعر الصرف --}}
                    <div class="col-md-1">
                        <label for="Curncy_Rate">{{trans('admin.exchange_rate')}}</label>
                        <input type="text" name="Curncy_Rate" id="Curncy_Rate" class="form-control" value="{{$gl->Curncy_Rate}}" disabled>
                    </div>
                    {{-- نهاية سعر الصرف --}}
                    {{-- المبلغ المطلوب --}}
                    <div class="col-md-2">
                        <label for="Tot_Amunt">{{trans('admin.amount')}}</label>
                        <input type="text" name="Tot_Amunt" id="Tot_Amunt" class="form-control Tot_Amunt" value="{{$gl->Tot_Amunt}}" disabled>
                    </div>
                    {{-- نهاية المبلغ المطلوب --}}
                    {{-- الضريبه --}}
                    <div class="col-md-1">
                        <input type="checkbox" id="Taxp_Extra_check" @if($gl->Taxp_Extra) checked @endif disabled>
                        <label for="Taxp_Extra">{{trans('admin.tax')}} %</label>
                        <input type="text" name="Taxp_Extra" id="Taxp_Extra" class="form-control" value="{{$gl->Taxp_Extra}}" disabled>
                    </div>
                    {{-- نهاية الضريبه --}}

                    {{-- قيمة الضريبه --}}
                    <div class="col-md-1">
                        <label for="Taxv_Extra">{{trans('admin.Taxv_Extra')}}</label>
                        <input type="text" name="Taxv_Extra" id="Taxv_Extra" class="form-control" value="{{$gl->Taxv_Extra}}" disabled>
                    </div>
                    {{-- نهاية قيمة الضريبه --}}

                    {{-- مندوب المبيعات --}}
                    <div class="row col-md-8" id="sales_man_content">
                        <div class="col-md-3">
                            <label for="Slm_No_Name">{{trans('admin.sales_officer2')}}</label>
                            <select name="Slm_No_Name" id="Slm_No_Name" class="form-control" disabled>
                                @if(count($salesman) > 0)
                                    @foreach($salesman as $man)
                                        <option value="{{$man->Slm_No}}" @if($man->Slm_No == $gl->Slm_No) selected @endif>{{$man->{'Slm_Nm'.ucfirst(session('lang'))} }}</option>
                                    @endforeach
                                @endif
                            </select>
                            {{-- <input type="text" name="Slm_No_Name" id="Slm_No_Name"
                            class="form-control" disabled value=""> --}}
                        </div>
                        <div class="col-md-2">
                            <label for=""></label>
                            <input type="text" name="Slm_No" id="Slm_No" class="form-control" disabled>
                            <br>
                        </div>
                    </div>
                    {{-- نهاية مندوب المبيعات --}}
                </div>
            </div>
        </div>


        {{-- header end --}}

        {{-- بيانات الحساب الدائن و المدين --}}
        <div class="row">
            <br>
            {{-- بيانات الحساب الدائن --}}
            <div id="credit_data">
                <div class="col-md-6">
                    <div class="panel panel-primary panel-H">
                        <div class="panel-heading panel-A panel-A">
                            <div class="panel-title panel_2">
                                {{trans('admin.information_account')}}
                            </div>
                        </div>
                        <div class="panel-body">
                            <input type="text" name="Ln_No" id="Ln_No" value="{{-1}}" hidden>
                            {{-- الحساب الرئيسى --}}
                            <div class="row">
                                <div class="col-md-8">
                                    <label for="main_acc">{{trans('admin.main_account_chart')}}</label>
                                    <input type="text" name="main_acc" id="main_acc" class="form-control" disabled>
                                </div>
                                <div class="col-md-4">
                                    <label for="Acc_No"></label>
                                    <input type="text" name="Acc_No" id="Acc_No" class="form-control" disabled>
                                </div>
                            </div>
                            {{-- نهاية الحساب الرئيسى --}}
                            {{-- نوع الحساب --}}
                            <div class="row">
                                {{-- نوع الحساب عملاء - موردين - موظفين - .... --}}
                                <div class="col-md-3">
                                    <label for="Ac_Ty">{{trans('admin.account_type')}}</label>
                                    <select name="Ac_Ty" id="Ac_Ty" class="form-control">
                                        <option value="{{null}}">{{trans('admin.select')}}</option>
                                        @foreach(\App\Enums\AccountType::toSelectArray() as $key => $value)
                                            <option value="{{$key}}">{{$value}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{-- رقم حساب العملاء - رقم حساب الموظفين - رقم حساب الموردين - .... --}}
                                <div class="col-md-6">
                                    <label for="Acc_No_Select"></label>
                                    <select name="Acc_No_Select" id="Acc_No_Select" class="form-control select2">
                                        <option value="{{null}}">{{trans('admin.select')}}</option>
                                    </select>
                                </div>
                                {{-- رقم العميل - رقم المورد - رقم الموظف --}}
                                <div class="col-md-3">
                                    <label for="Sysub_Account"></label>
                                    <input type="text" name="Sysub_Account" id="Sysub_Account" class="form-control">
                                </div>
                            </div>
                            {{-- نهاية نوع الحساب --}}

                            <div class="row">
                                {{-- المبلغ دائن --}}
                                <div class="col-md-4">
                                    <label for="Tr_Cr" id="label_Tr_Cr">{{trans('admin.amount_cr')}}</label>
                                    <input style="background-color: #e9ea92;" type="text" name="Tr_Cr" id="Tr_Cr" value="{{$gl->Tr_Cr}}" class="form-control">
                                </div>
                                {{-- نهاية المبلغ دائن --}}
                                {{-- رقم المستند --}}
                                <div class="col-md-4">
                                    <label for="Dc_No">{{trans('admin.receipt_number')}}</label>
                                    <input type="text" name="Dc_No" id="Dc_No" class="form-control" value="{{$gl->Dc_No}}">
                                </div>
                                {{-- نهاية رقم المستند --}}
                                {{-- مركز التكلفه --}}
                                <div class="col-md-4 hidden" id="Costcntr_No_content">
                                    <label for="Costcntr_No">{{trans('admin.with_cc')}}</label>
                                    <select name="Costcntr_No" id="Costcntr_No" class="form-control">
                                        <option value="{{null}}">{{trans('admin.select')}}</option>
                                    </select>
                                </div>
                                {{-- نهاية مركز التكلفه --}}
                            </div>
                            <div class="row">
                                {{-- البيان عربى --}}
                                <div class="col-md-12">
                                    <br>
                                    <label for="Tr_Ds" class="col-md-2">{{trans('admin.Statement_ar')}}</label>
                                    <input type="text" name="Tr_Ds" id="Tr_Ds" class="form-control col-md-6">
                                </div>
                                {{-- نهاية البيان عربى --}}
                                {{-- البيان انجليزى --}}
                                <div class="col-md-12">
                                    <br>
                                    <label for="Tr_Ds1" class="col-md-2">{{trans('admin.Statement_en')}}</label>
                                    <input type="text" name="Tr_Ds1" id="Tr_Ds1" class="form-control col-md-6" >
                                    <button style="margin-right: 10px" class="btn btn-primary panel-A col-md-3" id="add_line">{{trans('admin.add_line')}}</button>
                                </div>
                                {{-- نهاية البيان انجليزى --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- نهاية بيانات الحساب الدائن --}}

            {{-- بيانات الحساب المدين --}}
            <div class="col-md-6">
                <div class="panel panel-primary panel-H">
                    <div class="panel-heading panel-A panel-A">
                        <div class="panel-title panel_1">
                            {{trans('admin.dept_account')}}
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            {{-- الصندوق الرئيسى --}}
                            <div class="col-md-6">
                                <label for="Tr_Db_Select" id="label_db_cr">{{trans('admin.main_cache')}}</label>
                                <select name="Tr_Db_Select" id="Tr_Db_Select" class="form-control">
                                    @if(count($banks) > 0)
                                        @foreach($banks as $bnk)
                                            <option value="{{$bnk->Acc_No}}" @if($gl->Acc_No == $bnk->Acc_No) selected @endif>{{$bnk->{'Acc_Nm'.ucfirst(session('lang'))} }}</option>
                                        @endforeach
                                    @else
                                        <option>{{trans('admin.nodata')}}</option>
                                    @endif
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="Tr_Db_Acc_No"></label>
                                <input type="text" name="Tr_Db_Acc_No" id="Tr_Db_Acc_No" class="form-control" value="{{$gl->Tr_Db}}">
                            </div>
                            {{-- بيانات الصندوق الرئيسى --}}
                            {{-- رقم المستند --}}
                            <div class="col-md-3">
                                <label for="">{{trans('admin.receipt_number')}}</label>
                                <input type="text" name="Dc_No_Db" id="Dc_No_Db" class="form-control" value="{{$gltrns? $gltrns[0]->Dc_No : null}}">
                            </div>
                            {{-- نهاية رقم المستند --}}
                        </div>
                        {{-- البيان --}}
                        <div class="row">
                            <div class="col-md-12">
                                <br>
                                <label for="Tr_Ds" class="col-md-2">{{trans('admin.note_ar')}}</label>
                                <input type="text" name="Tr_Ds_Db" id="Tr_Ds_Db" class="form-control col-md-10" value="{{$gl->Tr_Ds}}">
                            </div>
                        </div>
                        {{-- البيان --}}
                    </div>
                    {{-- اجمالى السند --}}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        {{trans('admin.receipt_total')}}
                                    </div>
                                </div>
                                <div class="panel-body">
                                    {{-- مدين --}}
                                    <div class="col-md-3">
                                        <label for="Tr_Db_Db">{{trans('admin.Fbal_Db_')}}</label>
                                        <input type="text" name="Tr_Db_Db" id="Tr_Db_Db" class="form-control" value='{{$gl->Tr_Db}}'>
                                    </div>
                                    {{-- نهاية مدين --}}
                                    {{-- دائن --}}
                                    <div class="col-md-3">
                                        <label for="Tr_Cr_Db">{{trans('admin.Fbal_CR_')}}</label>
                                        <input type="text" name="Tr_Cr_Db" id="Tr_Cr_Db" class="form-control" value='{{$gl->Tr_Cr}}'>
                                    </div>
                                    {{-- نهاية دائن --}}
                                    {{-- الفرق --}}
                                    <div class="col-md-3">
                                        <label for="Tr_Dif">{{trans('admin.subtract')}}</label>
                                        <input type="text" name="Tr_Dif" id="Tr_Dif" class="form-control" disabled value="{{$gl->Tr_Db - $gl->Tr_Cr}}">
                                    </div>
                                    {{-- نهاية الفرق --}}
                                    {{-- الرصيد الحالى --}}
                                    {{-- <div class="col-md-3">
                                        <label for="Crnt_Blnc">{{trans('admin.current_balance')}}</label>
                                        <input type="text" name="Crnt_Blnc" id="Crnt_Blnc" class="form-control">
                                    </div> --}}
                                    {{-- نهاية الرصيد الحالى --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- نهاية اجمالى السند --}}
                </div>
            </div>
            {{-- نهاية بيانات الحساب المدين --}}
        </div>
        {{-- نهاية بيانات حساب الدائن و المدين --}}

        {{-- عرض السطور --}}
        <div class="row">
            <div class="col-md-12" id="table_view">
                <table class="table" id="table" style="cursor: pointer;">
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
                        @foreach($gltrns as $trns)
                            <tr>
                                <td>{{$trns->Ln_No}}</td>
                                <td>{{$trns->Sysub_Account == 0 ? $trns->Acc_No : $trns->Sysub_Account}}</td>
                                <td>
                                    @if($trns->Sysub_AccountA == 0)
                                        {{\App\Models\Admin\MtsChartAc::where('Acc_No', $trns->Acc_No)->pluck('Acc_Nm'.ucfirst(session('lang')))->first()}}
                                    @else
                                        @if($gl->Ac_Ty == 1)
                                            {{\App\Models\Admin\MTsCustomer::where('Cstm_No', $trns->Sysub_Account)->pluck('Cstm_Nm'.ucfirst(session('lang')))->first()}}
                                        @endif
                                        @if($gl->Ac_Ty == 2)
                                            {{\App\Models\Admin\MtsSuplir::where('Sup_No', $trns->Sysub_Account)->pluck('Sup_Nm'.ucfirst(session('lang')))->first()}}
                                        @endif
                                        @if($gl->Ac_Ty == 3)
                                            {{\App\Models\Admin\MTsCustomer::where('Cstm_No', $trns->Sysub_Account)->pluck('Cstm_Nm'.ucfirst(session('lang')))->first()}}
                                        @endif
                                        @if($gl->Ac_Ty == 4)
                                            {{\App\Models\Admin\MtsChartAc::where('Acc_No', $trns->Sysub_Account)->pluck('Acc_Nm'.ucfirst(session('lang')))->first()}}
                                        @endif
                                    @endif
                                </td>
                                <td>{{$trns->Tr_Db}}</td>
                                <td>{{$trns->Tr_Cr}}</td>
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
@endsection
