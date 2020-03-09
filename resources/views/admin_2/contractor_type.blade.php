@extends('admin.index')
@section('title',trans('admin.Types_of_Contractors'))
@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{trans('admin.Types_of_Contractors')}} </h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            @include('admin.layouts.message')
            {!! Form::open(['route'=>'contractor.add','files' => true]) !!}

            <div class="form-group">
                {{ Form::label(trans('admin.Type_of_Contractor_Arabic'), trans('admin.Type_of_Contractor_Arabic') , ['class' => 'control-label']) }}
                {{ Form::text('name_ar', null, array_merge(['class' => 'form-control','placeholder' => trans('admin.arabic_name')])) }}
                @if ($errors->has('name_ar'))
                    <div class="alert alert-danger" style="margin-top: 10px">{{ $errors->first('name_ar') }}</div>
                @endif
            </div>
            <div class="form-group">
                {{ Form::label(trans('admin.Type_of_Contractor_English'), trans('admin.Type_of_Contractor_English') , ['class' => 'control-label']) }}
                {{ Form::text('name_en', null, array_merge(['class' => 'form-control','placeholder' => trans('admin.english_name')])) }}
                @if ($errors->has('name_en'))
                    <div class="alert alert-danger" style="margin-top: 10px">{{ $errors->first('name_en') }}</div>
                @endif
            </div>
             

            {{Form::submit(trans('admin.add'),['class'=>'btn btn-primary'])}}
            {!! Form::close() !!}
        </div>
        <!-- /.box-body -->
    </div>







@endsection