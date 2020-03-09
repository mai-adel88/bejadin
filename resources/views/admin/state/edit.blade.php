@extends('admin.index')
@section('title',trans('admin.edit_state'))
@section('content')
@hasrole('writer')
    <div class="box">
        @include('admin.layouts.message')
        <div class="box-header">
            <h3 class="box-title">{{$title}}</h3>
        </div>
        <div class="box-body">
            {!! Form::model($state,['method'=>'PUT','route' => ['state.update',$state->id]]) !!}
            <div class="form-group">
                {{ Form::label(trans('admin.arabic_name'), null, ['class' => 'control-label']) }}
                {{ Form::text('state_name_ar', $state->state_name_ar, array_merge(['class' => 'form-control'])) }}
            </div>
            <div class="form-group">
                {{ Form::label(trans('admin.english_name'), null, ['class' => 'control-label']) }}
                {{ Form::text('state_name_en', $state->state_name_en, array_merge(['class' => 'form-control'])) }}
            </div>
            <div class="form-group">
                {{ Form::label(trans('admin.country'), null, ['class' => 'control-label']) }}
                {{ Form::select('country_id', $country,$state->country_id, array_merge(['class' => 'form-control'])) }}
            </div>
            <div class="form-group">
                {{ Form::label(trans('admin.city'), null, ['class' => 'control-label']) }}
                {{ Form::select('city_id', $city,$state->city_id, array_merge(['class' => 'form-control','placeholder'=>'select ...'])) }}
            </div>
            {{Form::submit(trans('admin.update'),['class'=>'btn btn-primary'])}}
            {!! Form::close() !!}
        </div>
    </div>
@else
    <div class="alert alert-danger">{{trans('admin.you_cannt_see_invoice_because_you_dont_have_role_to_access')}}</div>

    @endhasrole







@endsection