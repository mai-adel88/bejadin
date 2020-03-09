@extends('admin.index')
@section('title',trans('admin.show_suppliers'))
@push('js')
   <script>
       $('#myTabs a').click(function (e) {
           e.preventDefault()
           $(this).tab('show')
       })
   </script>
 @endpush
<style>
    .title{
        display: inline-block;
        width: 120px;
        color: #0b58a2;
        margin-right: 20px;
    }
</style>
@section('content')
@hasrole('writer')
@can('create')
    <div class="box">
        @include('admin.layouts.message')
        <div class="box-header">
            <h3 class="box-title">{{$title}}</h3>
        </div>
        <div class="box-body">
            <div>

                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li class="col-md-6" role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">البيانات الاساسية</a></li>
                    <li class="col-md-6" role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">تفاصيل حركات العام</a></li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="home">

                        <div class="col-md-12">
                            <div class="box-body">
                                {!! Form::model($supplier) !!}
                                <div class="col-md-7">
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            {{ Form::label(trans('admin.companies'), null, ['class' => 'control-label']) }}
                                            {{ Form::text('Cmp_No', $supplier->company->Cmp_NmAr, array_merge(['class' => 'form-control company','readonly','placeholder'=>trans('admin.select')])) }}
                                        </div>

                                        <div class="col-md-6">
                                            {{ Form::label(trans('admin.Branches'), null, ['class' => 'control-label' ]) }}
                                            {{ Form::text('Brn_No', $supplier->branches->Brn_NmAr, array_merge(['class' => 'form-control','readonly'])) }}
                                        </div>

                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            {{ Form::label(trans('admin.numb_sup'), null, ['class' => 'control-label']) }}
                                            {{ Form::text('Sup_No', old('Sup_No'), array_merge(['class' => 'form-control','readonly'])) }}
                                        </div>

                                        <div class="col-md-6">
                                            {{ Form::label(trans('admin.reference_number'), null, ['class' => 'control-label']) }}
                                            {{ Form::text('Sup_Refno', old('Sup_Refno'), array_merge(['class' => 'form-control','readonly'])) }}
                                        </div>

                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            {{ Form::label(trans('admin.arabic_name'), null, ['class' => 'control-label']) }}
                                            {{ Form::text('Sup_NmAr', old('Sup_NmAr'), array_merge(['class' => 'form-control','readonly'])) }}
                                        </div>
                                        <div class="col-md-4">
                                            {{ Form::label(trans('admin.english_name'), null, ['class' => 'control-label']) }}
                                            {{ Form::text('Sup_NmEn', old('Sup_NmEn'), array_merge(['class' => 'form-control','readonly'])) }}
                                        </div>

                                        <div class="col-md-4">
                                            {{ Form::label(trans('admin.addriss'), null, ['class' => 'control-label']) }}
                                            {{ Form::text('Sup_Adr', old('Sup_Adr'), array_merge(['class' => 'form-control','readonly'])) }}
                                        </div>

                                    </div>
                                    <div class="form-group row">

                                        <div class="col-md-6">
                                            {{ Form::label(trans('admin.responsible_person'), null, ['class' => 'control-label']) }}
                                            {{ Form::text('Sup_Rsp', old('Sup_Rsp'), array_merge(['class' => 'form-control','readonly'])) }}
                                        </div>


                                        <div class="col-md-6">
                                            {{ Form::label(trans('admin.email'), null, ['class' => 'control-label']) }}
                                            {{ Form::email('Sup_Email', old('Sup_Email'), array_merge(['class' => 'form-control','readonly']), array_merge(['class' => 'form-control','placeholder'=>trans('admin.select')])) }}
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            {{ Form::label(trans('admin.creditor'), null, ['class' => 'control-label']) }}
                                            {{ Form::text('Fbal_CR', 0, array_merge(['class' => 'form-control','readonly'])) }}
                                        </div>
                                        <div class="col-md-6">
                                            {{ Form::label(trans('admin.debtor'), null, ['class' => 'control-label']) }}
                                            {{ Form::text('Fbal_Db', 0, array_merge(['class' => 'form-control','readonly'])) }}
                                        </div>

                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            {{ Form::label(trans('admin.Credit_limit'), null, ['class' => 'control-label']) }}
                                            {{ Form::text('Credit_Value',old('Credit_Value'), array_merge(['class' => 'form-control','readonly'])) }}
                                        </div>

                                        <div class="col-md-6">
                                            {{ Form::label(trans('admin.credit_limit_day'), null, ['class' => 'control-label']) }}
                                            {{ Form::text('Credit_Days',old('Credit_Days'), array_merge(['class' => 'form-control','readonly'])) }}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            {{ Form::label(trans('admin.note'), null, ['class' => 'control-label']) }}
                                            {{ Form::textarea('Sup_Othr',old('Sup_Othr'), array_merge(['class' => 'form-control','readonly'])) }}
                                        </div>
                                    </div>

