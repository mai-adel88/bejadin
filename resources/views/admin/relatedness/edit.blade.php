@extends('admin.index')
@section('title',trans('admin.edit_relatedness'))
@section('content')
    @push('js')

        <script>
            $(function () {
                'use strict'
                $('#e2').select2({
                    placeholder: "select a subscriber",
                    dir: '{{direction()}}'
                });
            })
        </script>


    @endpush
    @push('css')
        <style>
            .select2-container--default .select2-selection--multiple .select2-selection__choice{
                background-color: #333;
            }
        </style>

    @endpush
    <div class="box">
        @include('admin.layouts.message')
        <div class="box-header">
            <h3 class="box-title">{{$title}}</h3>
        </div>
        <div class="box-body">
            {!! Form::model($related,['method'=>'PUT','route' => ['relatedness.update',$related->id]]) !!}
            <div class="form-group">
                {{ Form::label(trans('admin.arabic_name'), null, ['class' => 'control-label']) }}
                {{ Form::text('name_ar', $related->name_ar, array_merge(['class' => 'form-control'])) }}
            </div>
            <div class="form-group">
                {{ Form::label(trans('admin.english_name'), null, ['class' => 'control-label']) }}
                {{ Form::text('name_en', $related->name_en, array_merge(['class' => 'form-control'])) }}
            </div>

            <div class="form-group">
                {{ Form::label(trans('admin.mob'), null, ['class' => 'control-label']) }}
                {{ Form::number('phone', $related->phone, array_merge(['class' => 'form-control'])) }}
            </div>
            <div class="form-group">
                {{ Form::label(trans('admin.subscription'), null, ['class' => 'control-label']) }}
                {{ Form::select('subscription[]', $subscriptions->pluck('name_'.session('lang'),'id') ,null, array_merge(['class' => 'form-control type','id'=>'e2',"multiple"=>"multiple"])) }}
            </div>

            {{Form::submit(trans('admin.update'),['class'=>'btn btn-primary'])}}
            {!! Form::close() !!}
        </div>
    </div>







@endsection