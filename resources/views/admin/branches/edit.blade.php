@extends('admin.index')
@section('title',trans('admin.edit_branches'))
@section('content')
@hasrole('writer')
    <div class="box">
        @include('admin.layouts.message')
        <div class="box-header">
            <h3 class="box-title">{{$title}}</h3>
        </div>
        <div class="box-body">
            {!! Form::model($branches,['method'=>'PUT','route' => ['branches.update',$branches->id]]) !!}
            <div class="form-group">
                {{ Form::label(trans('admin.arabic_name'), null, ['class' => 'control-label']) }}
                {{ Form::text('name_ar', $branches->name_ar, array_merge(['class' => 'form-control'])) }}
            </div>
            <div class="form-group">
                {{ Form::label(trans('admin.english_name'), null, ['class' => 'control-label']) }}
                {{ Form::text('name_en', $branches->name_en, array_merge(['class' => 'form-control'])) }}
            </div>
            <div class="form-group">
                {{ Form::label(trans('admin.addriss'), null, ['class' => 'control-label']) }}
                {{ Form::text('addriss', $branches->addriss, array_merge(['class' => 'form-control'])) }}
            </div>
            <div class="form-group">
                {{ Form::label(trans('admin.type'), null, ['class' => 'control-label']) }}
                {{ Form::select('type', \App\Enums\BranchType::toSelectArray(),$branches->type, array_merge(['class' => 'form-control type','placeholder'=>trans('admin.select')])) }}
            </div>
            {{--<div class="form-group">--}}
                {{--{{ Form::label(trans('admin.mini_charge'), null, ['class' => 'control-label']) }}--}}
                {{--{{ Form::number('mini_charge', $branches->mini_charge, array_merge(['class' => 'form-control'])) }}--}}
            {{--</div>--}}
            {{Form::submit(trans('admin.update'),['class'=>'btn btn-primary'])}}
            {!! Form::close() !!}
        </div>
    </div>
@else
    <div class="alert alert-danger">{{trans('admin.you_cannt_see_invoice_because_you_dont_have_role_to_access')}}</div>

    @endhasrole







@endsection