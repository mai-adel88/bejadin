@extends('admin.index')
@inject('companies', 'App\Models\Admin\MainCompany')
@inject('branches', 'App\Models\Admin\MainBranch')
@inject('customers', 'App\Models\Admin\MainBranch')
@inject('customers', 'App\Models\Admin\MTsCustomer')
@inject('delegates', 'App\Models\Admin\AstSalesman')
@inject('supervisors', 'App\Models\Admin\AstMarket')
@inject('supctgs', 'App\Models\Admin\Astsupctg')
@inject('activities', 'App\Models\Admin\ActivityTypes')
@inject('countries', 'App\country')
@inject('cities', 'App\city')
@section('title',trans('admin.show_profile_to') .session_lang($subscriber->Cstm_NmEr,$subscriber->Cstm_NmAr))
@section('content')
@push('css')
    <style>
        .list-group-item {
            padding: 30px 15px !important;
        }
        .arabic{
            direction: ltr;
        }
    </style>

@endpush
@push('js')
<script>
    $('#departments a').click(function (e) {
      e.preventDefault()
      $(this).tab('show')
    })
</script>
@endpush


    <div class="row">

        <div>
          <!-- Nav tabs -->
          <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#departments" aria-controls="home" role="tab" data-toggle="tab">{{trans('admin.main_data')}}</a></li>

            <li role="presentation"><a href="#movements" aria-controls="profile" role="tab" data-toggle="tab">{{trans('admin.movements')}}</a></li>

            <li role="presentation"><a href="#responsible_persons" aria-controls="profile" role="tab" data-toggle="tab">{{trans('admin.responsible_persons')}}</a></li>
          </ul>
          {{Form::model($subscriber,['method'=>'PUT','route'=>['subscribers.update',$subscriber->ID_No],'class'=>'form-group','files'=>true])}}

          <!-- Tab panes -->
          <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade in active" id="departments">
                <div class="box-body">

            @can('single')


                <div class="col-md-6">

                <div class="form-group row">

                    <div class="form-group col-md-12">
                        <div class="col-md-2">{!!Form::label('Cmp_No', trans('admin.company'))!!}</div>
                        @if(auth()->user()->company_id == '-1')
                        <div class="col-md-10">{!!Form::select('Cmp_No', $companies->pluck('Cmp_ShrtNm', 'ID_NO')->toArray(),null,[
                                'class'=>'form-control','id'=>'companies', 'placeholder'=>trans('admin.select'),'readonly'=>'true'
                        ])!!}</div>
                        @else
                            <div class="col-md-10">{!!Form::text('Cmp_No', null, ['class'=>'form-control' ,'readonly'=>'true'])!!}</div>
                        @endif
                    </div>

                    <div class="form-group col-md-12">
                        <div class="col-md-2">{!!Form::label('Brn_No', trans('admin.branche'))!!}</div>
                        <div class="col-md-10">
                            <select class="form-control" name="Brn_No" id="branches" readonly>
                               <option>{{trans('admin.select')}}</option>
                           </select>
                        </div>

                    </div>

                </div>
                <div class="form-group row">
                    <div class="form-group col-md-6">
                        <div class="col-md-3">{!!Form::label('Cstm_No', trans('admin.subscriber_no'))!!}</div>
                        <div class="col-md-9">{!!Form::text('Cstm_No', old('Cstm_No'), ['class'=>'form-control', 'readonly'=>'true'])!!}</div>
                    </div>

                    <div class="form-group col-md-6">
                        <div class="col-md-3">{!!Form::label('Cstm_Refno', trans('admin.customer_Ref_no'))!!}</div>
                        <div class="col-md-9">{!!Form::text('Cstm_Refno', old('Cstm_Refno'), ['class'=>'form-control' ,'readonly'=>'true'])!!}</div>
                    </div>

                </div>
                <div class="form-group row">
                    <div class="form-group col-md-12">
                        <div class="col-md-2">{!!Form::label('Cstm_NmAr', trans('admin.subscriber_name_ar'))!!}</div>
                        <div class="col-md-10">{!!Form::text('Cstm_NmAr', old('Cstm_NmAr'), ['class'=>'form-control' ,'readonly'=>'true'])!!}</div>
                    </div>
                    <div class="form-group col-md-12">
                        <div class="col-md-2">{!!Form::label('Cstm_NmEn', trans('admin.subscriber_name_en'))!!}</div>
                        <div class="col-md-10">{!!Form::text('Cstm_NmEn', old('Cstm_NmEn'), ['class'=>'form-control' ,'readonly'=>'true'])!!}</div>
                    </div>
                    <div class="form-group col-md-12">
                        <div class="col-md-2">{!!Form::label('Cstm_Email', trans('admin.email'))!!}</div>
                        <div class="col-md-10">{!!Form::text('Cstm_Email', old('Cstm_Email'), ['class'=>'form-control' ,'readonly'=>'true'])!!}</div>
                    </div>
                    <div class="form-group col-md-12">
                        <div class="col-md-2">{!!Form::label('Cstm_Adr', trans('admin.address'))!!}</div>
                        <div class="col-md-10">{!!Form::text('Cstm_Adr', old('Cstm_Adr'), ['class'=>'form-control' ,'readonly'=>'true'])!!}</div>

                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        <div class="col-md-3">{!!Form::label('Cstm_POBox', trans('admin.mail_box'))!!}</div>
                        <div class="col-md-9">{!!Form::text('Cstm_POBox', old('Cstm_POBox'), ['class'=>'form-control' ,'readonly'=>'true'])!!}</div>
                    </div>
                    <div class="col-md-6">
                        <div class="col-md-3">{!!Form::label('Cstm_ZipCode', trans('admin.mail_area'))!!}</div>
                        <div class="col-md-9">{!!Form::text('Cstm_ZipCode', old('Cstm_ZipCode'), ['class'=>'form-control' ,'readonly'=>'true'])!!}</div>
                    </div>
                </div>
                <div class="form-group row">

                    <div class="col-md-6">
                        <div class="col-md-3">{!!Form::label('Cstm_Tel', trans('admin.tel'))!!}</div>
                        <div class="col-md-9">{!!Form::text('Cstm_Tel', old('Cstm_Tel'), ['class'=>'form-control' ,'readonly'=>'true'])!!}</div>
                    </div>
                    <div class="col-md-6">
                        <div class="col-md-3">{!!Form::label('Cstm_Fax', trans('admin.fax'))!!}</div>
                        <div class="col-md-9">{!!Form::text('Cstm_Fax', old('Cstm_Fax'), ['class'=>'form-control' ,'readonly'=>'true'])!!}</div>
                    </div>
                </div>
                    <div class="form-group row">
                        <div class="form-group col-md-12">
                            <div class="col-md-2">{!!Form::label('Tel1', trans('admin.tel_1'))!!}</div>
                            <div class="col-md-10">{!!Form::text('Tel1', old('Tel1'), ['class'=>'form-control' ,'readonly'=>'true'])!!}</div>
                        </div>
                        <div class="form-group col-md-12">
                            <div class="col-md-2">{!!Form::label('Tel2', trans('admin.mobile'))!!}</div>
                            <div class="col-md-10">{!!Form::text('Tel2', old('Tel2'), ['class'=>'form-control' ,'readonly'=>'true'])!!}</div>
                        </div>
                    </div>
                <div class="form-group row col-md-8">
                    <div class="form-group col-md-12">
                        <div class="col-md-3">{!!Form::label('Credit_Value', trans('admin.credit_value'))!!}</div>
                        <div class="col-md-9">{!!Form::text('Credit_Value', old('Credit_Value'), ['class'=>'form-control' ,'readonly'=>'true'])!!}</div>
                    </div>

                    <div class="form-group col-md-12">
                        <div class="col-md-3">{!!Form::label('Credit_Days', trans('admin.credit_days'))!!}</div>
                        <div class="col-md-9">{!!Form::text('Credit_Days', old('Credit_Days'), ['class'=>'form-control' ,'readonly'=>'true'])!!}</div>
                    </div>
                </div>
                <div class="row col-md-4">
                    <div class="col-md-12">
                        <ul>
                            <li style="list-style: none;">
                                <a class="pull-right">@if($subscriber->Cstm_Active == 1)<div class="badge">{{trans('admin.active')}}</div>
                                    @else <div class="badge">{{trans('admin.deactive')}}</div> @endif</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-12">
                        <ul>
                            <li style="list-style: none;">
                                <a class="pull-right">@if($subscriber->Internal_Invoice == 1)<div class="badge">{{trans('admin.y_Internal_Invoice')}}</div>
                                    @else <div class="badge">{{trans('admin.No_Internal_Invoice')}}</div> @endif</a>
                            </li>
                        </ul>

                    </div>
                </div>


                <div class="form-group row">
                    <div class="form-group col-md-12">
                        <div class="col-md-2">{!!Form::label('Notes', trans('admin.Notes'))!!}</div>
                        <div class="col-md-10">{!!Form::textarea('Notes', old('Notes'), ['class'=>'form-control', 'rows' => 4, 'cols' => 54 ,'readonly'=>'true'])!!}</div>
                    </div>
                </div>


            </div>

            <div class="col-md-6">
                <div class="col-md-6">
                    <div class="col-md-12">
                        <div class="col-md-3" style="left: 11px;">{!!Form::label('Cntry_No', trans('admin.country'))!!}</div>
                        <div class="col-md-9" style="margin-bottom: 10px;">
                            @if($subscriber->Cntry_No==null)
                                {!! Form::text('Cntry_No', old('Cntry_No'), ['class' =>'form-control', 'readonly'=>'true']) !!}

                            @else
                            {!! Form::text('Cntry_No', $subscriber->country->country_name_ar, ['class' =>'form-control', 'readonly'=>'true']) !!}
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-3" style="padding: 3px">{!!Form::label('City_No', trans('admin.city'))!!}</div>
                        <div class="col-md-9"  style="margin-bottom: 10px;">
                            {!! Form::text('City_No', old('City_No'), ['class' =>'form-control', 'readonly'=>'true']) !!}

                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-3" style="padding: 1px;">{!!Form::label('Area_No', trans('admin.area'))!!}</div>
                        <div class="col-md-9" style="margin-bottom: 10px;">
                            {!! Form::text('Area_No', null, ['class' =>'form-control', 'readonly'=>'true']) !!}</div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-3" style="left:12px;">{!!Form::label('Slm_No', trans('admin.slm_no'))!!}</div>
                        <div class="col-md-9" style="margin-bottom: 10px;">
                            @if($subscriber->Slm_No==null)
                                {!! Form::text('Slm_No', null, ['class' =>'form-control', 'readonly'=>'true']) !!}

                            @else
                                {!! Form::text('Slm_No', $subscriber->delegate->Slm_NmAr, ['class' =>'form-control', 'readonly'=>'true']) !!}
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-3" style="left:13px;">{!!Form::label('Mrkt_No', trans('admin.mrkt_no'))!!}</div>
                        <div class="col-md-9" style="margin-bottom: 10px;">
                            @if($subscriber->Mrkt_No==null)
                                {!! Form::text('Mrkt_No', null, ['class' =>'form-control', 'readonly'=>'true']) !!}

                            @else
                                {!! Form::text('Mrkt_No', $subscriber->supervisor->Mrkt_NmAr, ['class' =>'form-control', 'readonly'=>'true']) !!}
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-3" style="left:12px;">{!!Form::label('Nutr_No', trans('admin.Nutr_No'))!!}</div>
                        <div class="col-md-9" style="margin-bottom: 10px;">
                            @if($subscriber->Nutr_No==null)
                                {!! Form::text('Nutr_No', null, ['class' =>'form-control', 'readonly'=>'true']) !!}

                            @else
                                {!! Form::text('Nutr_No', $subscriber->activity->Name_Ar, ['class' =>'form-control', 'readonly'=>'true']) !!}
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-3" style="left:12px;">{!!Form::label('Fbal_Db', trans('admin.Fbal_Db'))!!}</div>
                        <div class="col-md-9" style="margin-bottom: 10px;">{!!Form::text('Fbal_Db', null, ['class'=>'form-control' ,'readonly'=>'true'])!!}</div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-3" style="left:12px;">{!!Form::label('Fbal_CR', trans('admin.Fbal_CR'))!!}</div>
                        <div class="col-md-9" style="margin-bottom: 10px;">{!!Form::text('Fbal_CR', null, ['class'=>'form-control' ,'readonly'=>'true'])!!}</div>
                    </div>
                </div>

                <div class="col-md-6">

                <div class="form-group row">
                    <fieldset>
                        <legend>{{trans('admin.last_bill')}}</legend>
                        <div class="col-md-12">
                            <div class="col-md-3">{!!Form::label('Linv_No', trans('admin.Linv_No'))!!}</div>
                            <div class="col-md-9" style="margin-bottom: 10px;">{!!Form::text('Linv_No', null, ['class'=>'form-control' ,'readonly'=>'true'])!!}</div>
                        </div>
                        <div class="col-md-12">
                        <div class="col-md-3">{!!Form::label('Linv_Dt', trans('admin.Linv_Dt'))!!}</div>
                        <div class="col-md-9" style="margin-bottom: 10px;">{!!Form::date('Linv_Dt', null, ['class'=>'form-control' ,'readonly'=>'true'])!!}</div>
                        </div>
                        <div class="col-md-12">
                        <div class="col-md-3">{!!Form::label('Linv_Net', trans('admin.Linv_Net'))!!}</div>
                        <div class="col-md-9" style="margin-bottom: 10px;">{!!Form::text('Linv_Net', null, ['class'=>'form-control' ,'readonly'=>'true'])!!}</div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <legend>{{trans('admin.last_mo')}}</legend>
                        <div class="col-md-12">
                            <div class="col-md-3">{!!Form::label('LRcpt_No', trans('admin.LRcpt_No'))!!}</div>
                            <div class="col-md-9" style="margin-bottom: 10px;">{!!Form::text('LRcpt_No', null, ['class'=>'form-control' ,'readonly'=>'true'])!!}</div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-3">{!!Form::label('LRcpt_Dt', trans('admin.LRcpt_Dt'))!!}</div>
                            <div class="col-md-9" style="margin-bottom: 10px;">{!!Form::date('LRcpt_Dt', null, ['class'=>'form-control' ,'readonly'=>'true'])!!}</div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-3">{!!Form::label('LRcpt_Db', trans('admin.LRcpt_Db'))!!}</div>
                            <div class="col-md-9" style="margin-bottom: 10px;">{!!Form::text('LRcpt_Db', null, ['class'=>'form-control' ,'readonly'=>'true'])!!}</div>
                        </div>
                    </fieldset>
                    </div>

                </div>
                <div class="col-md-12" style="margin-top: 15px;">

                    <div class="col-md-12" style="margin-bottom: 11px;">
                        <div class="col-md-4">{!!Form::label('Cstm_Ctg', trans('admin.customer_catg'))!!}</div>
                        <div class="col-md-8">
                            @if($subscriber->Cstm_Ctg==null)
                                {!! Form::text('Cstm_Ctg', null, ['class' =>'form-control', 'readonly'=>'true']) !!}

                            @else
                                {!! Form::text('Cstm_Ctg', $supctgs->Supctg_Nm.session('lang'), ['class' =>'form-control', 'readonly'=>'true']) !!}
                            @endif
                       </div>
                    </div>

                    <div class="col-md-12" style="margin-bottom: 11px;">
                        <div class="col-md-4">{!!Form::label('Acc_No', trans('admin.account_number'))!!}</div>
                        <div class="col-md-8" style="margin-right: 0px;">{!!Form::text('Acc_No', null, ['class'=>'form-control' ,'readonly'=>'true'])!!}</div>
                    </div>

                    <div class="col-md-12" style="margin-bottom: 11px;">
                        <div class="col-md-6">{!!Form::label('Tax_No', trans('admin.Tax_No'))!!}</div>
                        <div class="col-md-6" style="margin-right: 0px;">{!!Form::text('Tax_No', null, ['class'=>'form-control' ,'readonly'=>'true'])!!}</div>
                    </div>

                    <div class="col-md-12">
                        <ul>
                            <li style="list-style: none;">
                                <a class="pull-right">@if($subscriber->AgeNot_Calculate == 1)<div class="badge">{{trans('admin.No_AgeNot_Calculate')}}</div>
                                    @else <div class="badge">{{trans('admin.AgeNot_Calculate')}}</div> @endif</a>
                            </li>
                        </ul>

                    </div>

                    <div class="col-md-12">
                        <ul>
                            <li style="list-style: none;">
                                <a class="pull-right">@if($subscriber->Deserve_Discount == 1)<div class="badge">{{trans('admin.No_Deserve_Discount')}}</div>
                                    @else <div class="badge">{{trans('admin.Deserve_Discount')}}</div> @endif</a>
                            </li>
                        </ul>

                    </div>

                </div>
                </div>


            @else
                <div class="alert alert-danger">{{trans('admin.you_cannt_see_invoice_because_you_dont_have_role_to_access')}}</div>

            @endcan
            </div>

            </div>

            <div role="tabpanel" class="tab-pane fade" id="movements">


                <div class="col-md-12">

                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col">{{trans('admin.month')}}</th>
                                    <th scope="col">{{trans('admin.movement_owes')}}</th>
                                    <th scope="col">{{trans('admin.movement_creditor')}}</th>
                                    <th scope="col">{{trans('admin.current_balance')}}</th>
                                    <th scope="col">{{trans('admin.credit_balance')}}</th>
                                    <th scope="col">{{trans('admin.Balance')}}2018</th>
                                    <th scope="col">{{trans('admin.Balance')}}2017</th>
                                </tr>
                                </thead>
                                <tbody>

                                <tr>
                                    <th scope="row">{{trans('admin.ja_cr')}}</th>
                                    <td>
                                        @if($subscriber->DB11 == null )
                                            0.00
                                        @else
                                           {{$subscriber->DB11}}
                                        @endif
                                    </td>
                                    <td>
                                        @if($subscriber->CR11 == null )
                                            0.00
                                        @else
                                            {{$subscriber->CR11}}
                                        @endif
                                    </td>
                                    <td>
                                     {{$subscriber->CR11 - $subscriber->DB11}}
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">{{trans('admin.feb_cr')}}</th>
                                    <td>
                                        @if($subscriber->DB12 == null )
                                            0.00
                                        @else
                                            {{$subscriber->DB12}}
                                        @endif
                                    </td>
                                    <td>
                                        @if($subscriber->CR12 == null )
                                            0.00
                                        @else
                                            {{$subscriber->CR12}}
                                        @endif
                                    </td>
                                    <td>
                                        {{$subscriber->CR12 - $subscriber->DB12}}
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">{{trans('admin.mar_cr')}}</th>
                                    <td>
                                        @if($subscriber->DB13 == null )
                                            0.00
                                        @else
                                            {{$subscriber->DB13}}
                                        @endif
                                    </td>
                                    <td>
                                        @if($subscriber->CR13 == null )
                                            0.00
                                        @else
                                            {{$subscriber->CR13}}
                                        @endif
                                    </td>
                                    <td>
                                        {{$subscriber->CR13 - $subscriber->DB13}}
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">{{trans('admin.Apr_cr')}}</th>
                                    <td>
                                        @if($subscriber->DB14 == null )
                                            0.00
                                        @else
                                            {{$subscriber->DB14}}
                                        @endif
                                    </td>
                                    <td>
                                        @if($subscriber->CR14 == null )
                                            0.00
                                        @else
                                            {{$subscriber->CR14}}
                                        @endif
                                    </td>
                                    <td>
                                        {{$subscriber->CR14 - $subscriber->DB14}}
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">{{trans('admin.may_cr')}}</th>
                                    <td>
                                        @if($subscriber->DB15 == null )
                                            0.00
                                        @else
                                            {{$subscriber->DB15}}
                                        @endif
                                    </td>
                                    <td>
                                        @if($subscriber->CR15 == null )
                                            0.00
                                        @else
                                            {{$subscriber->CR15}}
                                        @endif
                                    </td>
                                    <td>
                                        {{$subscriber->CR15 - $subscriber->DB15}}
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">{{trans('admin.jo_cr')}}</th>
                                    <td>
                                        @if($subscriber->DB16 == null )
                                            0.00
                                        @else
                                            {{$subscriber->DB16}}
                                        @endif
                                    </td>
                                    <td>
                                        @if($subscriber->CR16 == null )
                                            0.00
                                        @else
                                            {{$subscriber->CR16}}
                                        @endif
                                    </td>
                                    <td>
                                        {{$subscriber->CR16 - $subscriber->DB16}}
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">{{trans('admin.july_cr')}}</th>
                                    <td>
                                        @if($subscriber->DB17 == null )
                                            0.00
                                        @else
                                            {{$subscriber->DB17}}
                                        @endif
                                    </td>
                                    <td>
                                        @if($subscriber->CR17 == null )
                                            0.00
                                        @else
                                            {{$subscriber->CR17}}
                                        @endif
                                    </td>
                                    <td>
                                        {{$subscriber->CR17 - $subscriber->DB17}}
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">{{trans('admin.aug_cr')}}</th>

                                    <td>
                                        @if($subscriber->DB18 == null )
                                            0.00
                                        @else
                                            {{$subscriber->DB18}}
                                        @endif
                                    </td>
                                    <td>
                                        @if($subscriber->CR18 == null )
                                            0.00
                                        @else
                                            {{$subscriber->CR18}}
                                        @endif
                                    </td>
                                    <td>
                                        {{$subscriber->CR18 - $subscriber->DB18}}
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">{{trans('admin.sep_cr')}}</th>

                                    <td>
                                        @if($subscriber->DB19 == null )
                                            0.00
                                        @else
                                            {{$subscriber->DB19}}
                                        @endif
                                    </td>
                                    <td>
                                        @if($subscriber->CR19 == null )
                                            0.00
                                        @else
                                            {{$subscriber->CR19}}
                                        @endif
                                    </td>
                                    <td>
                                        {{$subscriber->CR19 - $subscriber->DB19}}
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">{{trans('admin.oct_cr')}}</th>

                                    <td>
                                        @if($subscriber->DB20 == null )
                                            0.00
                                        @else
                                            {{$subscriber->DB20}}
                                        @endif
                                    </td>
                                    <td>
                                        @if($subscriber->CR20 == null )
                                            0.00
                                        @else
                                            {{$subscriber->CR20}}
                                        @endif
                                    </td>
                                    <td>
                                        {{$subscriber->CR20 - $subscriber->DB20}}
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">{{trans('admin.nov_cr')}}</th>

                                    <td>
                                        @if($subscriber->DB21 == null )
                                            0.00
                                        @else
                                            {{$subscriber->DB21}}
                                        @endif
                                    </td>
                                    <td>
                                        @if($subscriber->CR21 == null )
                                            0.00
                                        @else
                                            {{$subscriber->CR21}}
                                        @endif
                                    </td>
                                    <td>
                                        {{$subscriber->CR21 - $subscriber->DB21}}
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">{{trans('admin.dec_cr')}}</th>

                                    <td>
                                        @if($subscriber->DB22 == null )
                                            0.00
                                        @else
                                            {{$subscriber->DB22}}
                                        @endif
                                    </td>
                                    <td>
                                        @if($subscriber->CR22 == null )
                                            0.00
                                        @else
                                            {{$subscriber->CR22}}
                                        @endif
                                    </td>
                                    <td>
                                        {{$subscriber->CR22 - $subscriber->DB22}}
                                    </td>
                                </tr>

                                <tr style="background-color: #d3d9df">
                                    <th scope="row">{{trans('admin.Balance')}}</th>

                                    <td>
                                        {{$totalDb = $subscriber->DB11 +$subscriber->DB12 +$subscriber->DB13 +$subscriber->DB14 +$subscriber->DB15 +$subscriber->DB16 +$subscriber->DB17 +$subscriber->DB18 +$subscriber->DB19 +$subscriber->DB20 +$subscriber->DB21 +$subscriber->DB22 }}
                                    </td>
                                    <td>
                                        {{$totalCr =  $subscriber->CR11 +$subscriber->CR12 +$subscriber->CR13 +$subscriber->CR14 +$subscriber->CR15 +$subscriber->CR16 +$subscriber->CR17 +$subscriber->CR18 +$subscriber->CR19 +$subscriber->CR20 +$subscriber->CR21 +$subscriber->CR22 }}

                                    </td>
                                    <td>
                                        {{$totalDb - $totalCr}}
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
            </div>

            <div role="tabpanel" class="tab-pane" id="responsible_persons">
                <div>
            <div class="box-body">

            @can('single')



                <div class="form-group row col-md-3">
                    <div class="col-md-12" style="text-align: center;">
                        {!!Form::label('Cntct_Prsn1', trans('admin.person_dep_1'))!!}
                        <div class="col-md-10" style="margin-bottom: 10px;">{!!Form::text('Cntct_Prsn1', old('Cntct_Prsn1'), ['class'=>'form-control' ,'readonly'=>'true'])!!}</div>
                    </div>
                    <div class="col-md-12">

                        <div class="col-md-10" style="margin-bottom: 10px;">{!!Form::text('Cntct_Prsn2', null, ['class'=>'form-control' ,'readonly'=>'true'])!!}</div>
                    </div>
                    <div class="col-md-12">

                        <div class="col-md-10" style="margin-bottom: 10px;">{!!Form::text('Cntct_Prsn3', null, ['class'=>'form-control' ,'readonly'=>'true'])!!}</div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-10" style="margin-bottom: 10px;">{!!Form::text('Cntct_Prsn4', null, ['class'=>'form-control' ,'readonly'=>'true'])!!}</div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-10" style="margin-bottom: 10px;">{!!Form::text('Cntct_Prsn5', null, ['class'=>'form-control' ,'readonly'=>'true'])!!}</div>
                    </div>
                </div>
                <div class="form-group row col-md-3">
                    <div class="col-md-12" style="text-align: center;">
                        {!!Form::label('TitL1', trans('admin.Title_1'))!!}
                        <div class="col-md-10" style="margin-bottom: 10px;">{!!Form::text('TitL1', null, ['class'=>'form-control' ,'readonly'=>'true'])!!}</div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-10" style="margin-bottom: 10px;">{!!Form::text('TitL2', null, ['class'=>'form-control' ,'readonly'=>'true'])!!}</div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-10" style="margin-bottom: 10px;">{!!Form::text('TitL3', null, ['class'=>'form-control' ,'readonly'=>'true'])!!}</div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-10" style="margin-bottom: 10px;">{!!Form::text('TitL4', null, ['class'=>'form-control' ,'readonly'=>'true'])!!}</div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-10" style="margin-bottom: 10px;">{!!Form::text('TitL5', null, ['class'=>'form-control' ,'readonly'=>'true'])!!}</div>
                    </div>
                </div>
                <div class="form-group row col-md-3">
                    <div class="col-md-12" style="text-align: center;">
                        {!!Form::label('Mobile1', trans('admin.mobile_1'))!!}
                        <div class="col-md-10" style="margin-bottom: 10px;">{!!Form::text('Mobile1', null, ['class'=>'form-control' ,'readonly'=>'true'])!!}</div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-10" style="margin-bottom: 10px;">{!!Form::text('Mobile2', null, ['class'=>'form-control' ,'readonly'=>'true'])!!}</div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-10" style="margin-bottom: 10px;">{!!Form::text('Mobile3', null, ['class'=>'form-control' ,'readonly'=>'true'])!!}</div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-10" style="margin-bottom: 10px;">{!!Form::text('Mobile4', null, ['class'=>'form-control' ,'readonly'=>'true'])!!}</div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-10" style="margin-bottom: 10px;">{!!Form::text('Mobile5', null, ['class'=>'form-control' ,'readonly'=>'true'])!!}</div>
                    </div>
                </div>
                <div class="form-group row col-md-3">
                    <div class="col-md-12" style="text-align: center;">
                        {!!Form::label('Email1', trans('admin.email_1'))!!}
                        <div class="col-md-10" style="margin-bottom: 10px;">{!!Form::email('Email1', null, ['class'=>'form-control' ,'readonly'=>'true'])!!}</div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-10" style="margin-bottom: 10px;">{!!Form::email('Email2', null, ['class'=>'form-control' ,'readonly'=>'true'])!!}</div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-10" style="margin-bottom: 10px;">{!!Form::email('Email3', null, ['class'=>'form-control' ,'readonly'=>'true'])!!}</div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-10" style="margin-bottom: 10px;">{!!Form::email('Email4', null, ['class'=>'form-control' ,'readonly'=>'true'])!!}</div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-10" style="margin-bottom: 10px;">{!!Form::email('Email5', null, ['class'=>'form-control' ,'readonly'=>'true'])!!}</div>
                    </div>
                </div>


                </div>


            {{Form::close()}}
            @else
                <div class="alert alert-danger">{{trans('admin.you_cannt_see_invoice_because_you_dont_have_role_to_access')}}</div>

            @endcan


        </div>
            </div>
          </div>

   </div>
</div>
@endsection