{{--                                    <div class="form-group row">--}}
{{--                                        <div class="col-md-2">--}}
{{--                                            {{ Form::label(trans('admin.editdate'), null, ['class' => 'control-label']) }}--}}
{{--                                            {{ Form::text('Updt_Date',old('Updt_Date'), array_merge(['class' => 'form-control','readonly'])) }}--}}
{{--                                        </div>--}}
{{--                                        <div class="col-md-2">--}}
{{--                                            {{ Form::label(trans('admin.User_ID'), null, ['class' => 'control-label']) }}--}}
{{--                                            {{ Form::text('User_ID',old('User_ID'), array_merge(['class' => 'form-control','readonly'])) }}--}}
{{--                                        </div>--}}


{{--                                        <div class="col-md-2">--}}
{{--                                            {{ Form::label(trans('admin.date_rigs'), null, ['class' => 'control-label']) }}--}}
{{--                                            {{ Form::text('Opn_Date',old('Opn_Date'), array_merge(['class' => 'form-control','readonly'])) }}--}}
{{--                                        </div>--}}

{{--                                        <div class="col-md-2">--}}
{{--                                            {{ Form::label(trans('admin.time_rigs'), null, ['class' => 'control-label']) }}--}}
{{--                                            {{ Form::text('Opn_Time',old('Opn_Time'), array_merge(['class' => 'form-control','readonly'])) }}--}}
{{--                                        </div>--}}

{{--                                    </div>--}}
                                </div>

                                <div class="col-md-5">
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            {{ Form::label(trans('admin.SupCtg_No'), null, ['class' => 'control-label']) }}
                                            {{ Form::text('SupCtg_No', old('SupCtg_No'), array_merge(['class' => 'form-control','readonly'])) }}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            {{ Form::label(trans('admin.country'), null, ['class' => 'control-label']) }}
                                            {{ Form::text('Cntry_No', $supplier->country->country_name_ar, array_merge(['class' => 'form-control', 'disabled' => true,'placeholder'=>trans('admin.select')])) }}
                                        </div>

                                        <div class="col-md-6">
                                            {{ Form::label(trans('admin.currency'), null, ['class' => 'control-label']) }}
                                            {{ Form::select('Curncy_No', \App\Enums\CurrencyType::toSelectArray(),old('Curncy_No'), array_merge(['class' => 'form-control', 'disabled' => true,'placeholder'=>trans('admin.select')])) }}
                                        </div>
                                    </div>

                                    <div class="form-group row">

                                        <div class="col-md-6">
                                            {{ Form::label(trans('admin.phone1'), null, ['class' => 'control-label']) }}
                                            {{ Form::text('Sup_Tel1', old('Sup_Tel1'), array_merge(['class' => 'form-control','readonly']), array_merge(['class' => 'form-control','placeholder'=>trans('admin.select')])) }}
                                        </div>
                                        <div class="col-md-6">
                                            {{ Form::label(trans('admin.phone2'), null, ['class' => 'control-label']) }}
                                            {{ Form::text('Sup_Tel2', old('Sup_Tel2'), array_merge(['class' => 'form-control','readonly']), array_merge(['class' => 'form-control','placeholder'=>trans('admin.select')])) }}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            {{ Form::label(trans('admin.mob'), null, ['class' => 'control-label']) }}
                                            {{ Form::text('Mobile', old('Mobile'), array_merge(['class' => 'form-control','readonly']), array_merge(['class' => 'form-control','placeholder'=>trans('admin.select')])) }}
                                        </div>


                                        <div class="col-md-6">
                                            {{ Form::label(trans('admin.fax'), null, ['class' => 'control-label']) }}
                                            {{ Form::text('Sup_Fax',old('Sup_Fax'), array_merge(['class' => 'form-control','readonly']), array_merge(['class' => 'form-control','placeholder'=>trans('admin.select')])) }}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            {{ Form::label(trans('admin.account_number'), null, ['class' => 'control-label']) }}
                                            {{ Form::text('Acc_No',old('Acc_No'), array_merge(['class' => 'form-control','readonly'])) }}
                                        </div>
                                        <div class="col-md-6">
                                            {{ Form::label(trans('admin.tax_number'), null, ['class' => 'control-label']) }}
                                            {{ Form::text('Tax_No',old('Tax_No'), array_merge(['class' => 'form-control','readonly'])) }}
                                        </div>
                                    </div>


                                </div>


                                {!! Form::close() !!}
                            </div>
                        </div>


