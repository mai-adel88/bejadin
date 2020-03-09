@extends('hr.index')
@section('title', trans('hr.bank_edit'))
@section('root_link', route('bankPaymentData.index'))
@section('root_name', trans('hr.banks_information'))
@section('content')
    @can('create')
        @push('css')
        @endpush
        @push('js')
        @endpush 
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">{{trans('hr.bank_edit')}}</h3>
            </div>
            <div class="box-body">
                @include('hr.layouts.message')
                {{ Form::model($HrPybnkAcc, ['method'=>'PUT', 'route' => ['bankPaymentData.update',$HrPybnkAcc->ID_NO]]) }}

                {{--tap container--}}
                <div class="tab-content" id="myTabContent1">
                    {{--First tap--}}
                    <div class="tab-pane fade show active in" id="basic_information" role="tabpanel" aria-labelledby="home-tab">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <div class="form-control">{{ $HrPybnkAcc->Bnk_No }}</div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {{Form::text('Bnk_NmAr', old('Bnk_NmAr'),['class' => 'form-control Bnk_NmAr', 'placeholder'=>trans('hr.bank_name_ar')])}}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {{Form::text('Bnk_NmEn', old('Bnk_NmEn'),['class' => 'form-control Bnk_NmEn', 'placeholder' => trans('hr.bank_name_en')])}}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {{Form::text('Bnk_Acc', old('Bnk_Acc'),['class' => 'form-control Bnk_Acc', 'placeholder' => trans('hr.Bnk_Acc')])}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--Second tap--}}
                </div>
                {{Form::submit(trans('hr.save'), ['class'=>'btn btn-info btn-block'])}}
                {{Form::close()}}
            </div>
        </div>
    @endcan
@endsection
