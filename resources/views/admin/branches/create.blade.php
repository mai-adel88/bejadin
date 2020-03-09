@extends('admin.index')
@section('title', trans('admin.add_new_branches'))
@section('content')
@hasrole('writer')
@can('create')
@push('js')
    <script>
        $(document).ready(function(){
            $('#brn_form :radio[id=Br_Ty]').change(function(){
                if($(this).is(':checked')){
                    if($(this).val() == 2 || $(this).val() == 3){
                        $('#MainBrn').removeClass('hidden');
                    }
                    else{
                        $('#MainBrn').addClass('hidden');
                        $('#Main_Brn').val("");
                    }
                }
            });

            $(document).on('change', '#Cmp_No', function(){
                $.ajax({
                    url: "{{route('getBranchesAndStores')}}",
                    type: "POST",
                    dataType: 'html',
                    data: {"_token": "{{ csrf_token() }}", Cmp_No: $(this).val() },
                    success: function(data){
                        $('#Dlv_Stor_content').html(data);
                        $('#Main_Brn_content').html(data);
                    }
                });
            });
        });
    </script>
@endpush
    <div class="box">
        @include('admin.layouts.message')
        {!! Form::open(['method'=>'POST','route' => ['branches.update', $branch->ID_No], 'id' => 'brn_form']) !!}
        {{ csrf_field() }}
        {{ method_field('PUT') }}
            <div class="box-header">
                <h3 class="box-title">{{$title}}</h3>
                <div class="pull-left">
                    {{Form::submit(trans('admin.save'),['class'=>'btn btn-primary'])}}
                </div>
            </div>
            <div class="box-body">

                <div class="row">
                    <div class="col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-body">
                                <div class="row">
                                    {{-- رقم الفرع --}}
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="">{{trans('admin.Brn_No')}}</label>
                                            <input type="text" disabled value="{{$branch->Brn_No}}" name="Brn_No" id="Brn_No" class="form-control">
                                        </div>
                                    </div>
                                    {{-- نهاية رقم الفرع --}}

                                    {{-- نوع الفرع --}}
                                    <div class="col-md-10">
                                        <div class="row">
                                            @foreach(\App\Enums\BranchType::toArray() as $index => $Br_Ty)
                                                <div class="col-md-3">
                                                    <div class="form-group" style="display:inline-block">
                                                        <input class="checkbox-inline" type="radio"
                                                        name="Br_Ty" id="Br_Ty" value="{{$Br_Ty}}"
                                                        @if ($branch->Br_Ty == $Br_Ty) checked @endif>
                                                        {{ Form::label('Br_Ty', trans('admin.'.\App\Enums\BranchType::getKey($Br_Ty)),
                                                        ['class' => 'control-label']) }}
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    {{-- نهاية نوع الفرع --}}
                                </div>
                                {{-- الشركه --}}
                                <div class="col-md-12">
                                    <div class="row from-group">
                                        <label for="">{{trans('admin.Cmp_No')}}</label>
                                        <select name="Cmp_No" id="Cmp_No" class="form-control">
                                            @if(count($company) > 0)
                                                <option value="">{{trans('admin.select')}}</option>
                                                @foreach($company as $cmp)
                                                    <option value="{{$cmp->Cmp_No}}" @if($cmp->Cmp_No == $branch->Cmp_No) selected @endif>
                                                        {{$cmp->{'Cmp_Nm'.ucfirst(session('lang'))} }}
                                                    </option>
                                                @endforeach
                                            @else
                                                <option value="">{{trans('admin.nodata')}}</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                {{-- نهاية الشركه --}}
                                <div class="row">
                                    {{-- الفرع الرئيسى --}}
                                    <div class="col-md-12">
                                        <div class="form-group hidden" id="MainBrn">
                                            <label for="">{{trans('admin.Main_Brn')}}</label>
                                            <div id="Main_Brn_content">
                                                <select name="Main_Brn" id="Main_Brn" class="form-control">
                                                    <option value="">{{trans('admin.select')}}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- نهاية الفرع الرئيسى --}}
                                    {{-- الاسم عربى --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">{{trans('admin.arabic_name')}}</label>
                                            <input type="text" value="{{$branch->Brn_NmAr? $branch->Brn_NmAr: ''}}" name="Brn_NmAr" id="Brn_NmAr" class="form-control">
                                        </div>
                                    </div>
                                    {{-- نهاية الاسم عربى --}}
                                    {{-- الاسم انجليزى --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">{{trans('admin.english_name')}}</label>
                                            <input type="text" value="{{$branch->Brn_NmEn? $branch->Brn_NmEn: ''}}" name="Brn_NmEn" id="Brn_NmEn" class="form-control">
                                        </div>
                                    </div>
                                    {{-- نهاية الاسم انجليزى --}}
                                    {{-- الهاتف --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">{{trans('admin.phone')}}</label>
                                            <input type="text" value="{{$branch->Brn_Tel? $branch->Brn_Tel: ''}}" name="Brn_Tel" id="Brn_Tel" class="form-control">
                                        </div>
                                    </div>
                                    {{-- نهاية الهاتف --}}
                                    {{-- الفاكس --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="Brn_Fax">{{trans('admin.fax')}}</label>
                                            <input type="text" value="{{$branch->Brn_Fax? $branch->Brn_Fax: ''}}" name="Brn_Fax" id="Brn_Fax" class="form-control">
                                        </div>
                                    </div>
                                    {{-- نهاية الفاكس --}}
                                </div>
                                {{-- عنوان الفرع --}}
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">{{trans('admin.address')}}</label>
                                            <input type="text" value="{{$branch->Brn_Adrs? $branch->Brn_Adrs: ''}}" name="Brn_Adrs" id="Brn_Adrs" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                {{-- نهاية عنوان الفرع --}}

                                <div class="row">
                                    {{-- الايميل --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">{{trans('admin.email')}}</label>
                                            <input type="email" value="{{$branch->Brn_Email? $branch->Brn_Email: ''}}" name="Brn_Email" id="Brn_Email" class="form-control">
                                        </div>
                                    </div>
                                    {{-- نهاية الايميل --}}
                                    {{-- مستودع التسليم --}}
                                    <div class="col-md-6">
                                        <div class="from-group">
                                            <label for="">{{trans('admin.Delivery_Store')}}</label>
                                            <div  id="Dlv_Stor_content">
                                                <select name="Dlv_Stor" id="Dlv_Stor" class="form-control">
                                                    <option value="">{{trans('admin.select')}}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- نهاية مستودع التسليم --}}
                                {{-- p tag for design purpose --}} <p></p>  {{-- p tag for design purpose --}}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="panel panel-primary">
                            {{-- checkboxes --}}
                            <div class="panel-body">
                                <div class="row">
                                    @foreach(\App\Enums\DocType::toArray() as $index => $flag)
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input class="checkbox-inline" style="margin-left:30px; width: 15px; height: 15px"
                                                type="checkbox" name='{{\App\Enums\DocType::getKey($flag)}}' id='{{\App\Enums\DocType::getKey($flag)}}'
                                                value="{{$flag}}" @if ( $branch->{\App\Enums\DocType::getKey($flag)} ) checked @endif>
                                                {{ Form::label('flag', trans('admin.'.\App\Enums\DocType::getKey($flag)),
                                                ['class' => 'control-label']) }}
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="row">
                                    @foreach(\App\Enums\PostEnum::toArray() as $index => $flag)
                                        <div class="col-md-6">
                                            <div class="form-check">
                                                <input class="checkbox-inline" style="margin-left:30px; width: 15px; height: 15px"
                                                type="checkbox" name='{{\App\Enums\PostEnum::getKey($flag)}}' id='{{\App\Enums\PostEnum::getKey($flag)}}'
                                                value="{{$flag}}" @if ( $branch->{\App\Enums\PostEnum::getKey($flag)} ) checked @endif>
                                                {{ Form::label('flag', trans('admin.'.\App\Enums\PostEnum::getKey($flag)),
                                                ['class' => 'control-label']) }}
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <br>

                                {{-- الضريبه المضافه - مصروفات --}}
                                <div class="row">
                                    <div class="form-group">
                                        <div class="col-md-4">
                                            <label>{{trans('admin.tax_outcome')}}</label>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="text" name="Acc_TaxExtraDb" id="Acc_TaxExtraDb" class="form-control"
                                            value="{{$branch->Acc_TaxExtraDb}}">
                                        </div>
                                    </div>
                                </div>
                                {{-- نهاية الضريبه المضافه - مصروفات --}}

                                <br>

                                {{-- الضريبه المضافه - ايرادات --}}
                                <div class="row">
                                    <div class="form-group">
                                        <div class="col-md-4">
                                            <label>{{trans('admin.tax_income')}}</label>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="text" name="Acc_TaxExtraCR" id="Acc_TaxExtraCR" class="form-control"
                                            value="{{$branch->Acc_TaxExtraCR}}">
                                        </div>
                                    </div>
                                </div>
                                {{-- نهاية الضريبه المضافه - ايرادات --}}
                                <br><br><br><br>
                            </div>
                            {{-- checkboxes end --}}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="panel-title">
                                    {{trans('admin.accounting')}}
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    {{-- المبيعات و المشتريات --}}
                                    <div class="col-md-6">
                                        {{-- المبيعات --}}
                                        {{-- مبيعات اجله --}}
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">{{trans('admin.future_sales')}}</label>
                                                <input type="text" name="Acc_CrdSal" id="Acc_CrdSal" class="form-control" value="{{$branch->Acc_CrdSal}}">
                                            </div>
                                        </div>
                                        {{-- نهاية مبيعات اجله --}}

                                        {{-- مبيعات نقديه --}}
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">{{trans('admin.cash_sales')}}</label>
                                                <input type="text" name="Acc_CshSal" id="Acc_CshSal" class="form-control" value="{{$branch->Acc_CshSal}}">
                                            </div>
                                        </div>
                                        {{-- نهاية مبيعات نقديه --}}

                                        {{-- مرتجع المبيعات --}}
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">{{trans('admin.sales_returns')}}</label>
                                                <input type="text" name="Acc_RetSal" id="Acc_RetSal" class="form-control" value="{{$branch->Acc_RetSal}}">
                                            </div>
                                        </div>
                                        {{-- نهاية مرتجع المبيعات --}}

                                        {{-- خصم   المبيعات --}}
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">{{trans('admin.allowed_cash_disc')}}</label>
                                                <input type="text" name="Acc_DiscSal" id="Acc_DiscSal" class="form-control" value="{{$branch->Acc_DiscSal}}">
                                            </div>
                                        </div>
                                        {{-- نهاية خصم المبيعات --}}
                                        {{-- نهاية المبيعات --}}

                                        {{-- المشتريات --}}
                                        {{-- مشتريات اجله --}}
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">{{trans('admin.future_purchases')}}</label>
                                                <input type="text" name="Acc_CrdPur" id="Acc_CrdPur" class="form-control" value="{{$branch->Acc_CrdPur}}">
                                            </div>
                                        </div>
                                        {{-- نهاية مشتريات اجله --}}

                                        {{-- مشتريات نقديه --}}
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">{{trans('admin.cash_purchases')}}</label>
                                                <input type="text" name="Acc_CshPur" id="Acc_CshPur" class="form-control" value="{{$branch->Acc_CshPur}}">
                                            </div>
                                        </div>
                                        {{-- نهاية مشتريات نقديه --}}

                                        {{-- مرتجع مشتريات --}}
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">{{trans('admin.purchases_returns')}}</label>
                                                <input type="text" name="Acc_RetPur" id="Acc_RetPur" class="form-control" value="{{$branch->Acc_RetPur}}">
                                            </div>
                                        </div>
                                        {{-- نهاية مرتجع مشتريات --}}

                                        {{-- خصم المشتريات --}}
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">{{trans('admin.cash_discount')}}</label>
                                                <input type="text" name="Acc_DiscPur" id="Acc_DiscPur" class="form-control" value="{{$branch->Acc_DiscPur}}">
                                            </div>
                                        </div>
                                        {{-- نهاية خصم المشتريات --}}
                                        {{-- نهاية المشتريات --}}
                                    </div>
                                    {{-- نهاية المبيعات و المشتريات --}}

                                    {{-- GL. Account --}}
                                    <div class="col-md-6">
                                        {{-- حساب العملاء و الموردين --}}
                                        <div class="row">
                                            {{-- حساب الصندوق --}}
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">{{trans('admin.fund_account')}}</label>
                                                    <input type="text" name="Acc_Cashier" id="Acc_Cashier" class="form-control" value="{{$branch->Acc_Cashier}}">
                                                </div>
                                            </div>
                                            {{-- نهاية حساب الصندوق --}}

                                            {{-- حساب  ذمم العملاء --}}
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">{{trans('admin.clients_accounting')}}</label>
                                                    <input type="text" name="Acc_Customer" id="Acc_Customer" class="form-control" value="{{$branch->Acc_Customer}}">
                                                </div>
                                            </div>
                                            {{-- نهاية حساب ذمم العملاء --}}

                                            {{-- حساب ذمم الموردين --}}
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">{{trans('admin.suppliers_accounting')}}</label>
                                                    <input type="text" name="Acc_Suplier" id="Acc_Suplier" class="form-control" value="{{$branch->Acc_Suplier}}">
                                                </div>
                                            </div>
                                            {{-- نهاية حساب ذمم الموردين --}}
                                        </div>
                                        {{-- نهاية حساب العملاء و الموردين --}}

                                        {{-- المخزون --}}
                                        <div class="row">
                                            {{-- المخزون تحت التشغيل --}}
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">{{trans('admin.inventory_running')}}</label>
                                                    <input type="text" name="Inv_Undprs" id="Inv_Undprs" class="form-control" value="{{$branch->Inv_Undprs}}">
                                                </div>
                                            </div>
                                            {{-- نهاية المخزون تحت الشتغيل --}}

                                            {{-- مخزون المواد الخام --}}
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">{{trans('admin.raw_material_stock')}}</label>
                                                    <input type="text" name="Inv_RM" id="Inv_RM" class="form-control" value="{{$branch->Inv_RM}}">
                                                </div>
                                            </div>
                                            {{-- نهاية مخزون المواد الخام --}}

                                            {{-- مخزون تحت الانتاج --}}
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">{{trans('admin.full_production_stock')}}</label>
                                                    <input type="text" name="Inv_Prdctn" id="Inv_Prdctn" class="form-control" value="{{$branch->Inv_Prdctn}}">
                                                </div>
                                            </div>
                                            {{-- نهاية مخزون تحت الانتاج --}}
                                        </div>
                                        {{-- نهاية المخزون --}}

                                        {{-- تكلفة المخزون و المبيعات --}}
                                        <div class="row">
                                            {{-- تكلفة المبيعات --}}
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">{{trans('admin.cost_of_sales')}}</label>
                                                    <input type="text" name="Cost_SalInvt" id="Cost_SalInvt" class="form-control" value="{{$branch->Cost_SalInvt}}">
                                                </div>
                                            </div>
                                            {{-- نهاية تكلفة المبيعات --}}

                                            {{-- المخزون بالتكلفه --}}
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">{{trans('admin.inventory_at_cost')}}</label>
                                                    <input type="text" name="Cost_INVt" id="Cost_INVt" class="form-control" value="{{$branch->Cost_INVt}}">
                                                </div>
                                            </div>
                                            {{-- نهاية المخزون بالتكلفه --}}

                                            {{--  تسوية المخزون --}}
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">{{trans('admin.unrealized_profits')}}</label>
                                                    <input type="text" name="Acc_InvAdj" id="Acc_InvAdj" class="form-control" value="{{$branch->Acc_InvAdj}}">
                                                </div>
                                            </div>
                                            {{-- نهاية  تسوية المخزون --}}
                                        </div>
                                        {{-- نهاية تكلفة المخزون و المبيعات --}}
                                    </div>
                                    {{-- GL. Account end --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        {!! Form::close() !!}
    </div>
    @endcan
@else
    <div class="alert alert-danger">{{trans('admin.you_cannt_see_invoice_because_you_dont_have_role_to_access')}}</div>

    @endhasrole







@endsection
