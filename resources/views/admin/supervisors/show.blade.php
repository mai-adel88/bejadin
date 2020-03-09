@extends('admin.index')
@inject('branches', 'App\Models\Admin\MainBranch')
@inject('supervisors', 'App\Models\Admin\AstMarket)
@inject('companies', 'App\Models\Admin\MainCompany')

@section('title',trans('admin.show_profile_to') .session_lang($supervisor->Mrkt_NmEn,$supervisor->Mrkt_NmAr))
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

  {{Form::model($supervisor,['method'=>'PUT','route'=>['supervisors.update',$supervisor->ID_No],'class'=>'form-group','files'=>true])}}
        <div class="panel panel-default">
            <div class="panel-heading">
                <h5>{{trans('admin.show_supervisor').$supervisor->Mrkt_Nm.ucfirst(session('lang'))}}</h5>
            </div>
            <div class="panel-body">
                @can('single')

                    <div class="form-group col-md-8">
                        <div class="form-group row col-md-12">
                            <div class="col-md-9">
                                <div class="col-md-4">{!!Form::label('Mrkt_No', trans('admin.Mrkt_No'))!!}</div>
                                <div class="col-md-8">{!!Form::text('Mrkt_No', old('Mrkt_No'), ['class'=>'form-control', 'readonly'=>'true'])!!}</div>

                            </div>
                            <div class="col-md-3">
                                <ul>
                                    <li style="list-style: none;">
                                        <a class="pull-right">@if($supervisor->Mrkt_Active == 1)<div class="badge">{{trans('admin.active')}}</div>
                                            @else <div class="badge">{{trans('admin.deactive')}}</div> @endif</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="form-group row col-md-12">
                            <div class="col-md-3">{!!Form::label('Cmp_No', trans('admin.Cmp_No'))!!}</div>
                            <div class="col-md-9">
                                @if($supervisor->Cmp_No==null)
                                    {!! Form::text('Cmp_No', old('Cmp_No'), ['class' =>'form-control', 'readonly'=>'true']) !!}

                                @else
                                    {!! Form::text('Cmp_No', $supervisor->company->{'Cmp_Nm'.ucfirst(session('lang'))}, ['class' =>'form-control', 'readonly'=>'true']) !!}
                                @endif
                            </div>
                        </div>
                        <div class="form-group row col-md-12">
                            <div class="col-md-3">{!!Form::label('Brn_No', trans('admin.branche'))!!}</div>
                            <div class="col-md-9">

                                @if($supervisor->Brn_No==null)
                                    {!! Form::text('Brn_No', old('Brn_No'), ['class' =>'form-control', 'readonly'=>'true']) !!}

                                @else
                                    {!! Form::text('Brn_No', $supervisor->branch->{'Brn_Nm'.ucfirst(session('lang'))}, ['class' =>'form-control', 'readonly'=>'true']) !!}
                                @endif
                            </div>
                        </div>

                        <div class="form-group row col-md-12">
                            <div class="col-md-3">{!!Form::label('Mrkt_NmAr', trans('admin.subscriber_name_ar'))!!}</div>
                            <div class="col-md-9">{!!Form::text('Mrkt_NmAr', old('Mrkt_NmAr'), ['class'=>'form-control', 'readonly'=>'true'])!!}</div>
                        </div>
                        <div class="form-group row col-md-12">
                            <div class="col-md-3">{!!Form::label('Mrkt_NmEn', trans('admin.subscriber_name_en'))!!}</div>
                            <div class="col-md-9">{!!Form::text('Mrkt_NmEn', old('Mrkt_NmEn'), ['class'=>'form-control', 'readonly'=>'true'])!!}</div>
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
