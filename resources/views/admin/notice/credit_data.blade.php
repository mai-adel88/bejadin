<div class="col-md-6">
    <div class="panel panel-primary panel-H ">
        <div class="panel-heading panel-A">
            <div class="panel-title panel_1">
                {{trans('admin.information_account')}}
            </div>
        </div>

        <input type="text" name="getSalNo" id="getSalNo" value="{{$trns->Slm_No}}" hidden>
        <input type="text" name="getSalName" id="getSalName"
               value="{{\App\Models\Admin\AstSalesman::where('Slm_No', $trns->Slm_No)->pluck('Slm_Nm'.ucfirst(session('lang')))->first()}}" hidden>
        <div class="panel-body">
            <input type="text" name="Ln_No" id="Ln_No" value="{{$trns->Ln_No}}" hidden>
            {{-- الحساب الرئيسى --}}
            <div class="row">
                <div class="col-md-8">
                    <label for="main_acc">{{trans('admin.main_account_chart')}}</label>
                    <input type="text" name="main_acc" id="main_acc" class="form-control" disabled
                           value="{{\App\Models\Admin\MtsChartAc::where('Acc_No', $trns->Acc_No)->pluck('Acc_Nm'.ucfirst(session('lang')))->first()}}">
                </div>
                <div class="col-md-4">
                    <label for="Acc_No"></label>
                    <input type="text" name="Acc_No" id="Acc_No" class="form-control" disabled value="{{$trns->Acc_No}}">
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
                            <option value="{{$key}}" @if($trns->Ac_Ty == $key) selected @endif>{{$value}}</option>
                        @endforeach
                    </select>
                </div>
                {{-- رقم حساب العملاء - رقم حساب الموظفين - رقم حساب الموردين - .... --}}
                <div class="col-md-6">
                    <label for="Acc_No_Select"></label>
                    <select name="Acc_No_Select" id="Acc_No_Select" class="form-control select2">
                        <option value="{{null}}">{{trans('admin.select')}}</option>
                        @if(count($subAccs) > 0)
                            @foreach($subAccs as $sub)
                                <option value="{{$sub->no}}" @if($sub->no == $trns->Sysub_Account) selected @endif>{{$sub->name}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                {{-- رقم العميل - رقم المورد - رقم الموظف --}}
                <div class="col-md-3">
                    <label for="Sysub_Account"></label>
                    <input type="text" name="Sysub_Account" id="Sysub_Account" class="form-control" value="{{$trns->Sysub_Account}}">
                </div>
            </div>
            {{-- نهاية نوع الحساب --}}

            <div class="row">
                {{-- المبلغ دائن --}}
                <div class="col-md-4">
                    <label for="Tr_Cr">{{trans('admin.amount_cr')}}</label>
                    <input style="background-color: #e9ea92;" type="text" name="Tr_Cr" id="Tr_Cr" class="form-control" value="{{$trns->Tr_Cr}}">
                </div>
                {{-- نهاية المبلغ دائن --}}
                {{-- رقم المستند --}}
                <div class="col-md-4">
                    <label for="Dc_No">{{trans('admin.receipt_number')}}</label>
                    <input type="text" name="Dc_No" id="Dc_No" class="form-control" value="{{$trns->Dc_No}}">
                </div>
                {{-- نهاية رقم المستند --}}
                {{-- مركز التكلفه --}}
                <div class="col-md-4" id="Costcntr_No_content">
                    <label for="Costcntr_No">{{trans('admin.with_cc')}}</label>
                    <select name="Costcntr_No" id="Costcntr_No" class="form-control select2">
                        @if(count($cost_center) > 0)
                            @foreach($cost_center as $cc)
                                <option value="{{$cc->Costcntr_No}}" @if($trns->Costcntr_No == $cc->Costcntr_No) selected @endif>
                                    {{ $cc->{'Costcntr_Nm'.session('lang')} }}
                                </option>
                            @endforeach
                        @else
                            <option value="{{null}}">{{trans('admin.nodata')}}</option>
                        @endif
                    </select>
                </div>
                {{-- نهاية مركز التكلفه --}}
            </div>
            <div class="row">
                {{-- البيان عربى --}}
                <div class="col-md-12">
                    <br>
                    <label for="Tr_Ds" class="col-md-2">{{trans('admin.Statement_ar')}}</label>
                    <input type="text" name="Tr_Ds" id="Tr_Ds" class="form-control col-md-6" value="{{$trns->Tr_Ds}}">
                </div>
                {{-- نهاية البيان عربى --}}
                {{-- البيان انجليزى --}}
                <div class="col-md-12">
                    <br>
                    <label for="Tr_Ds1" class="col-md-2">{{trans('admin.Statement_en')}}</label>
                    <input type="text" name="Tr_Ds1" id="Tr_Ds1" class="form-control col-md-6" value="{{$trns->Tr_Ds1}}">
                    <button style="margin-right: 10px" class="btn btn-primary panel-A col-md-3" id="add_line">{{trans('admin.add_line')}}</button>
                </div>
                {{-- نهاية البيان انجليزى --}}
            </div>
        </div>
    </div>
</div>