{{--                            <div class="col-md-12"><h3 class="title">رقم المورد  :</h3> <span>{{$supplier->ID_No }}</span></div>--}}
{{--                            <div class="col-md-12"><h3 class="title">الإسم  :</h3> <span>{{$supplier->{'Sup_Nm'.ucfirst(session('lang'))} }}</span></div>--}}
{{--                            <div class="col-md-12"><h3 class="title">العنوان  :</h3> <span>{{$supplier->Sup_Adr }}</span></div>--}}
{{--                            <div class="col-md-12"><h3 class="title">المسؤول  :</h3> <span>{{$supplier->Sup_Rsp }}</span></div>--}}
                    </div>
                    <div role="tabpanel" class="tab-pane" id="profile">
                        <div class="col-md-12">
                            <table class="table table-bordered">
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
                                        @if($supplier->DB11 == null )
                                            0.00
                                        @else
                                           {{$supplier->DB11}}
                                        @endif
                                    </td>
                                    <td>
                                        @if($supplier->CR11 == null )
                                            0.00
                                        @else
                                            {{$supplier->CR11}}
                                        @endif
                                    </td>
                                    <td>
                                     {{$supplier->CR11 - $supplier->DB11}}
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">فبراير</th>
                                    <td>
                                        @if($supplier->DB12 == null )
                                            0.00
                                        @else
                                            {{$supplier->DB12}}
                                        @endif
                                    </td>
                                    <td>
                                        @if($supplier->CR12 == null )
                                            0.00
                                        @else
                                            {{$supplier->CR12}}
                                        @endif
                                    </td>
                                    <td>
                                        {{$supplier->CR12 - $supplier->DB12}}
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">مارس</th>
                                    <td>
                                        @if($supplier->DB13 == null )
                                            0.00
                                        @else
                                            {{$supplier->DB13}}
                                        @endif
                                    </td>
                                    <td>
                                        @if($supplier->CR13 == null )
                                            0.00
                                        @else
                                            {{$supplier->CR13}}
                                        @endif
                                    </td>
                                    <td>
                                        {{$supplier->CR13 - $supplier->DB13}}
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">ابريل</th>
                                    <td>
                                        @if($supplier->DB14 == null )
                                            0.00
                                        @else
                                            {{$supplier->DB14}}
                                        @endif
                                    </td>
                                    <td>
                                        @if($supplier->CR14 == null )
                                            0.00
                                        @else
                                            {{$supplier->CR14}}
                                        @endif
                                    </td>
                                    <td>
                                        {{$supplier->CR14 - $supplier->DB14}}
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">مايو</th>
                                    <td>
                                        @if($supplier->DB15 == null )
                                            0.00
                                        @else
                                            {{$supplier->DB15}}
                                        @endif
                                    </td>
                                    <td>
                                        @if($supplier->CR15 == null )
                                            0.00
                                        @else
                                            {{$supplier->CR15}}
                                        @endif
                                    </td>
                                    <td>
                                        {{$supplier->CR15 - $supplier->DB15}}
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">يونيو</th>
                                    <td>
                                        @if($supplier->DB16 == null )
                                            0.00
                                        @else
                                            {{$supplier->DB16}}
                                        @endif
                                    </td>
                                    <td>
                                        @if($supplier->CR16 == null )
                                            0.00
                                        @else
                                            {{$supplier->CR16}}
                                        @endif
                                    </td>
                                    <td>
                                        {{$supplier->CR16 - $supplier->DB16}}
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">يوليو</th>
                                    <td>
                                        @if($supplier->DB17 == null )
                                            0.00
                                        @else
                                            {{$supplier->DB17}}
                                        @endif
                                    </td>
                                    <td>
                                        @if($supplier->CR17 == null )
                                            0.00
                                        @else
                                            {{$supplier->CR17}}
                                        @endif
                                    </td>
                                    <td>
                                        {{$supplier->CR17 - $supplier->DB17}}
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">اغسطس</th>

                                    <td>
                                        @if($supplier->DB18 == null )
                                            0.00
                                        @else
                                            {{$supplier->DB18}}
                                        @endif
                                    </td>
                                    <td>
                                        @if($supplier->CR18 == null )
                                            0.00
                                        @else
                                            {{$supplier->CR18}}
                                        @endif
                                    </td>
                                    <td>
                                        {{$supplier->CR18 - $supplier->DB18}}
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">سبتمبر</th>

                                    <td>
                                        @if($supplier->DB19 == null )
                                            0.00
                                        @else
                                            {{$supplier->DB19}}
                                        @endif
                                    </td>
                                    <td>
                                        @if($supplier->CR19 == null )
                                            0.00
                                        @else
                                            {{$supplier->CR19}}
                                        @endif
                                    </td>
                                    <td>
                                        {{$supplier->CR19 - $supplier->DB19}}
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">أكتوبر</th>

                                    <td>
                                        @if($supplier->DB20 == null )
                                            0.00
                                        @else
                                            {{$supplier->DB20}}
                                        @endif
                                    </td>
                                    <td>
                                        @if($supplier->CR20 == null )
                                            0.00
                                        @else
                                            {{$supplier->CR20}}
                                        @endif
                                    </td>
                                    <td>
                                        {{$supplier->CR20 - $supplier->DB20}}
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">نوفمبر</th>

                                    <td>
                                        @if($supplier->DB21 == null )
                                            0.00
                                        @else
                                            {{$supplier->DB21}}
                                        @endif
                                    </td>
                                    <td>
                                        @if($supplier->CR21 == null )
                                            0.00
                                        @else
                                            {{$supplier->CR21}}
                                        @endif
                                    </td>
                                    <td>
                                        {{$supplier->CR21 - $supplier->DB21}}
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">ديسمبر</th>

                                    <td>
                                        @if($supplier->DB22 == null )
                                            0.00
                                        @else
                                            {{$supplier->DB22}}
                                        @endif
                                    </td>
                                    <td>
                                        @if($supplier->CR22 == null )
                                            0.00
                                        @else
                                            {{$supplier->CR22}}
                                        @endif
                                    </td>
                                    <td>
                                        {{$supplier->CR22 - $supplier->DB22}}
                                    </td>
                                </tr>

                                <tr style="background-color: #d3d9df">
                                    <th scope="row">الإجمالى</th>

                                    <td>
                                        {{$totalDb = $supplier->DB11 +$supplier->DB12 +$supplier->DB13 +$supplier->DB14 +$supplier->DB15 +$supplier->DB16 +$supplier->DB17 +$supplier->DB18 +$supplier->DB19 +$supplier->DB20 +$supplier->DB21 +$supplier->DB22 }}
                                    </td>
                                    <td>
                                        {{$totalCr =  $supplier->CR11 +$supplier->CR12 +$supplier->CR13 +$supplier->CR14 +$supplier->CR15 +$supplier->CR16 +$supplier->CR17 +$supplier->CR18 +$supplier->CR19 +$supplier->CR20 +$supplier->CR21 +$supplier->CR22 }}

                                    </td>
                                    <td>
                                        {{$totalDb - $totalCr}}
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>

            </div>
        </div>

    </div>
    @endcan
@else
    <div class="alert alert-danger">{{trans('admin.you_cannt_see_invoice_because_you_dont_have_role_to_access')}}</div>

    @endhasrole







@endsection
