<script>
    $(document).ready(function(){
        $('[data-toggle="save"]').tooltip();
    });
</script>
{!! Form::open(['method'=>'POST','route' => ['departments.store'], 'id' => 'edit_form','files' => true]) !!}
    {{csrf_field()}}
    {{-- Parnt_Acc --}}
    <input type="text" name="Parnt_Acc" id="Parnt_Acc" value="{{$parent? $parent->Acc_No : null}}" hidden>
    <input type="text" name="Cmp_No" id="Cmp_No" value="{{$parent? $parent->Cmp_No : null}}" hidden>
    <input type="text" name="Level_No" id="Level_No" value="{{$parent? $parent->Level_No : null}}" hidden>
    <input type="text" name="Level_Status" id="Level_No" value="{{1}}" hidden>
    {{-- Parnt_Acc end --}}

    <div class="row">
        <div class="col-md-1 pull-left">
            <button type="submit" class="btn btn-primary pull-left"
                    data-toggle="save"
                    title="{{trans('admin.save')}}"
                    data-placement="bottom">
                <i class="fa fa-floppy-o" aria-hidden="true"></i>
            </button>
        </div>

        {{-- رقم الحساب --}}
        <label for="Acc_No" class="col-md-2">{{trans('admin.account_number')}}:</label>
        <input type="text" name="Acc_No" id="Acc_No" class="form-control col-md-2" value="{{$Acc_No}}">
        {{-- رقم الحساب --}}

        {{-- تصنيف الحساب --}}
        <div class="form-group col-md-3">
            @foreach(\App\Enums\dataLinks\TypeAccountType::toSelectArray() as $key => $value)
                <input class="checkbox-inline" type="radio"
                    name="Level_Status" id="Level_Status" value="{{$key}}"
                    style="margin: 3px;" @if($key == 1) checked @endif>
                <label>{{$value}}</label>
            @endforeach
        </div>
        {{-- نهاية تصنيف الحساب --}}

        {{-- فعال \ غير فعال --}}
        <div class="form-group col-md-4">
            <input class="checkbox-inline" type="checkbox"
                name="Acc_Actv" id="Acc_Actv" value="1"
                style="margin: 3px;" checked>
            <label>{{trans('admin.active')}}</label>
        </div>
        {{-- فعال \ غير فعال --}}

        {{-- طبيعة الحساب --}}
        <div class="form-group col-md-12 col-md-offset-2 branch">
            <label for="Acc_Ntr" style="margin-left:15px;">{{trans('admin.category')}}:</label>
            @foreach(\App\Enums\dataLinks\CategoryAccountType::toSelectArray() as $key => $value)
                <input class="checkbox-inline" type="radio"
                    name="Acc_Ntr" id="Acc_Ntr" value="{{$key}}"
                    style="margin: 3px;">
                <label>{{$value}}</label>
            @endforeach
        </div>
        {{-- نهاية طبيعة الحساب --}}
    </div>

    {{-- اسم الحساب عربى --}}
    <div class="form-group row">
        <label class="col-md-2" for="Acc_NmAr">{{trans('admin.account_name')}}:</label>
            <input type="text" name="Acc_NmAr" id="Acc_NmAr" class="col-md-9 form-control">
        </div>
    {{-- نهاية اشم الحساب عربى --}}

    {{-- اسم الحساب انجليزى --}}
    <div class="form-group row">
        <label class="col-md-2" for="Acc_NmEn">{{trans('admin.account_name_en')}}:</label>
        <input type="text" name="Acc_NmEn" id="Acc_NmEn" class=" col-md-9 form-control">
    </div>
    {{-- نهاية اسم الحساب انجليزى --}}

    <div class="col-md-6">
        <div class="row">
            {{-- رصيد اول المده مدين --}}
            <div class="col-md-12 branch">
                <div class="form-group row">
                    <label for="Fbal_DB" class="col-md-5">{{trans('admin.first_date_debtor')}}</label>
                    <input type="text" name="Fbal_DB" id="Fbal_DB" class="form-control col-md-7" value="{{0}}">
                </div>
            </div>
            {{-- نهايةرصيد اول المده مدين --}}

            {{-- رصيد اول المده دائن --}}
            <div class="col-md-12 branch">
                <div class="form-group row">
                    <label for="Fbal_CR" class="col-md-5">{{trans('admin.first_date_creditor')}}</label>
                    <input type="text" name="Fbal_CR" id="Fbal_CR" value='{{0}}' class="form-control col-md-7">
                </div>
            </div>
            {{-- نهاية رصيد اول المده دائن --}}

            {{-- رصيد اول المده دائن --}}
            <div class="col-md-12 branch">
                <div class="form-group row">
                    <label for="Cr_Blnc" class="col-md-5">{{trans('admin.credit_balance')}}</label>
                    <input type="text" name="Cr_Blnc" id="Cr_Blnc" value='{{0}}' class="form-control col-md-7">
                </div>
            </div>
            {{-- نهاية رصيد اول المده دائن --}}
        </div>
    </div>

    <div class="col-md-6">
        <div class="row">
            {{-- نوع الحساب --}}
            <div class="col-md-12 branch">
                <label for="Clsacc_No1" class="col-md-5 col-md-offset-1">{{trans('admin.account_type')}}</label>
                <div class="form-group">
                    <select name="Acc_Typ" id="Acc_Typ" class="form-control col-md-6">
                        <option value="{{null}}">{{trans('admin.select')}}</option>
                        @foreach(\App\Enums\AccountType::toSelectArray() as $key => $value)
                            <option value="{{$key}}">{{$value}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            {{-- نهاية نوع الحساب --}}

            {{-- بند الميزانيه --}}
            <div class="col-md-12 branch">
                <input class="checkbox-inline col-md-1" type="checkbox" id='Clsacc_No1_Check'>
                <label for="Clsacc_No1" class="col-md-5">{{trans('admin.Clsacc_No1')}}</label>

                <div class="form-group">
                    <select name="Clsacc_No1" id="Clsacc_No1" class="form-control col-md-6 hidden">
                        <option value="{{null}}">{{trans('admin.select')}}</option>
                        @if(count($balances) > 0)
                            @foreach($balances as $blnc)
                                <option value="{{$blnc->CLsacc_No}}">
                                    {{$blnc->{'CLsacc_Nm'.ucfirst(session('lang'))} }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
            {{-- نهاية بند الميزانيه --}}

            {{-- حسابات قائمة الدخل --}}
            <div class="col-md-12 branch">
                <input class="checkbox-inline col-md-1 checks" type="checkbox" id='Clsacc_No2_Check'>
                <label for="Clsacc_No2" class="col-md-5">{{trans('admin.Clsacc_No2')}}</label>

                <div class="form-group">
                    <select name="Clsacc_No2" id="Clsacc_No2" class="form-control col-md-6 hidden">
                        <option value="{{null}}">{{trans('admin.select')}}</option>
                        @if(count($incomes) > 0)
                            @foreach($incomes as $income)
                                <option value="{{$income->CLsacc_No}}">
                                    {{$income->{'CLsacc_Nm'.ucfirst(session('lang'))} }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
            {{-- نهاية الحسابات قائمة الدخل --}}


            {{-- مركز التكلفه --}}
            <div class="col-md-12 branch">
                <input class="checkbox-inline col-md-1 checks" type="checkbox" id='cc_type_Check'>
                <label for="Clsacc_No3" class="col-md-5">{{trans('admin.with_cc')}}</label>

                <div class="form-group">
                    <select name="Clsacc_No3" id="cc_type" class="form-control col-md-6 hidden">
                        <option value="{{null}}">{{trans('admin.select')}}</option>
                         @foreach($costcntrc as $cc)
                            <option value="{{$cc->Costcntr_No}}">{{$cc->Costcntr_Nmar}}</option>
                         @endforeach
                    </select>
                </div>
            </div>
            {{-- نهاية مركز التكلفه --}}
        </div>
    </div>

{!! Form::close() !!}
{{-- الحركات --}}
<div class="col-md-12">
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">الشهر</th>
            <th scope="col">الحركة مدين</th>
            <th scope="col">الحركة دائن</th>
            <th scope="col">الرصيد الحالى</th>
            <th scope="col"> رصيد تقديرى</th>
        </tr>
        </thead>
        <tbody>

        <tr>
            <th scope="row">يناير</th>
            <td>
                0.00
            </td>
            <td>
                0.00
            </td>
            <td>
                0
            </td>
        </tr>
        <tr>
            <th scope="row">فبراير</th>
            <td>
                0.00
            </td>
            <td>
                0.00
            </td>
            <td>
                0
            </td>
        </tr>
        <tr>
            <th scope="row">مارس</th>
            <td>
                0.00
            </td>
            <td>
                0.00
            </td>
            <td>
                0
            </td>
        </tr>
        <tr>
            <th scope="row">ابريل</th>
            <td>
                0.00
            </td>
            <td>
                0.00
            </td>
            <td>
                0
            </td>
        </tr>
        <tr>
            <th scope="row">مايو</th>
            <td>
                0.00
            </td>
            <td>
                0.00
            </td>
            <td>
                0
            </td>
        </tr>
        <tr>
            <th scope="row">يونيو</th>
            <td>
                0.00
            </td>
            <td>
                0.00
            </td>
            <td>
                0
            </td>
        </tr>
        <tr>
            <th scope="row">يوليو</th>
            <td>
                0.00
            </td>
            <td>
                0.00
            </td>
            <td>
                0
            </td>
        </tr>
        <tr>
            <th scope="row">اغسطس</th>

            <td>
                0.0
            </td>
            <td>
                0.00
            </td>
            <td>
                0
            </td>
        </tr>
        <tr>
            <th scope="row">سبتمبر</th>

            <td>
                0.00
            </td>
            <td>
                0.00
            </td>
            <td>
                0
            </td>
        </tr>
        <tr>
            <th scope="row">أكتوبر</th>

            <td>
                0.00
            </td>
            <td>
                0.00
            </td>
            <td>
                0
            </td>
        </tr>
        <tr>
            <th scope="row">نوفمبر</th>

            <td>
                0.00
            </td>
            <td>
                0.00
            </td>
            <td>
                0
            </td>
        </tr>
        <tr>
            <th scope="row">ديسمبر</th>

            <td>
                0.00
            </td>
            <td>
                0.00
            </td>
            <td>
                0
            </td>
        </tr>

        <tr style="background-color: #d3d9df">
            <th scope="row">الإجمالى</th>

            <td>
                0
            </td>
            <td>
                0
            </td>
            <td>
                0
            </td>
        </tr>
        </tbody>
    </table>
</div>
{{-- نهاية الحركات --}}
