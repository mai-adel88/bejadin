@extends('admin.index')
@section('title',trans('admin.create_new_city'))
@section('content')
@hasrole('writer')
@can('create')
    <div class="box">
        @include('admin.layouts.message')
        <div class="box-header">
            <h3 class="box-title">{{$title}}</h3>
        </div>
        <div class="box-body">
            {!! Form::open(['method'=>'POST','route' => 'cities.store']) !!}
            <div class="form-group">
                {{ Form::label(trans('admin.arabic_name'), null, ['class' => 'control-label']) }}
                {{ Form::text('city_name_ar', null, array_merge(['class' => 'form-control'])) }}
            </div>
            <div class="form-group">
                {{ Form::label(trans('admin.english_name'), null, ['class' => 'control-label']) }}
                {{ Form::text('city_name_en', null, array_merge(['class' => 'form-control'])) }}
            </div>
            <div class="form-group">
                {{ Form::label(trans('admin.country'), null, ['class' => 'control-label']) }}
                {{ Form::select('country_id', $countries,$countries, array_merge(['class' => 'form-control','placeholder'=>trans('admin.select')])) }}
            </div>
            {{Form::submit(trans('admin.send'),['class'=>'btn btn-primary'])}}
            {!! Form::close() !!}
        </div>
    </div>
    @endcan
@else
    <div class="alert alert-danger">{{trans('admin.you_cannt_see_invoice_because_you_dont_have_role_to_access')}}</div>

    @endhasrole







@endsection