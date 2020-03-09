{!! Form::open(['method'=>'POST','route' => ['cc.store'], 'id' => 'edit_form','files' => true]) !!}
    {{csrf_field()}}
    {{-- Parnt_Acc --}}
    <input type="text" name="Parnt_Acc" id="Parnt_Acc" value="{{$parent? $parent->Costcntr_No : null}}" hidden>
    <input type="text" name="Cmp_No" id="Cmp_No" value="{{$parent? $parent->Cmp_No : null}}" hidden>
    <input type="text" name="Level_No" id="Level_No" value="{{$parent? $parent->Level_No : null}}" hidden>
    <input type="text" name="Level_Status" id="Level_No" value="{{1}}" hidden>
    {{-- Parnt_Acc end --}}

    <div class="col-md-1 pull-left">
        <button type="submit" class="btn btn-primary pull-left"><i class="fa fa-floppy-o" aria-hidden="true"></i></button>
    </div>

    {{-- رقم الحساب --}}
    <div class="row">
        <label for="Costcntr_No" class="col-md-2">{{trans('admin.account_number')}}:</label>
        <input type="text" name="Costcntr_No" id="Costcntr_No" class="form-control col-md-4" value="{{$Costcntr_No}}">
    </div>
    {{-- رقم الحساب --}}


    {{-- تصنيف الحساب --}}
    <div class="row">

        <div class="form-group col-md-4">
            @foreach(\App\Enums\dataLinks\StatusTreeType::toSelectArray() as $key => $value)
                <input class="checkbox-inline" type="radio"
                    name="Acc_Actv" id="Acc_Actv" value="{{$key}}"
                    style="margin: 3px;" @if($key == 1) checked @endif>
                <label>{{$value}}</label>
            @endforeach
        </div>
    </div>
    {{-- نهاية تصنيف الحساب --}}

    {{-- اسم الحساب عربى --}}
    <div class="form-group row">
        <label class="col-md-2" for="Costcntr_Nmar">{{trans('admin.account_name')}}:</label>
            <input type="text" name="Costcntr_Nmar" id="Costcntr_Nmar" class="col-md-9 form-control">
        </div>
    {{-- نهاية اشم الحساب عربى --}}

    {{-- اسم الحساب انجليزى --}}
    <div class="form-group row">
        <label class="col-md-2" for="Costcntr_Nmen">{{trans('admin.account_name_en')}}:</label>
        <input type="text" name="Costcntr_Nmen" id="Costcntr_Nmen" class=" col-md-9 form-control">
    </div>
    {{-- نهاية اسم الحساب انجليزى --}}

    <div class="col-md-12">
        <div class="row">
            {{-- رصيد اول المده مدين --}}
            <div style="left: 21px" class="col-md-6 branch">
                <div class="row">
                    <label for="Fbal_DB" class="col-md-5">{{trans('admin.first_date_debtor')}}</label>
                    <input style="left: 10px" type="text" name="Fbal_DB" id="Fbal_DB" class="form-control col-md-7" value="{{0}}">
                </div>
            </div>
            {{-- نهايةرصيد اول المده مدين --}}

            {{-- رصيد اول المده دائن --}}
            <div style="left: 21px" class="col-md-6 branch">
                <div class="row">
                    <label for="Fbal_CR" class="col-md-5">{{trans('admin.first_date_creditor')}}</label>
                    <input style="left: 10px" type="text" name="Fbal_CR" id="Fbal_CR" value='{{0}}' class="form-control col-md-7">
                </div>
            </div>
            {{-- نهاية رصيد اول المده دائن --}}
        </div>
            {{-- رصيد اول المده دائن --}}
    </div>
<br><br><br>
           <div class="form-group row">
               <label for="Cr_Blnc" class="col-md-2">{{trans('admin.credit_balance')}}</label>
               <input type="text" name="Cr_Blnc" id="Cr_Blnc" value='{{0}}' class="form-control col-md-9">
           </div>
            {{-- نهاية رصيد اول المده دائن --}}



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
