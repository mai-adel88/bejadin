@extends('admin.index')
@section('title',trans('admin.Edit_Subscriber').' '.session_lang($subscriber->name_en,$subscriber->name_ar))
@section('content')
    @hasrole('writer')
    <div class="box">
        @include('admin.layouts.message')
        <div class="box-header">
            <h3 class="box-title">{{$title}}</h3>
        </div>
        <div class="box-body">
            {{Form::model($subscriber,['method'=>'PUT','route'=>['subscribers.update',$subscriber->id],'class'=>'form-group','files'=>true])}}
            <div class="form-group row">
                <div class="col-md-4">
                    {{ Form::label(trans('admin.Branches'), null, ['class' => 'control-label']) }}
                    {{ Form::select('branches_id', $branches,$subscriber->branches_id, array_merge(['class' => 'form-control branche','placeholder'=>trans('admin.select')])) }}
                </div>
                <div class="col-md-4">
                    {{ Form::label(trans('admin.arabic_name'), null, ['class' => 'control-label']) }}
                    {{ Form::text('name_ar', $subscriber->name_ar, array_merge(['class' => 'form-control'])) }}
                </div>
                <div class="col-md-4">
                    {{ Form::label(trans('admin.english_name'), null, ['class' => 'control-label']) }}
                    {{ Form::text('name_en', $subscriber->name_en, array_merge(['class' => 'form-control'])) }}
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-3">
                    {{ Form::label('tree_id',trans('admin.account_number') , ['class' => 'control-label']) }}
                    {{ Form::select('tree_id', $departments,$subscriber->tree_id, array_merge(['class' => 'form-control','placeholder'=>trans('admin.select')])) }}
                </div>
                <div class="col-md-3">
                    {{ Form::label(trans('admin.email'), null, ['class' => 'control-label']) }}
                    {{ Form::email('email', $subscriber->email, array_merge(['class' => 'form-control'])) }}
                </div>
                <div class="col-md-6">
                    {{ Form::label(trans('admin.addriss'), null, ['class' => 'control-label']) }}
                    {{ Form::text('address', $subscriber->address, array_merge(['class' => 'form-control'])) }}
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-3">
                    {{ Form::label(trans('admin.mobile'), null, ['class' => 'control-label']) }}
                    {{ Form::text('phone_1', $subscriber->phone_1, array_merge(['class' => 'form-control'])) }}
                </div>
                <div class="col-md-3">
                    {{ Form::label(trans('admin.phone').' 1', null, ['class' => 'control-label']) }}
                    {{ Form::text('phone_2', $subscriber->phone_2, array_merge(['class' => 'form-control'])) }}
                </div>
                <div class="col-md-3">
                    {{ Form::label(trans('admin.phone').' 2', null, ['class' => 'control-label']) }}
                    {{ Form::text('phone_3', $subscriber->phone_3, array_merge(['class' => 'form-control'])) }}
                </div>
                <div class="col-md-3">
                    {{ Form::label(trans('admin.phone').' 3', null, ['class' => 'control-label']) }}
                    {{ Form::text('phone_4', $subscriber->phone_4, array_merge(['class' => 'form-control'])) }}
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-6">
                    {{ Form::label(trans('admin.facebook'), null, ['class' => 'control-label']) }}
                    {{ Form::text('facebook', $subscriber->facebook, array_merge(['class' => 'form-control'])) }}
                </div>
                <div class="col-md-6">
                    {{ Form::label(trans('admin.twitter'), null, ['class' => 'control-label']) }}
                    {{ Form::text('twitter', $subscriber->twitter, array_merge(['class' => 'form-control'])) }}
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-4">
                    {{ Form::label(trans('admin.tax_num'), null, ['class' => 'control-label']) }}
                    {{ Form::text('tax_num', $subscriber->tax_num, array_merge(['class' => 'form-control'])) }}
                </div>
                <div class="col-md-4">
                    {{ Form::label(trans('admin.first_date_debtor'), null, ['class' => 'control-label']) }}
                    {{ Form::text('debtor', $subscriber->debtor, array_merge(['class' => 'form-control','required'=>'required'])) }}
                </div>
                <div class="col-md-4">
                    {{ Form::label(trans('admin.first_date_creditor'), null, ['class' => 'control-label']) }}
                    {{ Form::text('creditor', $subscriber->creditor, array_merge(['class' => 'form-control','required'=>'required'])) }}
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-4">
                    {{ Form::label(trans('admin.country'), null, ['class' => 'control-label']) }}
                    {{ Form::select('countries_id',$countries, $subscriber->countries_id, array_merge(['class' => 'form-control','placeholder'=>trans('admin.select')])) }}
                </div>
                <div class="col-md-4">
                    {{ Form::label(trans('admin.city'), null, ['class' => 'control-label']) }}
                    {{ Form::select('city_id',$cities, $subscriber->city_id, array_merge(['class' => 'form-control','placeholder'=>trans('admin.select')])) }}
                </div>
                <div class="col-md-4">
                    {{ Form::label(trans('admin.state'), null, ['class' => 'control-label']) }}
                    {{ Form::select('state_id',$states, $subscriber->state_id, array_merge(['class' => 'form-control','placeholder'=>trans('admin.select')])) }}
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-4">
                    {{ Form::label(trans('admin.sales_officer2'), null, ['class' => 'control-label']) }}
                    {{ Form::select('employee_id',$employees, $subscriber->employee_id, array_merge(['class' => 'form-control'])) }}
                </div>
                <div class="col-md-4">
                    {{ Form::label(trans('admin.activity_type'), null, ['class' => 'control-label']) }}
                    {{ Form::select('activity_type_id',$activity_type, $subscriber->activity_type_id, array_merge(['class' => 'form-control','placeholder'=>trans('admin.select')])) }}
                </div>
                <div class="col-md-4">
                    {{ Form::label('العميل لا يستحق أي خصومات', null, ['class' => 'control-label']) }}
                    {{ Form::checkbox('Discounts', 1,$subscriber->Discounts) }}
                    <br>
                    {{ Form::label('العميل لا يدخل في حساب العموله', null, ['class' => 'control-label']) }}
                    {{ Form::checkbox('Commissions', 1,$subscriber->Commissions) }}
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-4">
                    {{ Form::label(trans('admin.credit_limit'), null, ['class' => 'control-label']) }}
                    {{ Form::text('credit_limit', $subscriber->credit_limit, array_merge(['class' => 'form-control'])) }}
                </div>
                <div class="col-md-4">
                    {{ Form::label(trans('admin.repayment_period'), null, ['class' => 'control-label']) }}
                    {{ Form::text('repayment_period', $subscriber->repayment_period, array_merge(['class' => 'form-control'])) }}
                </div>
                <div class="col-md-4">
                    {{ Form::label(trans('admin.discount'), null, ['class' => 'control-label']) }}
                    {{ Form::text('discount', $subscriber->discount, array_merge(['class' => 'form-control'])) }}
                </div>
            </div>
            {{Form::submit(trans('admin.save_sub_info'),['class'=>'btn btn-primary'])}}
            {!! Form::close() !!}
        </div>
    </div>
    @else
        <div class="alert alert-danger">{{trans('admin.you_cannt_see_invoice_because_you_dont_have_role_to_access')}}</div>

        @endhasrole







@endsection
