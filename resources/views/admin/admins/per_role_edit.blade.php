@extends('admin.index')
@section('title',trans('admin.Edit_Permission'))
@section('content')
    @hasrole('admin')
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
        @include('admin.layouts.message')
        <div class="box-header">
            <h3 class="box-title"> {{trans('admin.Edit_roles_and_permissions_of') . ' ' . $admin->name}}</h3>
        </div>
        <div class="box-body">
            {!! Form::model($admin->id,['method'=>'PUT','route' => ['permission_role.update',$admin->id]]) !!}
            <div class="form-group">
                {{ Form::label(trans('admin.Roles'), null, ['class' => 'control-label']) }}
                {!! Form::select('roles[]', $roles, $roles, ['multiple'=>'multiple','class' => 'form-control type']) !!}
            </div>
            <div class="form-group">
                {{ Form::label(trans('admin.permission'), null, ['class' => 'control-label']) }}
                {{Form::select('permissions[]',$permissions ,$permissions,array('multiple'=>'multiple','class' => 'form-control type'))}}
            </div>
            {{Form::submit(trans('admin.update'),['class'=>'btn btn-primary'])}}
            {!! Form::close() !!}
        </div>
    </div>

    @else
        <div class="alert alert-danger">{{trans('admin.you_cannt_see_invoice_because_you_dont_have_role_to_access')}}</div>

        @endhasrole






@endsection