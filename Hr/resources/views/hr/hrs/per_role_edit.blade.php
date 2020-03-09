@extends('hr.index')
@section('title',trans('hr.edit_permissions'))
@section('root_link', route('hrs.index'))
@section('root_name', trans('hr.hr_account'))
@section('content')
    @hasrole('hr')
    @push('js')
        <script>
            $(function () {
                'use strict'
                $('.type').select2({
                    placeholder: "Select...",
                    allowClear: true
                });
            });
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
        @include('hr.layouts.message')
        <div class="box-header">
            <h3 class="box-title"> {{trans('hr.edit_permissions') . ' لـ ' . $admin->name}}</h3>
        </div>
        <div class="box-body">
            {!! Form::model($admin->id,['method'=>'PUT','route' => ['HrPermission_role.update',$admin->id]]) !!}
            <div class="form-group">
                {{ Form::label(trans('hr.roles'), null, ['class' => 'control-label']) }}
                {!! Form::select('roles[]', $roles, $roles, ['multiple'=>'multiple','class' => 'form-control type']) !!}
            </div>
            <div class="form-group">
                {{ Form::label(trans('hr.permissions'), null, ['class' => 'control-label']) }}
                {{Form::select('permissions[]',$permissions ,$permissions,array('multiple'=>'multiple','class' => 'form-control type'))}}
            </div>
            {{Form::submit(trans('hr.edit'),['class'=>'btn btn-primary'])}}
            {!! Form::close() !!}
        </div>
    </div>

    @else
        <div class="alert alert-danger">{{trans('hr.access_denied')}}</div>

        @endhasrole

@endsection
