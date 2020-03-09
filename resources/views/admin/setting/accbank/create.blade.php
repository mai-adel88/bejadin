@extends('admin.index')
@section('title',trans('admin.accbanks'))
@section('content')
@push('js')
    <script>
        $(document).ready(function(){
            $('#Acc_No_Select').select2({});
            $('#Cmp_No').select2({});

            $('#Acc_No_Select').change(function(){
                var Cmp_No = $('#Cmp_No').children('option:selected').val();
                var Acc_Ty = 1;
                var Acc_No = $(this).val();
                $.ajax({
                    url: "{{route('getAcc')}}",
                    type: "POST",
                    dataType: 'json',
                    data: {"_token": "{{ csrf_token() }}", Cmp_No: Cmp_No, Acc_Ty: Acc_Ty, Acc_No: Acc_No },
                    success: function(data){
                        $('#Acc_No').val(Acc_No);
                        $('#Acc_NmAr').val(data.Acc_NmAr);
                        $('#Acc_NmEn').val(data.Acc_NmEn);
                    }
                });
            });

            $('#Cmp_No').change(function(){
                $.ajax({
                    url: "{{route('getCharts')}}",
                    type: "POST",
                    dataType: 'html',
                    data: {"_token": "{{ csrf_token() }}", Cmp_No: $(this).val(), bank_Acc: null },
                    success: function(data){
                        $('#Acc_No_Select').html(data);
                    }
                });
            });
        });
    </script>
@endpush
    <form action="{{route('accbanks.store')}}" method="POST">
        {{ csrf_field() }}
        <div class="panel panel-primary" style="width:50%; margin:auto auto;    ">
            <div class="panel-heading">
                <div class="panel-title">
                    {{trans('admin.accbanks')}}
                </div>
            </div>
            <div class="panel-body">
                <div class="row pull-left">
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i></button>
                    </div>  
                </div>
                {{-- الشركه --}}
                <div class="row">
                    <div class="col-md-12">
                        <label for="Cmp_No" class="col-md-2">{{trans('admin.company')}}</label>
                        <select name="Cmp_No" id="Cmp_No" class="form-control col-md-9 select2">
                            <option value="{{null}}">{{trans('admin.select')}}</option>
                            @if(count($cmps) > 0)
                                @foreach($cmps as $cmp)
                                    <option value="{{$cmp->Cmp_No}}">{{$cmp->{'Cmp_Nm'.ucfirst(session('lang'))} }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                {{-- نهاية الشركه --}}
                {{-- رقم الحساب و الحسابات --}}
                <div class="row">
                    <br>
                    <label for="Acc_No" class="col-md-2">{{trans('admin.account_number')}}</label>
                    <input type="text" name="Acc_No" id="Acc_No" class="form-control col-md-3">
                    <select name="Acc_No_Select" id="Acc_No_Select" class="form-control col-md-6 select2">
                        <option value="{{null}}">{{trans('admin.select')}}</option>
                    </select>
                </div>
                {{-- نهاية رقم الحساب و الحسابات --}}
                {{-- اسم الحساب عربى --}}
                <div class="row">
                    <br>
                    <label for="Acc_NmAr" class="col-md-2">{{trans('admin.account_name')}}</label>
                    <input type="text" name="Acc_NmAr" id="Acc_NmAr" class="form-control col-md-9">
                </div>
                {{-- نهاية اسم الحساب عربى --}}
                {{-- اسم الحساب انجليزى --}}
                <div class="row">
                    <br>
                    <label for="Acc_NmEn" class="col-md-2">{{trans('admin.subscriber_name_en')}}</label>
                    <input type="text" name="Acc_NmEn" id="Acc_NmEn" class="form-control col-md-9">
                </div>
                {{-- نهاية اسم الحساب انجليزى --}}
                {{-- رقم حساب البنك --}}
                <div class="row">
                    <br>
                    <label for="Acc_Bank_No" class="col-md-2">{{trans('admin.Acc_Bank_No')}}</label>
                    <input type="text" name="Acc_Bank_No" id="Acc_Bank_No" class="form-control col-md-4">
                </div>
                {{-- نهاية رقم حساب البنك --}}
                <div class="row">
                    <br>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            {{-- سند قبض نقدى --}}
                            <div class="col-md-4">
                                <input type="checkbox" name="RcpCsh_Voucher" id="RcpCsh_Voucher">
                                <label for="RcpCsh_Voucher">{{trans('admin.RcpCsh_Voucher')}}</label>
                            </div>
                            {{-- نهاية سند قبض نقدى --}}
                            {{-- سند صرف نقدى --}}
                            <div class="col-md-4">
                                <input type="checkbox" name="PymCsh_voucher" id="PymCsh_voucher">
                                <label for="PymCsh_voucher">{{trans('admin.cash_payment')}}</label>
                            </div>
                            {{-- نهاية سند صرف نقدى --}}
                            {{-- اشعار مدين --}}
                            <div class="col-md-4">
                                <input type="checkbox" name="DB_Note" id="DB_Note">
                                <label for="DB_Note">{{trans('admin.debt_notify')}}</label>
                            </div>
                            {{-- نهاية اشعار مدين --}}
                            {{-- سند قبض شيك --}}
                            <div class="col-md-4">
                                <input type="checkbox" name="RcpChk_Voucher" id="RcpChk_Voucher">
                                <label for="RcpChk_Voucher">{{trans('admin.RcpChk_Voucher')}}</label>
                            </div>
                            {{-- نهاية سند قبض شيك --}}
                            {{-- سند صرف شيك --}}
                            <div class="col-md-4">
                                <input type="checkbox" name="PymChk_Voucher" id="PymChk_Voucher">
                                <label for="PymChk_Voucher">{{trans('admin.cheque_payment')}}</label>
                            </div>
                            {{-- نهاية سند صرف شيك --}}
                            {{-- اشعار دائن --}}
                            <div class="col-md-4">
                                <input type="checkbox" name="CR_Note" id="CR_Note">
                                <label for="CR_Note">{{trans('admin.credit_notify')}}</label>
                            </div>
                            {{-- نهاية اشعار دائن --}}
                            {{-- مجمع النقديه --}}
                            <div class="col-md-4">
                                <input type="checkbox" name="Cash_Rpt" id="Cash_Rpt">
                                <label for="Cash_Rpt">{{trans('admin.Cash_Rpt')}}</label>
                            </div>
                            {{-- نهاية مجمع النقديه --}}
                            {{-- البنوك --}}
                            <div class="col-md-4">
                                <input type="checkbox" name="Bank_No" id="Bank_No">
                                <label for="Bank_No">{{trans('admin.Bank_No')}}</label>
                            </div>
                            {{-- نهاية البنوك --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection