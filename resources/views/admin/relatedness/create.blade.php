@extends('admin.index')
@section('title',trans('admin.create_new_relatedness'))
@section('content')
    @can('create')
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
            {!! Form::open(['method'=>'POST','route' => 'relatedness.store','files'=>true]) !!}
            <div class="form-group">
                {{ Form::label(trans('admin.arabic_name'), null, ['class' => 'control-label']) }}
                {{ Form::text('name_ar', null, array_merge(['class' => 'form-control'])) }}
            </div>
            <div class="form-group">
                {{ Form::label(trans('admin.english_name'), null, ['class' => 'control-label']) }}
                {{ Form::text('name_en', null, array_merge(['class' => 'form-control'])) }}
            </div>

            <div class="form-group">
                {{ Form::label(trans('admin.mob'), null, ['class' => 'control-label']) }}
                {{ Form::number('phone', null, array_merge(['class' => 'form-control'])) }}
            </div>
            <div class="form-group">
                {{ Form::label('subscriptions', trans('admin.subscription'), ['class' => 'control-label']) }}
                <select name="subscription[]" class="type form-control" placeholder="{{trans('admin.select')}}" multiple="multiple" id="e2">
                    <option></option>
                    @foreach ($subscriptions as $subscription)
                        <option value="{{$subscription->id}}">{{session_lang($subscription->name_en,$subscription->name_ar)}}</option>
                    @endforeach
                </select>
            </div>
            {{Form::submit(trans('admin.send'),['class'=>'btn btn-primary'])}}
            {!! Form::close() !!}
        </div>
    </div>

@endcan





@endsection