@extends('admin.index')
@section('title',trans('admin.edit_country'))
@section('content')
@hasrole('writer')
    <div class="box">
        @include('admin.layouts.message')
        <div class="box-header">
            <h3 class="box-title">{{$title}}</h3>
        </div>
        <div class="box-body">
            {!! Form::model($country,['method'=>'PUT','route' => ['countries.update',$country->id],'files'=>true]) !!}
            <div class="form-group">
                {{ Form::label(trans('admin.arabic_name'), null, ['class' => 'control-label']) }}
                {{ Form::text('country_name_ar', $country->country_name_ar, array_merge(['class' => 'form-control'])) }}
            </div>
            <div class="form-group">
                {{ Form::label(trans('admin.english_name'), null, ['class' => 'control-label']) }}
                {{ Form::text('country_name_en', $country->country_name_en, array_merge(['class' => 'form-control'])) }}
            </div>
            <div class="form-group">
                {{ Form::label(trans('admin.mob'), null, ['class' => 'control-label']) }}
                {{ Form::number('mob', $country->mob, array_merge(['class' => 'form-control'])) }}
            </div>
            <div class="form-group">
                {{ Form::label(trans('admin.code'), null, ['class' => 'control-label']) }}
                {{ Form::number('code', $country->code, array_merge(['class' => 'form-control'])) }}
            </div>
            <div class="form-group">
                {{ Form::label(trans('admin.logo'), null, ['class' => 'control-label']) }}
                {{ Form::file('logo', array_merge(['class' => 'form-control'])) }}
                <img src="{{asset('storage/'.$country->logo)}}">
            </div>
            {{Form::submit(trans('admin.send'),['class'=>'btn btn-primary'])}}
            {!! Form::close() !!}
        </div>
    </div>
@else
    <div class="alert alert-danger">{{trans('admin.you_cannt_see_invoice_because_you_dont_have_role_to_access')}}</div>

    @endhasrole







@endsection