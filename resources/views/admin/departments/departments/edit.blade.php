<script>
    $(document).ready(function(){
        $('[data-toggle="save"]').tooltip();
        $('[data-toggle="delete"]').tooltip();

        $('#delete_button').click(function(e){
            e.preventDefault();
            $('#delete_form').submit()
        });
    });

    $('#Clsacc_No1_Check').on('change', function(){
        if($(this).is(':checked')){
            $('#Clsacc_No1').removeClass('hidden');
        }
        else{
            $('#Clsacc_No1').addClass('hidden');
            $('#Clsacc_No1').val(null);
        }
    });

    $('#Clsacc_No2_Check').on('change', function(){
        if($(this).is(':checked')){
            $('#Clsacc_No2').removeClass('hidden');
        }
        else{
            $('#Clsacc_No2').addClass('hidden');
            $('#Clsacc_No2').val(null);
        }
    });

    $('#cc_type_Check').on('change', function(){
        if($(this).is(':checked')){
            $('#cc_type').removeClass('hidden');
        }
        else{
            $('#cc_type').addClass('hidden');
            $('#cc_type').val(null);
        }
    });

    $('#edit_form :radio[id=Level_Status]').change(function(){
        if($(this).is(':checked')){
            if($(this).val() == 1){
                $('.branch').removeClass('hidden');
            }
            else{
                $('.branch').addClass('hidden');
                $('#Acc_Ntr').val(null);
                $('#Fbal_DB').val(0);
                $('#Fbal_CR').val(0);
                $('#Cr_Blnc').val(0);
                $('#Acc_Typ').val(null);
                $('#Clsacc_No1').val(null);
                $('#Clsacc_No2').val(null);
                $('#cc_type').val(null);
            }
        }
    });
