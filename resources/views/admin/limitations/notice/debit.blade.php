<div class="row Debit" id="Debit">
    <br>
    {{-- بيانات الحساب المدين --}}
    <div class="col-md-6">
        <div class="panel panel-primary panel-H">
            <div class="panel-heading panel-A panel-A">
                <div class="panel-title">
                    {{trans('admin.dept_account')}}
                </div>
            </div>
            <div class="panel-body">
                {{-- الحساب الرئيسى --}}
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
                {{-- نهاية الحساب الرئيسى --}}
                {{-- نوع الحساب --}}
                <div class="row">
                    {{-- نوع الحساب عملاء - موردين - موظفين - .... --}}
                    <div class="col-md-2">
                        <label for="Ac_Ty">{{trans('admin.account_type')}}</label>
                        <select name="Ac_Ty" id="Ac_Ty" class="form-control Ac_Ty">
                            <option value="{{null}}">{{trans('admin.select')}}</option>
                            @foreach(\App\Enums\AccountType::toSelectArray() as $key => $value)
                                <option value="{{$key}}">{{$value}}</option>
                            @endforeach
                        </select>
                    </div>
                    {{-- رقم حساب العملاء - رقم حساب الموظفين - رقم حساب الموردين - .... --}}
                    <div class="col-md-7">
                        <label for="Acc_No_Select"></label>
                        <select name="Acc_No_Select" id="Acc_No_Select" class="form-control select2 Acc_No_Select">
                            <option value="{{null}}">{{trans('admin.select')}}</option>
                        </select>
                    </div>
                    {{-- رقم العميل - رقم المورد - رقم الموظف --}}
                    <div class="col-md-3">
                        <label for="Sysub_Account"></label>
                        <input type="text" name="Sysub_Account" id="Sysub_Account" class="form-control Sysub_Account">
                    </div>
                </div>
                {{-- نهاية نوع الحساب --}}

                <div class="row">
                    {{-- المبلغ مدين --}}
                    <div class="col-md-4">
                        <label for="Tr_Db">{{trans('admin.amount_db')}}</label>
                        <input type="text" disabled name="Tr_Db" id="Tr_Db" class="form-control Tr_Db">
                    </div>
                    {{-- نهاية المبلغ دائن --}}
                    {{-- رقم المستند --}}
                    <div class="col-md-4">
                        <label for="Dc_No_Db">{{trans('admin.receipt_number')}}</label>
                        <input type="text" name="Dc_No_Db" id="Dc_No_Db" class="form-control Dc_No_Db">
                    </div>
                    {{-- نهاية رقم المستند --}}
                    {{-- مركز التكلفه --}}
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
                    {{-- نهاية مركز التكلفه --}}
                </div>
                <div class="row">
                    {{-- البيان عربى --}}
                    <div class="col-md-12">
                        <br>
                        <label for="Tr_Ds_Db" class="col-md-2">{{trans('admin.Statement_ar')}}</label>
                        <input type="text" name="Tr_Ds_Db" id="Tr_Ds_Db" class="form-control col-md-6 Tr_Ds_Db">
                    </div>
                </div>

                {{-- نهاية البيان عربى --}}
                <div class="row">
                    {{-- البيان انجليزى --}}
                    <div class="col-md-12">
                        <br>
                        <label for="Tr_Ds1" class="col-md-2">{{trans('admin.Statement_en')}}</label>
                        <input type="text" name="Tr_Ds1" id="Tr_Ds1" class="form-control col-md-6">
                        <button style="margin-right: 10px" class="btn btn-primary panel-A col-md-3" id="add_line">{{trans('admin.add_line')}}</button>
                    </div>
                    {{-- نهاية البيان انجليزى --}}
                    {{-- اضافة سطر --}}

                    {{-- نهاية اضافة سطر --}}
                </div>
            </div>
        </div>
    </div>
    {{-- نهاية بيانات الحساب المدين --}}
    {{-- بيانات الحساب الدائن --}}
    <div class="col-md-6">
        <div class="panel panel-primary panel-H">
            <div class="panel-heading panel-A">
                <div class="panel-title">
                    {{trans('admin.information_account')}}
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                    {{-- الصندوق الرئيسى --}}
                    <div class="col-md-6">
                        <label for="Tr_Db_Select">{{trans('admin.allowed')}}</label>
                        <select name="Tr_Db_Select" id="Tr_Db_Select" class="form-control Tr_Db_Select">
                            @if(count($banks) > 0)
                                @foreach($banks as $bnk)
                                    <option value="{{$bnk->Acc_No}}">{{$bnk->{'Acc_Nm'.ucfirst(session('lang'))} }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="Tr_Db_Acc_No"></label>
                        <input type="text" name="Tr_Db_Acc_No" id="Tr_Db_Acc_No" class="form-control Tr_Db_Acc_No">
                    </div>
                    {{-- بيانات الصندوق الرئيسى --}}
                    {{-- رقم المستند --}}
                    <div class="col-md-3">
                        <label for="">{{trans('admin.receipt_number')}}</label>
                        <input type="text" name="Dc_No" id="Dc_No" class="form-control Dc_No">
                    </div>
                    {{-- نهاية رقم المستند --}}
                </div>
                {{-- البيان --}}
                <div class="row">
                    <div class="col-md-12">
                        <br>
                        <label for="Tr_Ds" class="col-md-2">{{trans('admin.note_ar')}}</label>
                        <input type="text" name="Tr_Ds" id="Tr_Ds" class="form-control col-md-10 Tr_Ds">
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
                                <input type="text" name="Tr_Db_Db" id="Tr_Db_Db" class="form-control Tr_Db_Db" value='0.00'>
                            </div>
                            {{-- نهاية مدين --}}
                            {{-- دائن --}}
                            <div class="col-md-3">
                                <label for="Tr_Cr_Db">{{trans('admin.Fbal_CR_')}}</label>
                                <input type="text" disabled name="Tr_Cr_Db" id="Tr_Cr_Db" class="form-control Tr_Cr_Db" value='0.00'>
                            </div>
                            {{-- نهاية دائن --}}
                            {{-- الفرق --}}
                            <div class="col-md-3">
                                <label for="Tr_Dif">{{trans('admin.subtract')}}</label>
                                <input type="text" name="Tr_Dif" id="Tr_Dif" class="form-control Tr_Dif" disabled>
                            </div>
                            {{-- نهاية الفرق --}}
                            {{-- الرصيد الحالى --}}
                            <div class="col-md-3">
                                <label for="Crnt_Blnc">{{trans('admin.current_balance')}}</label>
                                <input type="text" name="Crnt_Blnc" id="Crnt_Blnc" class="form-control">
                            </div>
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
