@extends('admin.index')
@section('title', trans('admin.new_store'))
@section('content')
@hasrole('admin')
@can('create')
<div class="box">

    <div class="box-header">
        <h3 class="box-title">{{trans('admin.new_store')}}</h3>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-md-12">
                @include('admin.layouts.message')
            </div>
        </div>
        {!! Form::open(['method'=>'POST','route' => 'stores.store']) !!}
        <div class="col-md-1">
            <div class="form-group">
                {{ Form::label('admin.number', trans('admin.number') , ['class' => 'control-label']) }}
                <input type="text" name="Dlv_Stor" class="form-control" value="{{$lastStore != null ? $lastStore->Dlv_Stor+1:1}}" readonly>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                {{ Form::label('Brn_No', trans('admin.Branches') , ['class' => 'control-label']) }}
                <select name="Brn_No" id="Brn_No" class="form-control">
                    <option value="">{{trans('admin.select')}}</option>
                    @foreach($branches as $branch)
                        <option value="{{$branch->Brn_No}}">{{$branch->{'Brn_Nm'.ucfirst(session('lang'))} }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                {{ Form::label(trans('admin.name_ar'), null, ['class' => 'control-label']) }}
                {{ Form::text('Dlv_NmAr', old('Dlv_NmAr'), array_merge(['class' => 'form-control'])) }}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                {{ Form::label(trans('admin.name_en'), null, ['class' => 'control-label']) }}
                {{ Form::text('Dlv_NmEn', old('Dlv_NmEn'), array_merge(['class' => 'form-control'])) }}
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                {{Form::submit(trans('admin.create'),['class'=>'btn btn-primary'])}}
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