</script>
{!! Form::open(['method'=>'POST','route' => ['departments.update', $chart_item->Acc_No? $chart_item->Acc_No : null], 'id' => 'edit_form','files' => true]) !!}
    {{csrf_field()}}
    {{method_field('PUT')}}
    @if($children)  
        @foreach($children as $child)
            <input type="hidden" name="children[]" value='{{$child}}'>
        @endforeach
    @endif
    
    <div class="row">
        <div class="col-md-3 pull-left">
            <button type="submit" class="btn btn-primary"
                    data-toggle="save" 
                    title="{{trans('admin.save')}}"
                    data-placement="bottom">
                <i class="fa fa-floppy-o" aria-hidden="true"></i>
            </button>
            <button type="submit" class="btn btn-danger" id="delete_button"
                    data-toggle="delete" 
                    title="{{trans('admin.delete')}}"
                    data-placement="bottom">
                <i class="fa fa-trash-o" aria-hidden="true"></i>
            </button>
        </div>

        {{-- رقم الحساب --}}
        <label for="Acc_No" class="col-md-2">{{trans('admin.account_number')}}:</label>
        <input type="text" name="Acc_No" id="Acc_No" class="form-control col-md-2" value="{{$chart_item->Acc_No}}">
        {{-- رقم الحساب --}}

        {{-- تصنيف الحساب --}}
        <div class="form-group col-md-3">
            @foreach(\App\Enums\dataLinks\TypeAccountType::toSelectArray() as $key => $value)
                <input class="checkbox-inline" type="radio" 
                    name="Level_Status" id="Level_Status" value="{{$key}}" disabled
                    @if ($chart_item->Level_Status == $key) checked @endif>
                <label>{{$value}}</label>
            @endforeach
        </div>
        {{-- نهاية تصنيف الحساب --}}

        {{-- فعال \ غير فعال --}}
        <div class="form-group col-md-2" @if($chart_item->Level_No == 1) hidden @endif>
            <input class="checkbox-inline" type="checkbox" 
                name="Acc_Actv" id="Acc_Actv" value="{{$chart_item->Acc_Actv}}"
                style="margin: 3px;" @if($chart_item->Acc_Actv == 1) checked @endif>
            <label>{{trans('admin.active')}}</label>
        </div>
        {{-- نهاية فعال \ غير فعال --}}

        {{-- طبيعة الحساب --}}
        <div class="form-group col-md-12 col-md-offset-2 branch">
            <label for="Acc_Ntr" style="margin-left:15px;">{{trans('admin.category')}}:</label>
            @foreach(\App\Enums\dataLinks\CategoryAccountType::toSelectArray() as $key => $value)
                <input class="checkbox-inline" type="radio" 
                    name="Acc_Ntr" id="Acc_Ntr" value="{{$key}}"
                    style="margin: 3px;" 
                    @if($chart_item->Level_No == 1) disabled @endif
                    @if ($chart_item->Acc_Ntr == $key) checked @endif>
                <label>{{$value}}</label>
            @endforeach
        </div>
        {{-- نهاية طبيعة الحساب --}}
    </div>

    {{-- اسم الحساب عربى --}}
    <div class="form-group row">
        <label class="col-md-2" for="Acc_NmAr">{{trans('admin.account_name')}}:</label>
            <input type="text" name="Acc_NmAr" id="Acc_NmAr" class="col-md-9 form-control"  
            value="{{$chart_item->Acc_NmAr? $chart_item->Acc_NmAr : null}}">
        </div>
    {{-- نهاية اشم الحساب عربى --}}

    {{-- اسم الحساب انجليزى --}}
    <div class="form-group row">
        <label class="col-md-2" for="Acc_NmEn">{{trans('admin.account_name_en')}}:</label>
        <input type="text" name="Acc_NmEn" id="Acc_NmEn" class=" col-md-9 form-control" 
            value="{{$chart_item->Acc_NmEn? $chart_item->Acc_NmEn : null}}">
    </div>
    {{-- نهاية اسم الحساب انجليزى --}}

    <div class="col-md-6">
        <div class="row">
            {{-- رصيد اول المده مدين --}}
            <div class="col-md-12 branch">
                <div class="form-group row">
                    <label for="Fbal_DB" class="col-md-5">{{trans('admin.first_date_debtor')}}</label>
                    <input type="text" name="Fbal_DB" id="Fbal_DB" value='{{$chart_item->Fbal_DB? $chart_item->Fbal_DB : 0}}'
                    class="form-control col-md-7"
                    @if($chart_item->Level_No == 1) disabled @endif>
                </div>
            </div>
            {{-- نهايةرصيد اول المده مدين --}}

            {{-- رصيد اول المده دائن --}}
            <div class="col-md-12 branch">
                <div class="form-group row">
                    <label for="Fbal_CR" class="col-md-5">{{trans('admin.first_date_creditor')}}</label>
                    <input type="text" name="Fbal_CR" id="Fbal_CR" value='{{$chart_item->Fbal_CR? $chart_item->Fbal_CR : 0}}' 
                    class="form-control col-md-7"
                    @if($chart_item->Level_No == 1) disabled @endif>
                </div>
            </div>
            {{-- نهاية رصيد اول المده دائن --}}

            {{-- رصيد اول المده دائن --}}
            <div class="col-md-12 branch">
                <div class="form-group row">
                    <label for="Cr_Blnc" class="col-md-5">{{trans('admin.credit_balance')}}</label>
                    <input type="text" name="Cr_Blnc" id="Cr_Blnc" value='{{$chart_item->Cr_Blnc? $chart_item->Cr_Blnc : 0}}' 
                    class="form-control col-md-7"
                    @if($chart_item->Level_No == 1) disabled @endif>
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
                    <select name="Acc_Typ" id="Acc_Typ" class="form-control col-md-6"
                        @if($chart_item->Level_No == 1) disabled @endif>
                        <option value="{{null}}">{{trans('admin.select')}}</option>
                        @foreach(\App\Enums\AccountType::toSelectArray() as $key => $value)
                            <option value="{{$key}}" 
                                @if($chart_item->Acc_Typ == $key) selected @endif>{{$value}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            {{-- نهاية نوع الحساب --}}

            {{-- بند الميزانيه --}}
            <div class="col-md-12 branch">
                <input class="checkbox-inline col-md-1" type="checkbox" id='Clsacc_No1_Check'
                    @if($chart_item->Level_No == 1) disabled @endif>
                <label for="Clsacc_No1" class="col-md-5">{{trans('admin.Clsacc_No1')}}</label>

                <div class="form-group">
                    <select name="Clsacc_No1" id="Clsacc_No1" class="form-control col-md-6"
                        @if($chart_item->Level_No == 1) disabled @endif>
                        <option value="{{null}}">{{trans('admin.select')}}</option>
                        @if(count($balances) > 0)
                            @foreach($balances as $blnc)
                                <option value="{{$blnc->CLsacc_No}}"  @if($chart_item->Clsacc_No1 == $blnc->CLsacc_No) selected @endif>
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
                <input class="checkbox-inline col-md-1 checks" type="checkbox" id='Clsacc_No2_Check'
                    @if($chart_item->Level_No == 1) disabled @endif>
                <label for="Clsacc_No2" class="col-md-5">{{trans('admin.Clsacc_No2')}}</label>

                <div class="form-group">
                    <select name="Clsacc_No2" id="Clsacc_No2" class="form-control col-md-6"
                        @if($chart_item->Level_No == 1) disabled @endif>
                        <option value="{{null}}">{{trans('admin.select')}}</option>
                        @if(count($incomes) > 0)
                            @foreach($incomes as $income)
                                <option value="{{$income->CLsacc_No}}"  @if($chart_item->Clsacc_No2 == $income->CLsacc_No) selected @endif>
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
                <input class="checkbox-inline col-md-1 checks" type="checkbox" id='cc_type_Check'
                    @if($chart_item->Level_No == 1) disabled @endif>
                <label for="cc_type" class="col-md-5">{{trans('admin.with_cc')}}</label>

                <div class="form-group">
                    <select name="cc_type" id="cc_type" class="form-control col-md-6"
                        @if($chart_item->Level_No == 1) disabled @endif>
                        <option value="{{null}}">{{trans('admin.select')}}</option>
                    </select>
                </div>
            </div>
            {{-- نهاية مركز التكلفه --}}
        </div>
    </div>                            
{!! Form::close() !!}
<form action="{{route('departments.destroy', $chart_item->Acc_No? $chart_item->Acc_No : null)}}" method="POST" id="delete_form">
    {{csrf_field()}}
    {{method_field('DELETE')}}
</form>
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
                @if($chart_item->DB11 == null)
                    0.00
                @else
                    {{$chart_item->DB11}}
                @endif
            </td>
            <td>
                @if($chart_item->CR11 == null )
                    0.00
                @else
                    {{$chart_item->CR11}}
                @endif
            </td>
            <td>
                {{$chart_item->DB11 - $chart_item->CR11}}
            </td>
        </tr>
        <tr>
            <th scope="row">فبراير</th>
            <td>
                @if($chart_item->DB12 == null )
                    0.00
                @else
                    {{$chart_item->DB12}}
                @endif
            </td>
            <td>
                @if($chart_item->CR12 == null )
                    0.00
                @else
                    {{$chart_item->CR12}}
                @endif
            </td>
            <td>
                {{$chart_item->DB12 - $chart_item->CR12}}
            </td>
        </tr>
        <tr>
            <th scope="row">مارس</th>
            <td>
                @if($chart_item->DB13 == null )
                    0.00
                @else
                    {{$chart_item->DB13}}
                @endif
            </td>
            <td>
                @if($chart_item->CR13 == null )
                    0.00
                @else
                    {{$chart_item->CR13}}
                @endif
            </td>
            <td>
                {{$chart_item->DB13 - $chart_item->CR13}}
            </td>
        </tr>
        <tr>
            <th scope="row">ابريل</th>
            <td>
                @if($chart_item->DB14 == null )
                    0.00
                @else
                    {{$chart_item->DB14}}
                @endif
            </td>
            <td>
                @if($chart_item->CR14 == null )
                    0.00
                @else
                    {{$chart_item->CR14}}
                @endif
            </td>
            <td>
                {{$chart_item->DB14 - $chart_item->CR14}}
            </td>
        </tr>
        <tr>
            <th scope="row">مايو</th>
            <td>
                @if($chart_item->DB15 == null )
                    0.00
                @else
                    {{$chart_item->DB15}}
                @endif
            </td>
            <td>
                @if($chart_item->CR15 == null )
                    0.00
                @else
                    {{$chart_item->CR15}}
                @endif
            </td>
            <td>
                {{$chart_item->DB15 - $chart_item->CR15}}
            </td>
        </tr>
        <tr>
            <th scope="row">يونيو</th>
            <td>
                @if($chart_item->DB16 == null )
                    0.00
                @else
                    {{$chart_item->DB16}}
                @endif
            </td>
            <td>
                @if($chart_item->CR16 == null )
                    0.00
                @else
                    {{$chart_item->CR16}}
                @endif
            </td>
            <td>
                {{$chart_item->DB16 - $chart_item->CR16}}
            </td>
        </tr>
        <tr>
            <th scope="row">يوليو</th>
            <td>
                @if($chart_item->DB17 == null )
                    0.00
                @else
                    {{$chart_item->DB17}}
                @endif
            </td>
            <td>
                @if($chart_item->CR17 == null )
                    0.00
                @else
                    {{$chart_item->CR17}}
                @endif
            </td>
            <td>
                {{$chart_item->DB17 - $chart_item->CR17}}
            </td>
        </tr>
        <tr>
            <th scope="row">اغسطس</th>

            <td>
                @if($chart_item->DB18 == null )
                    0.00
                @else
                    {{$chart_item->DB18}}
                @endif
            </td>
            <td>
                @if($chart_item->CR18 == null )
                    0.00
                @else
                    {{$chart_item->CR18}}
                @endif
            </td>
            <td>
                {{$chart_item->DB18 - $chart_item->CR18}}
            </td>
        </tr>
        <tr>
            <th scope="row">سبتمبر</th>

            <td>
                @if($chart_item->DB19 == null )
                    0.00
                @else
                    {{$chart_item->DB19}}
                @endif
            </td>
            <td>
                @if($chart_item->CR19 == null )
                    0.00
                @else
                    {{$chart_item->CR19}}
                @endif
            </td>
            <td>
                {{$chart_item->DB19 - $chart_item->CR19}}
            </td>
        </tr>
        <tr>
            <th scope="row">أكتوبر</th>

            <td>
                @if($chart_item->DB20 == null )
                    0.00
                @else
                    {{$chart_item->DB20}}
                @endif
            </td>
            <td>
                @if($chart_item->CR20 == null )
                    0.00
                @else
                    {{$chart_item->CR20}}
                @endif
            </td>
            <td>
                {{$chart_item->DB20 - $chart_item->CR20}}
            </td>
        </tr>
        <tr>
            <th scope="row">نوفمبر</th>

            <td>
                @if($chart_item->DB21 == null )
                    0.00
                @else
                    {{$chart_item->DB21}}
                @endif
            </td>
            <td>
                @if($chart_item->CR21 == null )
                    0.00
                @else
                    {{$chart_item->CR21}}
                @endif
            </td>
            <td>
                {{$chart_item->DB21 - $chart_item->CR21}}
            </td>
        </tr>
        <tr>
            <th scope="row">ديسمبر</th>

            <td>
                @if($chart_item->DB22 == null )
                    0.00
                @else
                    {{$chart_item->DB22}}
                @endif
            </td>
            <td>
                @if($chart_item->CR22 == null )
                    0.00
                @else
                    {{$chart_item->CR22}}
                @endif
            </td>
            <td>
                {{$chart_item->DB22 - $chart_item->CR22}}
            </td>
        </tr>

        <tr style="background-color: #d3d9df">
            <th scope="row">الإجمالى</th>

            <td>
                {{count($total) > 0? $total[0]->total_debit : 0.00}}
            </td>
            <td>
                {{count($total) > 0? $total[0]->total_credit : 0.00}}

            </td>
            <td>
                {{count($total) > 0? $total[0]->total_balance : 0.00}}
            </td>
        </tr>
        </tbody>
    </table>
</div>
{{-- نهاية الحركات --}}
