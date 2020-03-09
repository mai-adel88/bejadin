@extends('hr.index')
@section('title', trans('hr.place_licence_create'))
@section('root_link', route('placeLicence.index'))
@section('root_name', trans('hr.where_licences_cities'))
@section('content')
    @can('create')
        @push('css')
        @endpush
        @push('js')
        @endpush
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">{{trans('hr.place_licence_create')}}</h3>
            </div>
            <div class="box-body">
                @include('hr.layouts.message')
                {{ Form::open(['method'=>'post', 'route' => 'placeLicence.store']) }}

                {{--tap container--}}
                <div class="tab-content" id="myTabContent1">
                    {{--First tap--}}
                    <div class="tab-pane fade show active in" id="basic_information" role="tabpanel" aria-labelledby="home-tab">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        {{Form::text('State_No', count(\App\Models\Hr\HrAstPlcLicns::all())!=0?\App\Models\Hr\HrAstPlcLicns::orderBy('ID_No', 'DESC')->latest()->first()->State_No+1:1,['class' => 'form-control Cmp_No text-center', 'readonly'])}}
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        {{Form::text('State_NmAr', '',['class' => 'form-control State_NmAr', 'placeholder'=>trans('hr.place_licence_name_ar')])}}
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        {{Form::text('State_NmEn', '',['class' => 'form-control State_NmEn', 'placeholder' => trans('hr.place_licence_name_en')])}}
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
