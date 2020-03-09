@extends('admin.index')
@inject('branches', 'App\Models\Admin\MainBranch')
@inject('supervisors', 'App\Models\Admin\AstMarket)
@inject('companies', 'App\Models\Admin\MainCompany')

@section('title',trans('admin.show_details'))
@section('content')


    @push('css')
    <style>
        @if(session('lang') == 'ar')
            .datepicker{
            direction: rtl;
        }
        @endif
    </style>
    @endpush

    @include('admin.layouts.message')

  {{Form::model($delegate,['method'=>'PUT','route'=>['delegates.update',$delegate->ID_No],'class'=>'form-group','files'=>true])}}
    <div class="panel panel-default">
        <div class="panel-heading">
            <h5>{{trans('admin.show_delegate').$delegate->Slm_NmAr}}</h5>
        </div>
        <div class="panel-body">




            @can('single')


                <div class="form-group col-md-8">
                    <div class="form-group row col-md-12">
                        <div class="col-md-9">
                            <div class="col-md-4">{!!Form::label('Slm_No', trans('admin.Slm_No'))!!}</div>
                            <div class="col-md-8">{!!Form::text('Slm_No', null, ['class'=>'form-control', 'readonly'=>'true'])!!}</div>

                        </div>
                        <div class="col-md-3">
                            <ul>
                                <li style="list-style: none;">
                                    <a class="pull-right">@if($delegate->Slm_Active == 1)<div class="badge">{{trans('admin.active')}}</div>
                                        @else <div class="badge">{{trans('admin.deactive')}}</div> @endif</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="form-group row col-md-12">
                        <div class="col-md-3">{!!Form::label('Cmp_No', trans('admin.Cmp_No'))!!}</div>
                        <div class="col-md-9">
                            @if($delegate->Cmp_No==null)
                                {!! Form::text('Cmp_No', '' , ['class' =>'form-control', 'readonly'=>'true']) !!}

                            @else
                                {!! Form::text('Cmp_No', $delegate->company->{'Cmp_Nm'.ucfirst(session('lang'))}, ['class' =>'form-control', 'readonly'=>'true']) !!}
                            @endif
                        </div>
                    </div>
                    <div class="form-group row col-md-12">
                        <div class="col-md-3">{!!Form::label('Brn_No', trans('admin.branche'))!!}</div>
                        <div class="col-md-9">
                            @if($delegate->Brn_No==null)
                                {!! Form::text('Brn_No', '' , ['class' =>'form-control', 'readonly'=>'true']) !!}

                            @else
                                {!! Form::text('Brn_No', $delegate->branch->{'Brn_Nm'.ucfirst(session('lang'))}, ['class' =>'form-control', 'readonly'=>'true']) !!}
                            @endif
                        </div>
                    </div>

                    <div class="form-group row col-md-12">
                        <div class="col-md-3">{!!Form::label('StoreNo', trans('admin.StoreNo'))!!}</div>
                        <div class="col-md-9">
                            @if($delegate->StoreNo==null)
                                {!! Form::text('StoreNo', '' , ['class' =>'form-control', 'readonly'=>'true']) !!}

                            @else
                                {!! Form::text('StoreNo', $delegate->branch->{'Brn_Nm'.ucfirst(session('lang'))}, ['class' =>'form-control', 'readonly'=>'true']) !!}
                            @endif
                        </div>
                    </div>
                    <div class="form-group row col-md-12">
                        <div class="col-md-3">{!!Form::label('Mark_No', trans('admin.Mark_No'))!!}</div>
                        <div class="col-md-9">
                            {!!Form::select('Mark_No' ,$supervisors->pluck('Mrkt_Nm'.ucfirst(session('lang')),'ID_No')->toArray(),null,[
                                'class'=>'form-control','placeholder'=>trans('admin.select'), 'readonly'=>'true'
                            ])!!}
                        </div>
                    </div>
                    <div class="form-group row col-md-12">
                        <div class="col-md-3">{!!Form::label('Slm_NmAr', trans('admin.subscriber_name_ar'))!!}</div>
                        <div class="col-md-9">{!!Form::text('Slm_NmAr', null, ['class'=>'form-control', 'readonly'=>'true'])!!}</div>
                    </div>
                    <div class="form-group row col-md-12">
                        <div class="col-md-3">{!!Form::label('Slm_NmEn', trans('admin.subscriber_name_en'))!!}</div>
                        <div class="col-md-9">{!!Form::text('Slm_NmEn', null, ['class'=>'form-control', 'readonly'=>'true'])!!}</div>
                    </div>
                    <div class="form-group row col-md-12">
                        <div class="col-md-3">{!!Form::label('Slm_Tel', trans('admin.tel'))!!}
                        </div>
                        <div class="col-md-9">{!!Form::text('Slm_Tel', null, ['class'=>'form-control', 'readonly'=>'true'])!!}
                        </div>
                    </div>
                    <div class="form-group row col-md-12">
                        <div class="col-md-3">{!!Form::label('Target', trans('admin.Target'))!!}</div>
                        <div class="col-md-9">{!!Form::text('Target', null, ['class'=>'form-control', 'readonly'=>'true'])!!}</div>

                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">{{trans('admin.add')}}</button>
                    </div>
                </div>

                <div class="col-md-6">


                    @else
                        <div class="alert alert-danger">{{trans('admin.you_cannt_see_invoice_because_you_dont_have_role_to_access')}}</div>

                    @endcan
                </div>


                {{ Form::close() }}

        </div>
    </div>

@endsection
