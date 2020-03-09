@extends('hr.index')
@section('title', trans('hr.house_edit'))
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
                <h3 class="box-title">{{trans('hr.house_edit')}}</h3>
            </div>
            <div class="box-body">
                @include('hr.layouts.message')
                {{ Form::model($HrPyhousTyp,['method'=>'PUT', 'route' => ['houseTypeClass.update',$HrPyhousTyp->ID_NO]]) }}

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
                                        {{Form::text('HusTyp_NmAr', old('HusTyp_NmAr'),['class' => 'form-control HusTyp_NmAr', 'placeholder'=>trans('hr.house_name_ar')])}}
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        {{Form::text('HusTyp_NmEn', old('HusTyp_NmEn'),['class' => 'form-control HusTyp_NmEn', 'placeholder' => trans('hr.house_name_en')])}}
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
