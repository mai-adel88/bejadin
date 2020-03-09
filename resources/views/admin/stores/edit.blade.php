@extends('admin.index')
@section('title', trans('admin.edit_store'))
@section('content')
<<<<<<< HEAD

    <div class="box">
        @include('admin.layouts.message')
        <div class="box-header">
            <h3 class="box-title">{{$title}}</h3>
        </div>
        <div class="box-body">
            {!! Form::model($admin,['method'=>'PUT','route' => ['stores.update',$admin->ID_No],'files'=>true]) !!}
            <div class="col-md-1">
                <div class="form-group">
                    {{ Form::label('admin.number', trans('admin.number') , ['class' => 'control-label']) }}
                    <input type="text" name="Dlv_Stor" class="form-control" value="{{$admin->Dlv_Stor != null ? $admin->Dlv_Stor:null}}" readonly>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    {{ Form::label('Brn_No', trans('admin.Branches') , ['class' => 'control-label']) }}

                    {{ Form::select('Brn_No',$branches ,$admin->Brn_No,array_merge(['class' => 'form-control'])) }}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    {{ Form::label(trans('admin.name_ar'), null, ['class' => 'control-label']) }}
                    {{ Form::text('Dlv_NmAr', old('Dlv_NmAr'), array_merge(['class' => 'form-control'])) }}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    {{ Form::label(trans('admin.name_en'), null, ['class' => 'control-label']) }}
                    {{ Form::text('Dlv_NmEn', old('Dlv_NmEn'), array_merge(['class' => 'form-control'])) }}
                </div>
            </div>

            {{Form::submit( trans('admin.update'),['class'=>'btn btn-primary'])}}
            {!! Form::close() !!}
=======
    @hasrole('admin')
    @can('create')


        <div class="box">

            <div class="box-header">
                <h3 class="box-title">{{trans('admin.edit_store')}}</h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        @include('admin.layouts.message')
                    </div>
                </div>
                {!! Form::open(['method'=>'PUT','route' => ['stores.update', $store->ID_No]]) !!}
                <div class="col-md-1">
                    <div class="form-group">
                        {{ Form::label('admin.number', trans('admin.number') , ['class' => 'control-label']) }}
                        <input type="text" name="Dlv_Stor" class="form-control" value="{{$store != null ? $store->Dlv_Stor:''}}" readonly>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        {{ Form::label('Brn_No', trans('admin.Branches') , ['class' => 'control-label']) }}
                        <select name="Brn_No" id="Brn_No" class="form-control">
                            <option value="">{{trans('admin.select')}}</option>
                            @foreach($branches as $branch)
                                <option @if($store->Brn_No == $branch->ID_No)  selected @endif value="{{$branch->ID_No}}">{{$branch->{'Brn_Nm'.ucfirst(session('lang'))} }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {{ Form::label(trans('admin.name_ar'), null, ['class' => 'control-label']) }}
                        {{ Form::text('Dlv_NmAr', $store->Dlv_NmAr, array_merge(['class' => 'form-control'])) }}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {{ Form::label(trans('admin.name_en'), null, ['class' => 'control-label']) }}
                        {{ Form::text('Dlv_NmEn', $store->Dlv_NmEn, array_merge(['class' => 'form-control'])) }}
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        {{Form::submit(trans('admin.save'),['class'=>'btn btn-primary'])}}
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
>>>>>>> 5558cfca9acd8c2bc1580cc16a04b8f8baf9dad7
        </div>
    @endcan
    @else
        <div class="alert alert-danger">{{trans('admin.you_cannt_see_invoice_because_you_dont_have_role_to_access')}}</div>

<<<<<<< HEAD
=======
        @endhasrole

>>>>>>> 5558cfca9acd8c2bc1580cc16a04b8f8baf9dad7






@endsection
