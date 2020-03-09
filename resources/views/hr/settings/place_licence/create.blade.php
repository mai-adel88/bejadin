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

                                <!-- نوع الرخصة -->
                                <div class="col-md-12">
                                    <fieldset id="tableFilter">
                                        
                                        <legend>{{ trans('hr.licenece_type')}}</legend>
                                        <!-- عملاء --> 
                                        <div class="row">
                                            <input id="cty_client" type="checkbox" value="1" name="cty_client" class="cty_client col-md-2 radio-inline">
                                            <label FOR="cty_client" class="col-md-10 p-0">{{trans('hr.cty_client')}}</label>
                                        </div>
                                        <!-- اقامة -->
                                        <div class="row">
                                            <input id="cty_resident" type="checkbox" value="1" name="cty_resident" class="cty_resident col-md-2 radio-inline">
                                            <label FOR="cty_resident" class="col-md-10 p-0">{{trans('hr.cty_resident')}}</label>
                                        </div>
                                        <!-- رخصة القيادة-->
                                        <div class="row">
                                            <input id="cty_drivlic" type="checkbox" value="1" name="cty_drivlic" class="cty_drivlic col-md-2 radio-inline">
                                            <label FOR="cty_drivlic" class="col-md-10 p-0 fs-13">{{trans('hr.cty_drivlic')}}</label>
                                        </div>
                                        <!-- رخصة مزاولة المهنة -->
                                        <div class="row">
                                            <input id="cty_jobactv" type="checkbox" value="1" name="cty_jobactv" class="cty_jobactv col-md-2 radio-inline">
                                            <label FOR="cty_jobactv" class="col-md-10 p-0">{{trans('hr.cty_jobactv')}}</label>
                                        </div>
                                        <!-- هوية وطنية -->
                                        <div class="row">
                                            <input id="cty_Nat_id" type="checkbox" value="1" name="cty_Nat_id" class="cty_Nat_id col-md-2 radio-inline">
                                            <label FOR="cty_Nat_id" class="col-md-10 p-0">{{trans('hr.cty_Nat_id')}}</label>
                                        </div>
                                        <!-- العنوان -->
                                        <div class="row">
                                            <input id="cty_address" type="checkbox" value="1" name="cty_address" class="cty_address col-md-2 radio-inline">
                                            <label FOR="cty_address" class="col-md-10 p-0">{{trans('hr.cty_address')}}</label>
                                        </div>
                                    </fieldset>
                                </div>
                                <!--  نوع الرخصة end-->
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
