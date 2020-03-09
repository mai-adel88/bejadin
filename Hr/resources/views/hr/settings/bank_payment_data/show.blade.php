@extends('hr.index')
@section('title', trans('hr.bank_show'))
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
                <h3 class="box-title">{{trans('hr.bank_show')}}</h3>
            </div>
            <div class="box-body">
                @include('hr.layouts.message')
               

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
                                        <div class="form-control">{{ $HrPybnkAcc->Bnk_NmAr }}</div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="form-control">{{ $HrPybnkAcc->Bnk_NmEn }}</div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="form-control">{{ $HrPybnkAcc->Bnk_Acc }}</div> 
                                    </div>
                                </div>
                        </div>
                    </div>
                    {{--Second tap--}}
                </div>
                <a href="{{route('bankPaymentData.index')}}" class="btn btn-info btn-block">{{trans('hr.previousback')}}</a>
            </div>
        </div>
    @endcan
@endsection
