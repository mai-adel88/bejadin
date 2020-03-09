@extends('admin.index')
@section('title',trans('admin.create_Notice_creditor'))
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
                $('#Costcntr_No').select2({});

                var catch_data = [];
                var old = 0;
                var Ln_No = 1;
                var tax = false;

                // toggle between db and cr
                $('#Jr_Ty').change(function () {
                    let Jr_Ty = $(this).val();
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


                    $.ajax({
                        type: 'get',
                        url : "{{route('getSelect')}}",
                        data:{Jr_Ty:Jr_Ty},
                        success : function (data) {
                            $("#Tr_Db_Select").html(data);
                        }
                    });
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

                //get branches of selected company on page load
                $.ajax({
                    url: "{{route('branchForEditN')}}",
                    type: "POST",
                    dataType: 'html',
                    data: {"_token": "{{ csrf_token() }}", Cmp_No: $('#Cmp_No').children('option:selected').val() },
                    success: function(data){
                        $('#Dlv_Stor').html(data);
                        $.ajax({
                            //create transaction  number according to selected branch on page load
                            url: "{{route('createTrNoN')}}",
                            type: "POST",
                            dataType: 'json',
                            data: {"_token": "{{ csrf_token() }}",
                                Brn_No: $('#Dlv_Stor').children('option:selected').val(),
                                Cmp_No: $('#Cmp_No').children('option:selected').val() },
                            success: function(data){
                                $('#Tr_No').val(data);
                            }
                        });
                    }
                });

                //get salesman of selected company on page load
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
                $(document).on('change', '#Slm_No_Name', function(){
                    $('#Slm_No').val($('#Slm_No_Name').children('option:selected').val());
                });

                //get branches of selected company on company select
                $(document).on('change', '#Cmp_No', function(){
                    $.ajax({
                        url: "{{route('branchForEditN')}}",
                        type: "POST",
                        dataType: 'html',
                        data: {"_token": "{{ csrf_token() }}", Cmp_No: $(this).val() },
                        success: function(data){
                            $('#Dlv_Stor').html(data);
                            //create transaction number accoriding to selected branch
                            $.ajax({
                                url: "{{route('createTrNoN')}}",
                                type: "POST",
                                dataType: 'json',
                                data: {"_token": "{{ csrf_token() }}",
                                    Brn_No: $('#Dlv_Stor').children('option:selected').val(),
                                    Cmp_No: $('#Cmp_No').children('option:selected').val() },
                                success: function(data){
                                    $('#Tr_No').val(data);
                                }
                            });
                        }
                    });

                    $.ajax({
                        url: "{{route('getTaxValueN')}}",
                        type: "POST",
                        dataType: 'html',
                        data: {"_token": "{{ csrf_token() }}", Cmp_No: $(this).val() },
                        success: function(data){
                            $('#Taxp_Extra').val(data);
                        }
                    });

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
                });

                //انشاء رقم الحركه حسب اختيار الفرع
                $(document).on('change', '#Dlv_Stor', function(){
                    var Cmp_No = $('#Cmp_No').children('option:selected').val();
                    $.ajax({
                        url: "{{route('createTrNoN')}}",
                        type: "POST",
                        dataType: 'json',
                        data: {"_token": "{{ csrf_token() }}", Brn_No: $(this).val(), Cmp_No: Cmp_No },
                        success: function(data){
                            $('#Tr_No').val(data);
                        }
                    });
                });

                // convert Tr_Dt ro hijry
                let Hijri = $('input#Tr_Dt').val();
                $.ajax({
                    url: "{{route('hijriNoti')}}",
                    type: 'get',
                    data:{Hijri: Hijri},
                    dataType: 'json',
                    success: function (data) {
                        $('#Tr_DtAr').val(data);
                    }
                });

                //get all leaf accounts when selecting account type (leaf acounts: customers / suppliers / employees...)
                $(document).on('change', '#Ac_Ty', function(){
                    var Cmp_No = $('#Cmp_No').children('option:selected').val();
                    var Brn_No = $('#Dlv_Stor').children('option:selected').val();
                    var Acc_Ty = $(this).val();
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

                //get parent account number on account select (when selecting customer / supplier / employee ..)
                $(document).on('change', '#Acc_No_Select', function(){
                    var Cmp_No = $('#Cmp_No').children('option:selected').val();
                    var Brn_No = $('#Dlv_Stor').children('option:selected').val();
                    var Acc_Ty = $('#Ac_Ty').children('option:selected').val();
                    var Acc_No = $(this).val();
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
                                $('#Slm_No').val($('#Slm_No_Name').children('option:selected').val());
                            }
                        });
                    }
                });

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

                //حساب اجمالى المبلغ المطلوب عند ادخال مبلغ جديد
                $('#Tot_Amunt').change(function(){
                    calcTax();
                    $('#Tr_Db_Db').val(parseFloat(old) + parseFloat($('#Tr_Cr').val()));
                    $('#Tr_Cr_Db').val(parseFloat(old) + parseFloat($('#Tr_Cr').val()));
                    $('#Tr_Dif').val( $('#Tr_Db_Db').val() - $('#Tr_Cr_Db').val() );
                });

                //حساب اجمالى المبلغ المطلوب عند اختيار الضريبه
                $('#Taxp_Extra').change(function(){
                    calcTax();
                    $('#Tr_Db_Db').val(parseFloat(old) + parseFloat($('#Tr_Cr').val()));
                    $('#Tr_Cr_Db').val(parseFloat(old) + parseFloat($('#Tr_Cr').val()));
                    $('#Tr_Dif').val( $('#Tr_Db_Db').val() - $('#Tr_Cr_Db').val() );
                });


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

                //اضافة سطر فى الجدول
                $('#add_line').click(function(e){

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
                            Jr_Ty: $('#Jr_Ty').val(),
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
                            Ln_No: $('#Ln_No').val(),
                            Tr_Ds_Db: $('#Tr_Ds_Db').val(),
                            FTot_Amunt: $('#FTot_Amunt').val(),
                            Taxv_Extra: $('#Taxv_Extra').val(), },

                        success: function(data){
                            var response = JSON.parse(data);
                            var Jr_Ty = $('#Jr_Ty').val();

                            if(response.success == true){
                                if(Jr_Ty == 18) {
                                    $('#table').append(`
                                    <tr class='tr'>
                                        <td>` + $('#Ln_No').val() + `</td>
                                        <td>` + $('#Sysub_Account').val() + `</td>
                                        <td>` + $('#Acc_No_Select option:selected').html() + `</td>
                                        <td>0.00</td>
                                        <td>` + $('#Tr_Cr').val() + `</td>
                                        <td>` + $('#Tr_Ds').val() + `</td>
                                        <td>` + $('#Dc_No').val() + `</td>
                                        <td>` + $('#Tr_Ds1').val() + `</td>
                                    </tr>`);
                                        var rows = document.getElementById('table').rows;
                                        var sum = 0.0;
                                        for (var i=1; i<rows.length; i++){
                                            if(rows[i].cells.length > 0){
                                                sum += parseFloat(rows[i].cells[4].innerHTML);
                                            }
                                        }
                                    }
                                    else if(Jr_Ty == 19){
                                        $('#table').append(`
                                        <tr class='tr'>
                                            <td>` + $('#Ln_No').val() + `</td>
                                            <td>` + $('#Sysub_Account').val() + `</td>
                                            <td>` + $('#Acc_No_Select option:selected').html() + `</td>
                                            <td>` + $('#Tr_Cr').val() + `</td>
                                            <td>0.00</td>
                                            <td>` + $('#Tr_Ds').val() + `</td>
                                            <td>` + $('#Dc_No').val() + `</td>
                                            <td>` + $('#Tr_Ds1').val() + `</td>
                                        </tr>`);

                                    var rows = document.getElementById('table').rows;
                                    var sum = 0.0;
                                    for (var i=1; i<rows.length; i++){
                                        if(rows[i].cells.length > 0){
                                            sum += parseFloat(rows[i].cells[3].innerHTML);
                                        }
                                    }
                                }
                                //
                                // var rows = document.getElementById('table').rows;
                                // var sum = 0.0;
                                // for (var i=1; i<rows.length; i++){
                                //     if(rows[i].cells.length > 0){
                                //         sum += parseFloat(rows[i].cells[3].innerHTML);
                                //     }
                                // }
                                $('#Tr_Db_Db').val(sum);
                                $('#Tr_Cr_Db').val(sum);

                                var item = {
                                    Brn_No: $('#Dlv_Stor').children('option:selected').val(),
                                    Cmp_No: $('#Cmp_No').children('option:selected').val(),
                                    Tr_No: $('#Tr_No').val(),
                                    Jr_Ty: $('#Jr_Ty').val(),
                                    Tr_Dt: $('#Tr_Dt').val(),
                                    Tr_DtAr: $('#Tr_DtAr').val(),
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
                                    Ln_No: $('#Ln_No').val(),
                                    Tr_Ds_Db: $('#Tr_Ds_Db').val(),
                                    main_acc: $('#main_acc').val(),
                                    FTot_Amunt: $('#FTot_Amunt').val(),
                                    Taxv_Extra: $('#Taxv_Extra').val(),
                                    tax: tax,
                                };

                                catch_data.push(item);

                                $('#Curncy_No').val(1);
                                $('#Tot_Amunt').val(null);
                                //$('#Jr_Ty').val(null);
                                $('#main_acc').val(null);
                                //$('#Slm_No').val(null);
                                $('#Ac_Ty').val(null);
                                $('#Sysub_Account').val(null);
                                $('#Tr_Cr').val(null);
                                $('#Dc_No').val(null);
                                $('#Tr_Ds').val(null);
                                $('#Tr_Ds1').val(null);
                                $('#Acc_No').val(null);
                                $('#Acc_No_Select').val(null);
                                // $('#Acc_No_Select option:eq(0)').attr('selected','selected');
                                $('#Dc_No_Db').val(null);
                                $('#Tr_Ds_Db').val(null);
                                //$('#Slm_No_Name').val(null);
                                // $('#Tr_Db_Db').val(null);
                                // $('#Tr_Cr_Db').val(null);
                                $('#Ln_No').val(-1);
                                $('#FTot_Amunt').val(null)
                                $('#Taxv_Extra').val(null)

                                // handle click table rows click
                                var table = document.getElementById("table");
                                if (table != null) {
                                    for (var i = 0; i < table.rows.length; i++) {
                                        for (var j = 0; j < table.rows[i].cells.length; j++)
                                            table.rows[i].onclick = function () {
                                                tableText(this, catch_data);
                                                this.innerHTML = '';
                                            };
                                    }
                                }

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
                            url: "{{route('notice.store')}}",
                            type: "post",
                            dataType: 'html',
                            data: {"_token": "{{ csrf_token() }}", catch_data},
                            success: function(data){
                                $('#alert').removeClass('hidden');
                                $('#alert').html(`<div class='alert alert-info'>تمت الاضافة بنجاح</div>`);
                                // $('#Cmp_No').val(null);
                                // $('#Dlv_Stor').val(null);
                                $('#Tr_No').val(null);
                                $('#Curncy_No').val(1);
                                $('#Curncy_Rate').val(null);
                                $('#Tot_Amunt').val(null);
                                $('#Taxp_Extra').val(null);
                                $('#Rcpt_By').val(null);
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
                                $('#Tr_Db_Db').val(null);
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

                //handle table lines click
                function tableText(tableCell, data) {
                    var Ln_No = tableCell.cells[0].innerHTML;
                    var Jr_Ty = $('#Jr_Ty').val();
                    if(Jr_Ty == 19){
                        var updated_sum = parseFloat($('#Tr_Db_Db').val()) - parseFloat(tableCell.cells[3].innerHTML);
                    }else if(Jr_Ty == 18){
                        var updated_sum = parseFloat($('#Tr_Db_Db').val()) - parseFloat(tableCell.cells[4].innerHTML);
                    }
                    old = updated_sum;
                    $('#Tr_Db_Db').val(updated_sum);
                    $('#Tr_Cr_Db').val(updated_sum);

                    for(var i = 0; i < data.length; i++){
                        if(data[i].Ln_No == Ln_No){
                            $('#Ln_No').val(data[i].Ln_No);
                            $('#Jr_Ty').val(data[i].Jr_Ty);
                            $('#Tr_No').val(data[i].Tr_No);
                            $('#Tr_Dt').val(data[i].Tr_Dt);
                            $('#Tr_DtAr').val(data[i].Tr_DtAr);
                            $('#Doc_Type').val(data[i].Doc_Type);
                            $('#Curncy_No').val(data[i].Curncy_No);
                            $('#Curncy_Rate').val(data[i].Curncy_Rate);
                            $('#Tot_Amunt').val(data[i].Tot_Amunt);
                            $('#Taxp_Extra').val(data[i].Taxp_Extra);
                            $('#Rcpt_By').val(data[i].Rcpt_By);
                            $('#Slm_No').val(data[i].Slm_No);
                            $('#Ac_Ty').val(data[i].Ac_Ty);
                            $('#Sysub_Account').val(data[i].Sysub_Account);
                            $('#Tr_Cr').val(data[i].Tr_Cr);
                            $('#Dc_No').val(data[i].Dc_No);
                            $('#Tr_Ds').val(data[i].Tr_Ds);
                            $('#Tr_Ds1').val(data[i].Tr_Ds1);
                            $('#Acc_No').val(data[i].Acc_No);
                            $('#Tr_Db_Acc_No').val(data[i].Tr_Db_Acc_No);
                            $('#Tr_Ds_Db').val(data[i].Tr_Ds_Db);
                            $('#main_acc').val(data[i].main_acc);
                            $('#Acc_No_Select').val(data[i].Acc_No_Select);
                            catch_data.splice(i, 1);
                            break;
                        }
                    }
                }

                //سعر الصرف حسب اختيار العمله
                $.ajax({
                    url: "{{route('getCurencyRateN')}}",
                    type: "POST",
                    dataType: 'html',
                    data: {"_token": "{{ csrf_token() }}", Curncy_No: $('#Curncy_No').children('option:selected').val() },
                    success: function(data){
                        $('#Curncy_Rate').val(data);
                    }
                });
                $(document).on('change', '#Curncy_No', function(){
                    $.ajax({
                        url: "{{route('getCurencyRateN')}}",
                        type: "POST",
                        dataType: 'html',
                        data: {"_token": "{{ csrf_token() }}", Curncy_No: $(this).val() },
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
                });

                //حسال اجمالى المبلغ المطلوب بالعمله الاجنبيه
                $('#FTot_Amunt').change(function(){
                    if($('#FTot_Amunt').val() != null && $('#Curncy_Rate').val() != null){
                        $('#Tot_Amunt').val(parseFloat($('#Curncy_Rate').val()) * parseFloat($('#FTot_Amunt').val()));
                        calcTax();
                        $('#Tr_Db_Db').val(parseFloat(old) + parseFloat($('#Tr_Cr').val()));
                        $('#Tr_Cr_Db').val(parseFloat(old) + parseFloat($('#Tr_Cr').val()));
                        $('#Tr_Dif').val( $('#Tr_Db_Db').val() - $('#Tr_Cr_Db').val() );
                    }
                });

                // Modal - ها تريد طباعة السند؟
                $('#myModal').on('shown.bs.modal', function () {
                    $('#myInput').trigger('focus')
                });

                $('#modal_no').click(function(){
                    location.reload();
                });

            });
        </script>
    @endpush
    <div class="hidden" id="alert"></div>
    <form action="{{route('notice.store')}}" method="POST" id="create_cache">
        {{ csrf_field() }}
        <div style="display:flex; justify-content: flex-end; margin-bottom: 10px">
            <div>
                <button type="submit" class="btn btn-primary panel-A" id="save" data-toggle="modal" data-target="#saveChangesModal"><i class="fa fa-floppy-o"></i></button>
            </div>
        </div>
        <input hidden type="text" name="last_record" id="last_record" value='{{$last_record ? $last_record->Tr_No : null}}'>
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
                            <select name="Cmp_No" id="Cmp_No" class="form-control">
                                @if(count($companies) > 0)
                                    @foreach($companies as $cmp)
                                        <option value="{{$cmp->Cmp_No}}" @if($last_record && $cmp->Cmp_No == $last_record->Cmp_No) selected @endif>{{$cmp->{'Cmp_Nm'.ucfirst(session('lang'))} }}</option>
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
                            <select name="Dlv_Stor" id="Dlv_Stor" class="form-control">
                                <option value="{{null}}">{{trans('admin.select')}}</option>
                            </select>
                        </div>
                    </div>
                    {{-- نهاية الفرع --}}
                    {{-- رقم القيد --}}
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="Tr_No">{{trans('admin.number_of_limitation')}}</label>
                            <input type="text" name="Tr_No" id="Tr_No" value="" class="form-control" disabled>
                        </div>
                    </div>
                    {{-- نهاية رقم القيد --}}
                    {{-- تاريخ القيد --}}
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="Tr_Dt">{{trans('admin.receipt_date')}}</label>
                            <input type="text" name="Tr_Dt" id="Tr_Dt" class="form-control" value="{{Carbon\Carbon::now()->format('Y-m-d')}}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="Tr_DtAr">{{trans('admin.higri_date')}}</label>
                            <input type="text" name="Tr_DtAr" id="Tr_DtAr" class="form-control">
                        </div>
                    </div>
                    {{-- نهاية تاريخ القيد --}}
                </div>

                <div class="row">
                    {{-- نوع الاشعار دائـن / مديـن --}}
                    <div class="col-md-2">
                        <label for="Jr_Ty">{{trans('admin.noti_type')}}</label>
                        <select name="Jr_Ty" id="Jr_Ty" class="form-control">
                            <option value="19">{{trans('admin.Fbal_CR_cr')}}</option>
                            <option value="18">{{trans('admin.Fbal_Db_db')}}</option>
                        </select>
                    </div>
                    {{-- نهاية نوع الاشعار دائـن / مديـن --}}
                    {{-- العمله --}}
                    <div class="col-md-2">
                        <label for="Curncy_No">{{trans('admin.currency')}}</label>
                        <select name="Curncy_No" id="Curncy_No" class="form-control">
                            @foreach($crncy as $crn)
                                <option value="{{$crn->Curncy_No}}">{{$crn->{'Curncy_Nm'.ucfirst(session('lang'))} }}</option>
                            @endforeach
                        </select>
                    </div>
                    {{-- نهاية العمله --}}
                    {{-- المبلغ بالعمله الاجنبيه --}}
                    <div class="col-md-2">
                        <label for="FTot_Amunt">{{trans('admin.Linv_Net')}}</label>
                        <input type="text" name="FTot_Amunt" id="FTot_Amunt" class="form-control" value="">
                    </div>
                    {{-- نهاية المبلغ بالعمله الاجنبيه --}}
                    {{-- سعر الصرف --}}
                    <div class="col-md-1">
                        <label for="Curncy_Rate">{{trans('admin.exchange_rate')}}</label>
                        <input type="text" name="Curncy_Rate" id="Curncy_Rate" class="form-control" value="">
                    </div>
                    {{-- نهاية سعر الصرف --}}
                    {{-- المبلغ المطلوب --}}
                    <div class="col-md-2">
                        <label for="Tot_Amunt">{{trans('admin.amount')}}</label>
                        <input type="text" name="Tot_Amunt" id="Tot_Amunt"  class="form-control Tot_Amunt">
                    </div>
                    {{-- نهاية المبلغ المطلوب --}}
                    {{-- الضريبه --}}

                    <div class="col-md-1">
                        <input type="checkbox" id="Taxp_Extra_check">
                        <label for="Taxp_Extra">{{trans('admin.tax')}} %</label>
                        <input type="text" name="Taxp_Extra" id="Taxp_Extra" class="form-control" value="" disabled>
                    </div>
                    {{-- نهاية الضريبه --}}

                    {{-- قيمة الضريبه --}}
                    <div class="col-md-1">
                        <label for="Taxv_Extra">{{trans('admin.Taxv_Extra')}}</label>
                        <input type="text" name="Taxv_Extra" id="Taxv_Extra" class="form-control" value="">
                    </div>
                    {{-- نهاية قيمة الضريبه --}}

                    {{-- مندوب المبيعات --}}
                    <div class="row col-md-8" id="sales_man_content">
                        <div class="col-md-3">
                            <label for="Slm_No_Name">{{trans('admin.sales_officer2')}}</label>
                            <select name="Slm_No_Name" id="Slm_No_Name" class="form-control">
                            </select>
                            {{-- <label for="Slm_No_Name">{{trans('admin.sales_officer2')}}</label>
                            <input type="text" name="Slm_No_Name" id="Slm_No_Name" class="form-control" disabled> --}}
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


        <div class="row"  id="Creditor">
            <br>
            {{--             بيانات الحساب الدائن--}}
            <div class="col-md-6">
                <div class="panel panel-primary panel-H">
                    <div class="panel-heading panel-A panel-A">
                        <div class="panel-title panel_2">
                            {{trans('admin.information_account')}}
                        </div>
                    </div>
                    <div class="panel-body">
                        <input type="text" name="Ln_No" id="Ln_No" value="{{-1}}" hidden>
                        {{--                         الحساب الرئيسى--}}
                        <div class="row">
                            <div class="col-md-8">
                                <label for="main_acc">{{trans('admin.main_account_chart')}}</label>
                                <input type="text" name="main_acc" id="main_acc" class="form-control main_acc" disabled>
                            </div>
                            <div class="col-md-4">
                                <label for="Acc_No"></label>
                                <input type="text" name="Acc_No" id="Acc_No" class="form-control Acc_No" disabled>
                            </div>
                        </div>
                        {{--                         نهاية الحساب الرئيسى--}}
                        {{--                         نوع الحساب--}}
                        <div class="row">
                            {{--                             نوع الحساب عملاء - موردين - موظفين - ....--}}
                            <div class="col-md-3">
                                <label for="Ac_Ty">{{trans('admin.account_type')}}</label>
                                <select name="Ac_Ty" id="Ac_Ty" class="form-control Ac_Ty">
                                    <option value="{{null}}">{{trans('admin.select')}}</option>
                                    @foreach(\App\Enums\AccountType::toSelectArray() as $key => $value)
                                        <option value="{{$key}}">{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                            {{--                             رقم حساب العملاء - رقم حساب الموظفين - رقم حساب الموردين - ....--}}
                            <div class="col-md-6">
                                <label for="Acc_No_Select"></label>
                                <select name="Acc_No_Select" id="Acc_No_Select" class="form-control select2 Acc_No_Select">
                                    <option value="{{null}}">{{trans('admin.select')}}</option>
                                </select>
                            </div>
                            {{--                             رقم العميل - رقم المورد - رقم الموظف--}}
                            <div class="col-md-3">
                                <label for="Sysub_Account"></label>
                                <input type="text" name="Sysub_Account" id="Sysub_Account" class="form-control Sysub_Account">
                            </div>
                        </div>
                        {{--                         نهاية نوع الحساب--}}

                        <div class="row">
                            {{--                             المبلغ دائن--}}
                            <div class="col-md-4">
                                <label id="label_Tr_Cr" for="Tr_Cr">{{trans('admin.amount_cr')}}</label>
                                <input style="background-color: #e9ea92;" type="text" disabled name="Tr_Cr" id="Tr_Cr" class="form-control Tr_Cr">
                            </div>
                            {{--                             نهاية المبلغ دائن--}}
                            {{--                             رقم المستند--}}
                            <div class="col-md-4">
                                <label for="Dc_No">{{trans('admin.receipt_number')}}</label>
                                <input type="text" name="Dc_No" id="Dc_No" class="form-control Dc_No">
                            </div>
                            {{--                             نهاية رقم المستند--}}
                            {{--                             مركز التكلفه--}}
                            <div class="col-md-4 hidden" id="Costcntr_No_content">
                                <label for="Costcntr_No">{{trans('admin.with_cc')}}</label>
                                <select name="Costcntr_No" id="Costcntr_No" class="form-control select2">
                                    <option value="{{null}}">{{trans('admin.select')}}</option>
                                    @if(count($cost_center) > 0)
                                        @foreach($cost_center as $cc)
                                            <option value="{{$cc->Costcntr_No}}">{{ $cc->{'Costcntr_Nm'.session('lang')} }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            {{--                             نهاية مركز التكلفه--}}
                        </div>
                        <div class="row">
                            {{--                             البيان عربى--}}
                            <div class="col-md-12">
                                <br>
                                <label for="Tr_Ds" class="col-md-2">{{trans('admin.Statement_ar')}}</label>
                                <input type="text" name="Tr_Ds" id="Tr_Ds" class="form-control col-md-6 Tr_Ds">
                            </div>
                        </div>

                        {{--                         نهاية البيان عربى--}}
                        <div class="row">
                            {{--                             البيان انجليزى--}}
                            <div class="col-md-12">
                                <br>
                                <label for="Tr_Ds1" class="col-md-2">{{trans('admin.Statement_en')}}</label>
                                <input type="text" name="Tr_Ds1" id="Tr_Ds1" class="form-control col-md-6">
                                <button style="margin-right: 10px" class="btn btn-primary panel-A col-md-3" id="add_line">{{trans('admin.add_line')}}</button>
                            </div>
                            {{--                             نهاية البيان انجليزى--}}
                            {{--                             اضافة سطر--}}

                            {{--                             نهاية اضافة سطر--}}
                        </div>
                    </div>
                </div>
            </div>
            {{--             نهاية بيانات الحساب الدائن--}}
            {{--             بيانات الحساب المدين--}}
            <div class="col-md-6">
                <div class="panel panel-primary panel-H">
                    <div class="panel-heading panel-A">
                        <div class="panel-title panel_1">
                            {{trans('admin.dept_account')}}
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            {{--                             الصندوق الرئيسى--}}
                            <div class="col-md-6">
                                <label id="label_db_cr" for="Tr_Db_Select">{{trans('admin.allowed')}}</label>
                                <select name="Tr_Db_Select" id="Tr_Db_Select" class="form-control Tr_Db_Select">
                                    @if(count($banks) > 0)
                                        @foreach($banks as $bnk)
                                            <option value="{{$bnk->Acc_No}}">{{$bnk->{'Acc_Nm'.ucfirst(session('lang'))} }}</option>
                                        @endforeach
                                    @else
                                        <option>{{trans('admin.nodata')}}</option>
                                    @endif
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="Tr_Db_Acc_No"></label>
                                <input type="text" name="Tr_Db_Acc_No" id="Tr_Db_Acc_No" class="form-control Tr_Db_Acc_No">
                            </div>
                            {{--                             بيانات الصندوق الرئيسى--}}
                            {{--                             رقم المستند--}}
                            <div class="col-md-3">
                                <label for="">{{trans('admin.receipt_number')}}</label>
                                <input type="text" name="Dc_No_Db" id="Dc_No_Db" class="form-control Dc_No_Db">
                            </div>
                            {{--                             نهاية رقم المستند--}}
                        </div>
                        {{--                         البيان--}}
                        <div class="row">
                            <div class="col-md-12">
                                <br>
                                <label for="Tr_Ds" class="col-md-2">{{trans('admin.note_ar')}}</label>
                                <input type="text" name="Tr_Ds_Db" id="Tr_Ds_Db" class="form-control col-md-10 Tr_Ds_Db">
                            </div>
                        </div>
                        {{--                         البيان--}}
                    </div>
                    {{--                     اجمالى السند--}}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        {{trans('admin.receipt_total')}}
                                    </div>
                                </div>
                                <div class="panel-body">
                                    {{--                                     مدين--}}
                                    <div class="col-md-3">
                                        <label for="Tr_Db_Db">{{trans('admin.Fbal_Db_')}}</label>
                                        <input type="text" name="Tr_Db_Db" id="Tr_Db_Db" class="form-control Tr_Db_Db" value='0.00'>
                                    </div>
                                    {{--                                     نهاية مدين--}}
                                    {{--                                     دائن--}}
                                    <div class="col-md-3">
                                        <label for="Tr_Cr_Db">{{trans('admin.Fbal_CR_')}}</label>
                                        <input  type="text" name="Tr_Cr_Db" id="Tr_Cr_Db" class="form-control Tr_Cr_Db" value='0.00'>
                                    </div>
                                    {{--                                     نهاية دائن--}}
                                    {{--                                     الفرق--}}
                                    <div class="col-md-3">
                                        <label for="Tr_Dif">{{trans('admin.subtract')}}</label>
                                        <input type="text" name="Tr_Dif" id="Tr_Dif" class="form-control Tr_Dif" disabled>
                                    </div>
                                    {{--                                     نهاية الفرق--}}

                                </div>
                            </div>
                        </div>
                    </div>
                    {{--                     نهاية اجمالى السند--}}
                </div>
            </div>
            {{--             نهاية بيانات الحساب المدين--}}
        </div>

        <div class="row">
            <div class="col-md-12" id="table_view">
                <table class="table" id="table">
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
                </table>
            </div>
        </div>
    </form>


    {{-- Modal --}}
    <div class="modal fade" id="saveChangesModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    {{-- <h5 class="modal-title" id="exampleModalLabel">Modal title</h5> --}}
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{trans('admin.close_ask')}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('admin.yes')}}</button>
                    <button type="button" class="btn btn-primary" id="modal_no">{{trans('admin.no')}}</button>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal end --}}
@endsection
