<script>
    $(document).ready(function(){
        $('#delete_button').click(function(e){
            e.preventDefault();
            $('#delete_form').submit()
        });
    });



</script>


{!! Form::open(['method'=>'POST','route' => ['cc.update', $chart_item->Costcntr_No? $chart_item->Costcntr_No : null], 'id' => 'edit_form','files' => true]) !!}
    {{csrf_field()}}
    {{method_field('PUT')}}

    <div class="col-md-3 pull-left">
        <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i></button>
        <button type="submit" class="btn btn-danger" id="delete_button"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
    </div>

    {{-- رقم الحساب --}}
    <div class="form-group row">
        <label for="Costcntr_No" class="col-md-2">{{trans('admin.account_number')}}:</label>
        <input type="text" name="Costcntr_No" id="Costcntr_No" class="form-control col-md-2" value="{{$chart_item->Costcntr_No}}">
    </div>
    {{-- نهاية تصنيف الحساب --}}

    {{-- رقم الشركه --}}
    <input type="text" name="Cmp_No" id="Cmp_No" value="{{$chart_item->Cmp_No}}" hidden>


    {{-- اسم الحساب عربى --}}
        <div class="form-group row">
            <label class="col-md-2" for="Costcntr_Nmar">{{trans('admin.account_name')}}:</label>
            <input type="text" name="Costcntr_Nmar" id="Acc_NmAr" class="col-md-9 form-control" value="{{$chart_item->Costcntr_Nmar? $chart_item->Costcntr_Nmar : null}}">
        </div>
    {{-- نهاية اشم الحساب عربى --}}

    {{-- اسم الحساب انجليزى --}}
    <div class="form-group row">
        <label class="col-md-2" for="Costcntr_Nmen">{{trans('admin.account_name_en')}}:</label>
        <input  type="text" name="Costcntr_Nmen" id="Costcntr_Nmen" class=" col-md-9 form-control"
            value="{{$chart_item->Costcntr_Nmen? $chart_item->Costcntr_Nmen : null}}">
    </div>
    {{-- نهاية اسم الحساب انجليزى --}}

        <div class="form-group row">
            {{-- رصيد اول المده مدين --}}
                <div  style="left: 21px" class=" col-md-6">
                    <label for="Fbal_DB" class="col-md-5">{{trans('admin.first_date_debtor')}}</label>
                    <input style="left: 10px" type="text" name="Fbal_DB" id="Fbal_DB" value='{{$chart_item->Fbal_DB? $chart_item->Fbal_DB : 0}}'
                    class="form-control col-md-7"
                    @if($chart_item->Level_No == 1) disabled @endif>
                </div>

                <div  style="left: 23px" class="col-md-6">
                    <label for="Fbal_CR" class="col-md-5">{{trans('admin.first_date_creditor')}}</label>
                    <input style="left: 10px" type="text" name="Fbal_CR" id="Fbal_CR" value='{{$chart_item->Fbal_CR? $chart_item->Fbal_CR : 0}}'
                           class="form-control col-md-7"
                           @if($chart_item->Level_No == 1) disabled @endif>
                </div>
        </div>
        <div class="form-group row">
            <label for="Cr_Blnc" class="col-md-2">{{trans('admin.credit_balance')}}</label>
            <input type="text" name="Cr_Blnc" id="Cr_Blnc" value='{{$chart_item->Cr_Blnc? $chart_item->Cr_Blnc : 0}}'
            class="form-control col-md-9"
            @if($chart_item->Level_No == 1) disabled @endif>
        </div>

            {{-- نهاية رصيد اول المده دائن --}}
        </div>
    </div>


{!! Form::close() !!}
<form action="{{route('cc.destroy', $chart_item->Costcntr_No? $chart_item->Costcntr_No : null)}}" method="POST" id="delete_form">
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
