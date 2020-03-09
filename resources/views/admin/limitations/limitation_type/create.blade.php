@extends('admin.index')
@section('title', trans('admin.create_new_limitation_type'))
@section('content')
    @hasrole('admin')
    @can('create')
        <div class="row">
            <div class="col-md-12">@include('admin.layouts.message')</div>
        </div>
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">{{trans('admin.create_new_limitation_type')}}</h3>
            </div>
            <div class="box-body">
                {!! Form::open(['method'=>'POST','route' => 'limitationType.store','files'=>true]) !!}
                <div class="col-md-2">
                    <div class="form-group">
                        {{ Form::label(trans('admin.Jr_Ty_no'), null, ['class' => 'control-label']) }}
                        @php
                            $jrType = \App\Models\Admin\GLAstJrntyp::orderBy('ID_NO', 'DESC')->latest()->first()? \App\Models\Admin\GLAstJrntyp::orderBy('ID_NO', 'DESC')->latest()->first()->Jr_Ty+1:1;
                        @endphp
                         {{ Form::text('Jr_Ty', $jrType, array_merge(['class' => 'form-control', 'readonly'])) }}
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        {{ Form::label('Jrty_NmAr',trans('admin.Jrty_NmAr'), null, ['class' => 'control-label']) }}
                        {{ Form::text('Jrty_NmAr', old('Jrty_NmAr'), array_merge(['class' => 'form-control'])) }}
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        {{ Form::label('Jrty_NmEn', trans('admin.Jrty_NmEn'), null, ['class' => 'control-label']) }}
                        {{ Form::text('Jrty_NmEn', old('Jrty_NmEn'), array_merge(['class' => 'form-control'])) }}
                    </div>
                </div>
                <div class="col-md-12">
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
