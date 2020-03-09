@extends('hr.index')
@section('title', trans('hr.nationality_edit'))
@section('root_link', route('nationality.index'))
@section('root_name', trans('hr.nationality'))
@section('content')
    @can('create')
        @push('css')
        @endpush
        @push('js')
        @endpush
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">{{trans('hr.nationality_edit')}}</h3>
            </div>
            <div class="box-body">
                @include('hr.layouts.message')
                {!! Form::model($nationality,['method'=>'PUT', 'route' => ['nationality.update',$nationality->ID_NO]]) !!}

                

                {{--tap container--}}
                <div class="tab-content" id="myTabContent1">
                    {{--First tap--}}
                    <div class="tab-pane fade show active in" id="basic_information" role="tabpanel" aria-labelledby="home-tab">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        {{Form::text('Cntry_No', count(\App\Models\Hr\HrAstEmpCntry::all())!=0?\App\Models\Hr\HrAstEmpCntry::orderBy('ID_No', 'DESC')->latest()->first()->Cntry_No:1,['class' => 'form-control CmpLicplc_No text-center', 'readonly'])}}
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        {{Form::text('Cntry_NmAr', old('Cntry_NmAr'),['class' => 'form-control Cntry_NmAr', 'placeholder'=>trans('hr.nationality_name_ar')])}}
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        {{Form::text('Cntry_NmEn', old('Cntry_NmEn'),['class' => 'form-control Cntry_NmEn', 'placeholder' => trans('hr.nationality_name_en')])}}
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
