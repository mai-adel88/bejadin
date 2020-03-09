@extends('hr.index')
@section('title', trans('hr.house_show'))
@section('root_link', route('houseTypeClass.index'))
@section('root_name', trans('hr.live_types_class'))
@section('content')
    @can('create')
        @push('css')
        @endpush
        @push('js')
        @endpush
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">{{trans('hr.house_show')}}</h3>
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
                                        <div class="form-control">{{ $HrPyhousTyp->HusTyp_No }}</div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <div class="form-control">{{ $HrPyhousTyp->HusTyp_NmAr }}</div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <div class="form-control">{{ $HrPyhousTyp->HusTyp_NmEn }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--Second tap--}}
                </div>
                <a class='btn btn-info btn-block' href="{{ route('houseTypeClass.index') }}">{{ trans('hr.previousback') }}</a>
                
            </div>
        </div>
    @endcan
@endsection
