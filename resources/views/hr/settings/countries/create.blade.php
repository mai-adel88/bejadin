@extends('hr.index')
@section('title',trans('admin.create_new_country'))
@section('content')
@hasrole('writer')
@can('create')
    <div class="box">
        @include('admin.layouts.message')
        <div class="box-header">
            <h3 class="box-title">{{$title}}</h3>
        </div>
        <div class="box-body">
            {!! Form::open(['method'=>'POST','route' => 'hrcountries.store','files'=>true]) !!}
            <div class="form-group">
                {{ Form::label(trans('admin.arabic_name'), null, ['class' => 'control-label']) }}
                {{ Form::text('country_name_ar', null, array_merge(['class' => 'form-control'])) }}
            </div> 
            <div class="form-group">
                {{ Form::label(trans('admin.english_name'), null, ['class' => 'control-label']) }}
                {{ Form::text('country_name_en', null, array_merge(['class' => 'form-control'])) }}
            </div>
            <div class="form-group">
                {{ Form::label(trans('admin.mob'), null, ['class' => 'control-label']) }}
                {{ Form::number('mob', null, array_merge(['class' => 'form-control'])) }}
            </div>
            <div class="form-group">
                {{ Form::label(trans('admin.code'), null, ['class' => 'control-label']) }}
                {{ Form::number('code', null, array_merge(['class' => 'form-control'])) }}
            </div>
            <div class="form-group">
                {{ Form::label(trans('admin.logo'), null, ['class' => 'control-label']) }}
                {{ Form::file('logo', array_merge(['class' => 'form-control'])) }}
            </div>
            <!-- نوع الدولة -->
            <div class="form-group">
                <div class="col-md-12">
                    <fieldset id="tableFilter">
                        
                        <legend>{{ trans('hr.country_type')}}</legend>
                        <!-- عملاء --> 
                        <div class="row">
                            <input id="cntry_cst" type="checkbox" value="1" name="cntry_cst" class="cntry_cst col-md-2 radio-inline">
                            <label FOR="cntry_cst" class="col-md-10 p-0">{{trans('hr.cntry_cst')}}</label>
                        </div>
                        <!-- موردين -->
                        <div class="row">
                            <input id="cntry_sub" type="checkbox" value="1" name="cntry_sub" class="cntry_sub col-md-2 radio-inline">
                            <label FOR="cntry_sub" class="col-md-10 p-0">{{trans('hr.cntry_sub')}}</label>
                        </div>
                        <!-- موظفين-->
                        <div class="row">
                            <input id="cntry_emp" type="checkbox" value="1" name="cntry_emp" class="cntry_emp col-md-2 radio-inline">
                            <label FOR="cntry_emp" class="col-md-10 p-0 fs-13">{{trans('hr.cntry_emp')}}</label>
                        </div>
                        <!-- شركات -->
                        <div class="row">
                            <input id="cntry_cmp" type="checkbox" value="1" name="cntry_cmp" class="cntry_cmp col-md-2 radio-inline">
                            <label FOR="cntry_cmp" class="col-md-10 p-0">{{trans('hr.cntry_cmp')}}</label>
                        </div>
                       
                    </fieldset>
                </div>
            </div>
            <!--  نوع الدولة end-->
            {{Form::submit(trans('admin.create'),['class'=>'btn btn-primary'])}}
            {!! Form::close() !!}
        </div>
    </div>
    @endcan
@else
    <div class="alert alert-danger">{{trans('admin.you_cannt_see_invoice_because_you_dont_have_role_to_access')}}</div>

    @endhasrole







@endsection