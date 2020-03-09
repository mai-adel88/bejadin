@extends('hr.index')
@section('title', trans('hr.com_license_providers_create'))
@section('root_link', route('companyLicenceProviders.index'))
@section('root_name', trans('hr.com_license_providers'))
@section('content')
    @can('create')
        @push('css')
        @endpush
        @push('js')
        @endpush
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">{{trans('hr.com_license_providers_create')}}</h3>
            </div>
            <div class="box-body">
                @include('hr.layouts.message')
                {{ Form::open(['method'=>'post', 'route' => 'companyLicenceProviders.store']) }}

                {{--tap container--}}
                <div class="tab-content" id="myTabContent1">
                    {{--First tap--}}
                    <div class="tab-pane fade show active in" id="basic_information" role="tabpanel" aria-labelledby="home-tab">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        {{Form::text('CmpLicisu_No', count(\App\Models\Hr\HrAstCmpLicIsu::all())!=0?\App\Models\Hr\HrAstCmpLicIsu::orderBy('ID_No', 'DESC')->latest()->first()->CmpLicisu_No+1:1,['class' => 'form-control CmpLicisu_No text-center', 'readonly'])}}
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        {{Form::text('CmpLicisu_NmAr', '',['class' => 'form-control CmpLicisu_NmAr', 'placeholder'=>trans('hr.com_license_providers_name_ar')])}}
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        {{Form::text('CmpLicisu_NmEn', '',['class' => 'form-control CmpLicisu_NmEn', 'placeholder' => trans('hr.com_license_providers_name_en')])}}
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
