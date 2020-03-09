@extends('hr.index')
@section('title', trans('hr.com_license_types_create'))
@section('root_link', route('companyLicenceType.index'))
@section('root_name', trans('hr.com_license_types'))
@section('content')
    @can('create')
        @push('css')
        @endpush
        @push('js')
        @endpush
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">{{trans('hr.com_license_types_create')}}</h3>
            </div>
            <div class="box-body">
                @include('hr.layouts.message')
                {{ Form::open(['method'=>'post', 'route' => 'companyLicenceType.store']) }}

                {{--tap container--}}
                <div class="tab-content" id="myTabContent1">
                    {{--First tap--}}
                    <div class="tab-pane fade show active in" id="basic_information" role="tabpanel" aria-labelledby="home-tab">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        {{Form::text('CmplicTyp_No', count(\App\Models\Hr\HrCmpLicType::all())!=0?\App\Models\Hr\HrCmpLicType::orderBy('ID_No', 'DESC')->latest()->first()->CmplicTyp_No+1:1,['class' => 'form-control CmplicTyp_No text-center', 'readonly'])}}
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        {{Form::text('CmplicTyp_NmAr', '',['class' => 'form-control CmplicTyp_NmAr', 'placeholder'=>trans('hr.com_license_types_name_ar')])}}
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        {{Form::text('CmplicTyp_NmEn', '',['class' => 'form-control CmplicTyp_NmEn', 'placeholder' => trans('hr.com_license_types_name_en')])}}
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
