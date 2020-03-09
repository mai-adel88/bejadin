@extends('admin.index')
@section('title',trans('admin.accbanks'))
@section('content')
@push('js')
    <script>
        $(document).ready(function(){
            $('#Acc_No_Select').select2({});
            $('#Cmp_No').select2({});

            //get data on page load
            $.ajax({
                url: "{{route('getCharts')}}",
                type: "POST",
                dataType: 'html',
                data: {"_token": "{{ csrf_token() }}", Cmp_No: $('#Cmp_No').children('option:selected').val(), bank_Acc: {{ $bank->Acc_No }} },
                success: function(data){
                    $('#Acc_No_Select').html(data);
                }
            });

            var Cmp_No = $('#Cmp_No').children('option:selected').val();
            var Acc_Ty = 1;
            var Acc_No = {{ $bank->Acc_No }}
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
    </script>
@endpush
    <form action="{{route('accbanks.update', $bank->ID_No)}}" method="POST">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <div class="panel panel-primary" style="width:50%; margin:auto auto;">
            <div class="panel-heading">
                <div class="panel-title">
                    {{trans('admin.accbanks')}}
                </div>
            </div>
            <div class="panel-body">
                <div class="row pull-left">
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary" disabled><i class="fa fa-floppy-o"></i></button>
                    </div>  
                </div>
                {{-- الشركه --}}
                <div class="row">
                    <div class="col-md-12">
                        <label for="Cmp_No" class="col-md-2">{{trans('admin.company')}}</label>
                        <select name="Cmp_No" id="Cmp_No" class="form-control col-md-9 select2" disabled>
                            <option value="{{null}}">{{trans('admin.select')}}</option>
                            @if(count($cmps) > 0)
                                @foreach($cmps as $cmp)
                                    <option value="{{$cmp->Cmp_No}}" @if($bank->Cmp_No == $cmp->Cmp_No) selected @endif>{{$cmp->{'Cmp_Nm'.ucfirst(session('lang'))} }}</option>
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
                    <input type="text" name="Acc_No" id="Acc_No" class="form-control col-md-3" value="{{$bank->Acc_No}}" disabled>
                    <select name="Acc_No_Select" id="Acc_No_Select" class="form-control col-md-6 select2" disabled>
                        <option value="{{null}}">{{trans('admin.select')}}</option>
                    </select>
                </div>
                {{-- نهاية رقم الحساب و الحسابات --}}
                {{-- اسم الحساب عربى --}}
                <div class="row">
                    <br>
                    <label for="Acc_NmAr" class="col-md-2">{{trans('admin.account_name')}}</label>
                    <input type="text" name="Acc_NmAr" id="Acc_NmAr" class="form-control col-md-9" value="{{$bank->Acc_NmAr}}" disabled>
                </div>
                {{-- نهاية اسم الحساب عربى --}}
                {{-- اسم الحساب انجليزى --}}
                <div class="row">
                    <br>
                    <label for="Acc_NmEn" class="col-md-2">{{trans('admin.subscriber_name_en')}}</label>
                    <input type="text" name="Acc_NmEn" id="Acc_NmEn" class="form-control col-md-9" value="{{$bank->Acc_NmEn}}" disabled>
                </div>
                {{-- نهاية اسم الحساب انجليزى --}}
                {{-- رقم حساب البنك --}}
                <div class="row">
                    <br>
                    <label for="Acc_Bank_No" class="col-md-2">{{trans('admin.Acc_Bank_No')}}</label>
                    <input type="text" name="Acc_Bank_No" id="Acc_Bank_No" class="form-control col-md-4" value="{{$bank->Acc_Bank_No}}" disabled>
                </div>
                {{-- نهاية رقم حساب البنك --}}
                <div class="row">
                    <br>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            {{-- سند قبض نقدى --}}
                            <div class="col-md-4">
                                <input type="checkbox" name="RcpCsh_Voucher" id="RcpCsh_Voucher" @if($bank->RcpCsh_Voucher == 1) checked @endif disabled>
                                <label for="RcpCsh_Voucher">{{trans('admin.RcpCsh_Voucher')}}</label>
                            </div>
                            {{-- نهاية سند قبض نقدى --}}
                            {{-- سند صرف نقدى --}}
                            <div class="col-md-4">
                                <input type="checkbox" name="PymCsh_voucher" id="PymCsh_voucher" @if($bank->PymCsh_voucher == 1) checked @endif disabled>
                                <label for="PymCsh_voucher">{{trans('admin.cash_payment')}}</label>
                            </div>
                            {{-- نهاية سند صرف نقدى --}}
                            {{-- اشعار مدين --}}
                            <div class="col-md-4">
                                <input type="checkbox" name="DB_Note" id="DB_Note" @if($bank->DB_Note == 1) checked @endif disabled>
                                <label for="DB_Note">{{trans('admin.debt_notify')}}</label>
                            </div>
                            {{-- نهاية اشعار مدين --}}
                            {{-- سند قبض شيك --}}
                            <div class="col-md-4">
                                <input type="checkbox" name="RcpChk_Voucher" id="RcpChk_Voucher" @if($bank->RcpChk_Voucher == 1) checked @endif disabled>
                                <label for="RcpChk_Voucher">{{trans('admin.RcpChk_Voucher')}}</label>
                            </div>
                            {{-- نهاية سند قبض شيك --}}
                            {{-- سند صرف شيك --}}
                            <div class="col-md-4">
                                <input type="checkbox" name="PymChk_Voucher" id="PymChk_Voucher" @if($bank->PymChk_Voucher == 1) checked @endif disabled>
                                <label for="PymChk_Voucher">{{trans('admin.cheque_payment')}}</label>
                            </div>
                            {{-- نهاية سند صرف شيك --}}
                            {{-- اشعار دائن --}}
                            <div class="col-md-4">
                                <input type="checkbox" name="CR_Note" id="CR_Note" @if($bank->CR_Note == 1) checked @endif disabled>
                                <label for="CR_Note">{{trans('admin.credit_notify')}}</label>
                            </div>
                            {{-- نهاية اشعار دائن --}}
                            {{-- مجمع النقديه --}}
                            <div class="col-md-4">
                                <input type="checkbox" name="Cash_Rpt" id="Cash_Rpt" @if($bank->Cash_Rpt == 1) checked @endif disabled>
                                <label for="Cash_Rpt">{{trans('admin.Cash_Rpt')}}</label>
                            </div>
                            {{-- نهاية مجمع النقديه --}}
                            {{-- مجمع النقديه --}}
                            <div class="col-md-4">
                                <input type="checkbox" name="Bank_No" id="Bank_No" @if($bank->Bank_No == 1) checked @endif disabled>
                                <label for="Bank_No">{{trans('admin.Bank_No')}}</label>
                            </div>
                            {{-- نهاية مجمع النقديه --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection