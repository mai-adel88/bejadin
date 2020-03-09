@extends('admin.index')
@section('title', trans('admin.edit_unit'))
@section('content')
    @hasrole('admin')
    @can('create')
        <div class="row">
            <div class="col-md-12">
                @include('admin.layouts.message')
            </div>
        </div>
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">{{trans('admin.edit_unit')}}</h3>
            </div>
            <div class="box-body">

                {!! Form::open(['method'=>'PUT','route' => ['units.update', $unit->ID_No]]) !!}
                <div class="col-md-2">
                    <div class="form-group">
                        {{ Form::label('Unit_No', trans('admin.unit_no') , ['class' => 'control-label']) }}
                        <input type="text" name="Unit_No" value="{{$unit->Unit_No}}" class="form-control" readonly>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        {{ Form::label(trans('admin.activity_type'), null, ['class' => 'control-label']) }}
                        <select name="Actvty_No" id="Actvty_No" class="form-control">
                            <option value="">{{trans('admin.select')}}</option>
                            @foreach($activity as $activ)
                                <option @if($unit->Actvty_No == $activ->ID_No) selected @endif value="{{$activ->ID_No}}">{{$activ->{'Name_'.ucfirst(session('lang'))} }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        {{ Form::label(trans('admin.na_Comp'), null, ['class' => 'control-label']) }}
                        <select name="Cmp_No" id="Cmp_No" class="form-control">
                            <option value="">{{trans('admin.select')}}</option>
                            @foreach($companies as $company)
                                <option @if($unit->Cmp_No == $company->ID_No) selected @endif value="{{$company->ID_No}}">{{$company->{'Cmp_Nm'.ucfirst(session('lang'))} }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label(trans('admin.name_ar'), null, ['class' => 'control-label']) }}
                        {{ Form::text('Unit_NmAr', $unit->Unit_NmAr, array_merge(['class' => 'form-control'])) }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label(trans('admin.name_en'), null, ['class' => 'control-label']) }}
                        {{ Form::text('Unit_NmEn', $unit->Unit_NmEn, array_merge(['class' => 'form-control'])) }}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {{Form::submit(trans('admin.save'),['class'=>'btn btn-primary'])}}
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    @endcan
    @else
        <div class="alert alert-danger">{{trans('admin.you_cannt_see_invoice_because_you_dont_have_role_to_access')}}</div>
        @endhasrole
@endsection
