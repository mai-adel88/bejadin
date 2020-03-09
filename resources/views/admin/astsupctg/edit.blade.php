@extends('admin.index')
@section('title',trans('admin.edit_suppliers'))
@section('content')
@hasrole('writer')
    <div class="box">
        @include('admin.layouts.message')
        <div class="box-header">
            <h3 class="box-title">{{$title}}</h3>
        </div>
        <div class="box-body">
            {!! Form::model($astsupctg,['method'=>'PUT','route' => ['astsupctg.update',$astsupctg->ID_No]]) !!}


            <br>
            <br>
            <div class="form-group row">
                <div class="col-md-6">
                    {!!Form::label('Supctg_Nmar', trans('admin.Supctg_Nmar'))!!}
                    {!!Form::text('Supctg_Nmar', null, ['class'=>'form-control'])!!}
                </div>

                <div class="col-md-6">
                    {!!Form::label('Supctg_Nmen', trans('admin.Supctg_Nmen'))!!}
                    {!!Form::text('Supctg_Nmen', null, ['class'=>'form-control'])!!}
                </div>
            </div>

            {{Form::submit(trans('admin.edit'),['class'=>'btn btn-primary'])}}
            {!! Form::close() !!}
        @else
    <div class="alert alert-danger">{{trans('admin.you_cannt_see_invoice_because_you_dont_have_role_to_access')}}</div>

@endhasrole






@endsection
