@extends('admin.index')
@section('title',trans('admin.Create_New_Subscriber'))
@section('content')
    @push('js')
        <script>
            $(function () {
                'use strict';
                $('#type').select2({
                    placeholder: "Select a State",
                    allowClear: true,
                    dir : '{{direction()}}'
                });
            });
        </script>


    @endpush
    @push('css')
    <style>
        @if(session('lang') == 'ar')
            .datepicker{
            direction: rtl;
        }
        @endif
    </style>
    @endpush
<div class="box">
    @include('admin.layouts.message')
    <div class="box-header">
        <h3 class="box-title">{{$title}}</h3>
    </div>
    <div class="box-body">
        @can('single')
            {{Form::open(['route'=>'subscribers.store','class'=>'form-group','files'=>true])}}
            <div class="form-group row">
                <div class="col-md-4">
                    {{ Form::label(trans('admin.Branches'), null, ['class' => 'control-label']) }}
                    {{ Form::select('branches_id', $branches,null, array_merge(['class' => 'form-control branche','placeholder'=>trans('admin.select')])) }}
                </div>
                <div class="col-md-4">
                    {{ Form::label(trans('admin.arabic_name'), null, ['class' => 'control-label']) }}
                    {{ Form::text('name_ar', old('name_ar'), array_merge(['class' => 'form-control'])) }}
                </div>
                <div class="col-md-4">
                    {{ Form::label(trans('admin.english_name'), null, ['class' => 'control-label']) }}
                    {{ Form::text('name_en', old('name_en'), array_merge(['class' => 'form-control'])) }}
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-3">
                    {{ Form::label('tree_id',trans('admin.account_number') , ['class' => 'control-label']) }}
                    {{ Form::select('tree_id', $departments, null, array_merge(['class' => 'form-control','placeholder'=>trans('admin.select')])) }}
                </div>
                <div class="col-md-3">
                    {{ Form::label(trans('admin.email'), null, ['class' => 'control-label']) }}
                    {{ Form::email('email', old('email'), array_merge(['class' => 'form-control'])) }}
                </div>
                <div class="col-md-6">
                    {{ Form::label(trans('admin.addriss'), null, ['class' => 'control-label']) }}
                    {{ Form::text('address', old('addriss'), array_merge(['class' => 'form-control'])) }}
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-3">
                    {{ Form::label(trans('admin.mobile'), null, ['class' => 'control-label']) }}
                    {{ Form::text('phone_1', old('phone_1'), array_merge(['class' => 'form-control'])) }}
                </div>
                <div class="col-md-3">
                    {{ Form::label(trans('admin.phone').' 1', null, ['class' => 'control-label']) }}
                    {{ Form::text('phone_2', old('phone_2'), array_merge(['class' => 'form-control'])) }}
                </div>
                <div class="col-md-3">
                    {{ Form::label(trans('admin.phone').' 2', null, ['class' => 'control-label']) }}
                    {{ Form::text('phone_3', old('phone_3'), array_merge(['class' => 'form-control'])) }}
                </div>
                <div class="col-md-3">
                    {{ Form::label(trans('admin.phone').' 3', null, ['class' => 'control-label']) }}
                    {{ Form::text('phone_4', old('phone_4'), array_merge(['class' => 'form-control'])) }}
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-6">
                    {{ Form::label(trans('admin.facebook'), null, ['class' => 'control-label']) }}
                    {{ Form::text('facebook', old('facebook'), array_merge(['class' => 'form-control'])) }}
                </div>
                <div class="col-md-6">
                    {{ Form::label(trans('admin.twitter'), null, ['class' => 'control-label']) }}
                    {{ Form::text('twitter', old('twitter'), array_merge(['class' => 'form-control'])) }}
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-4">
                    {{ Form::label(trans('admin.tax_num'), null, ['class' => 'control-label']) }}
                    {{ Form::text('tax_num', null, array_merge(['class' => 'form-control'])) }}
                </div>
                <div class="col-md-4">
                    {{ Form::label(trans('admin.first_date_debtor'), null, ['class' => 'control-label']) }}
                    {{ Form::text('debtor', 0, array_merge(['class' => 'form-control','required'=>'required'])) }}
                </div>
                <div class="col-md-4">
                    {{ Form::label(trans('admin.first_date_creditor'), null, ['class' => 'control-label']) }}
                    {{ Form::text('creditor', 0, array_merge(['class' => 'form-control','required'=>'required'])) }}
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-4">
                    {{ Form::label(trans('admin.country'), null, ['class' => 'control-label']) }}
                    {{ Form::select('countries_id',$countries, null, array_merge(['class' => 'form-control','placeholder'=>trans('admin.select')])) }}
                </div>
                <div class="col-md-4">
                    {{ Form::label(trans('admin.city'), null, ['class' => 'control-label']) }}
                    {{ Form::select('city_id',$cities, null, array_merge(['class' => 'form-control','placeholder'=>trans('admin.select')])) }}
                </div>
                <div class="col-md-4">
                    {{ Form::label(trans('admin.state'), null, ['class' => 'control-label']) }}
                    {{ Form::select('state_id',$states, null, array_merge(['class' => 'form-control','placeholder'=>trans('admin.select')])) }}
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-4">
                    {{ Form::label(trans('admin.sales_officer2'), null, ['class' => 'control-label']) }}
                    {{ Form::select('employee_id',$employees, null, array_merge(['class' => 'form-control'])) }}
                </div>
                <div class="col-md-4">
                    {{ Form::label(trans('admin.activity_type'), null, ['class' => 'control-label']) }}
                    {{ Form::select('activity_type_id',$activity_type, null, array_merge(['class' => 'form-control','placeholder'=>trans('admin.select')])) }}
                </div>
                <div class="col-md-4">
                    {{ Form::label('العميل لا يستحق أي خصومات', null, ['class' => 'control-label']) }}
                    {{ Form::checkbox('Discounts', 1) }}
                    <br>
                    {{ Form::label('العميل لا يدخل في حساب العموله', null, ['class' => 'control-label']) }}
                    {{ Form::checkbox('Commissions', 1) }}
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-4">
                    {{ Form::label(trans('admin.credit_limit'), null, ['class' => 'control-label']) }}
                    {{ Form::text('credit_limit', old('credit_limit'), array_merge(['class' => 'form-control'])) }}
                </div>
                <div class="col-md-4">
                    {{ Form::label(trans('admin.repayment_period'), null, ['class' => 'control-label']) }}
                    {{ Form::text('repayment_period', old('repayment_period'), array_merge(['class' => 'form-control'])) }}
                </div>
                <div class="col-md-4">
                    {{ Form::label(trans('admin.discount'), null, ['class' => 'control-label']) }}
                    {{ Form::text('discount', old('discount'), array_merge(['class' => 'form-control'])) }}
                </div>
            </div>

            {{Form::submit(trans('admin.save_sub_info'),['class'=>'btn btn-primary'])}}
            {{Form::close()}}

        @else
            <div class="alert alert-danger">{{trans('admin.you_cannt_see_invoice_because_you_dont_have_role_to_access')}}</div>

        @endcan
    </div>
</div>






@endsection
