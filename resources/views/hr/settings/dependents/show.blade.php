@extends('hr.index')
@section('title', trans('hr.escorts'))
@section('root_name', trans('hr.escorts'))
@section('content')
    @can('create')
        @push('css')
        <style>
            .input_text{
                    max-width: 100%;
                    height: 35px;
                    font-size: 14px;
                    line-height: 1.42857143;
                    text-align: center;
                    color: #555;
                    background-color: #fff;
                    background-image: none;
                    border: 1px solid #ccc;
                    border-radius: 4px;
                    -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
                    box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
                    -webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
                    -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
                    transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
                }
                .mr-lr-2{
                    margin: 0 5px;
                }
                .n-mp{
                    margin:0;
                    padding: 0;
                }
                .p-0{
                    padding:0;
                }
                .m-0{
                    margin:0;
                }
                .mb-5{
                    margin-bottom:10px;
                }
        </style>
        @endpush
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">{{trans('hr.show_escorts')}}</h3>
            </div>

            <div class="box-body">
                @include('hr.layouts.message')
                {{Form::model($dependent,['method'=>'PUT','route'=>['dependents.show',$dependent->ID_No],'class'=>'form-group','files'=>true])}}
                    <!-- First panel -->
                    <div class="panel panel-default">
                        <div class="panel-body" style="background-color: #708e70;color: #fff;">
                            <div class="row">
                                <div class="col-md-4">
                                    <label>{{trans('admin.company')}}</label>
                                    <select disabled name="Cmp_No"  class="Cmp_No  select2 form-control">
                                        <option disabled selected>{{trans('admin.select')}}</option>
                                        @foreach($companies as $company)
                                            <option @if($dependent->Cmp_No == $company->Cmp_No)selected @endif value="{{$company->Cmp_No}}">{{$company->Cmp_NmAr}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label>{{trans('hr.The_employee')}}</label>
                                    <select disabled name="Emp_No" id="Emp_No" class="Emp_No select2 form-control">
                                        <option value="{{$dependent->employee->Emp_No}}">{{$dependent->employee->Emp_NmAr}}</option>

                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label>{{trans('hr.emp_no')}}</label>
                                    <input readonly value="{{$dependent->employee->Emp_No}}" style="margin-bottom:6px;" class="emp_no form-control input_text col-md-10" type="text">
                                </div>
                                <div class="col-md-2">
                                    <label>{{trans('hr.Passprt_No')}}</label>
                                    <input readonly value="{{$dependent->Pasprt_No}}"  name="Pasprt_No" style="margin-bottom:6px;" class="Pasprt_No form-control input_text col-md-10" type="text">
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-body" style="background-color: darkseagreen;color: #fff;">
                                    <!-- اسم الرافق عربي ورقمه -->
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="col-md-5" style="padding:0px;">{{trans('hr.escorts_no')}}</label>
                                            <input type="text" value="{{$dependent->Host_No}}" name="Host_No" value="{{$last}}" class="input_text form-control col-md-6" readonly>
                                        </div>
                                        <div class="col-md-9">
                                            <label class="col-md-1" style="padding:0px;">{{trans('hr.name_ar')}}</label>
                                            <input disabled name="Host_NmAr1" value="{{$dependent->Host_NmAr1}}" class="Host_NmAr1 form-control col-sm-6 col-md-2 input_text mr-lr-2" placeholder="الاول" style="margin-bottom: 2px;" type="text">
                                            <input disabled name="Host_NmAr2" value="{{$dependent->Host_NmAr2}}" class="Host_NmAr2 form-control col-sm-6 col-md-2 input_text mr-lr-2" placeholder="الثاني" type="text" >
                                            <input disabled name="Host_NmAr3" value="{{$dependent->Host_NmAr3}}" class="Host_NmAr3 form-control col-sm-6 col-md-2 input_text mr-lr-2" placeholder="الثالث" type="text" >
                                            <input disabled name="Host_NmAr4" value="{{$dependent->Host_NmAr4}}" class="Host_NmAr4 form-control col-sm-6 col-md-2 input_text" placeholder="الرابع" type="text" >
                                        </div>
                                    </div>
                                    <!-- اسم الرافق EN ورقمه -->
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="col-md-5" style="padding:0px;"></label>
                                            <input type="text" class="input_text form-control col-md-6" style="display:none">
                                        </div>
                                        <div class="col-md-9">
                                            <label class="col-md-1" style="padding:0px;">En</label>
                                            <input disabled name="Host_NmEn1" value="{{$dependent->Host_NmEn1}}" class="Host_NmEn1 form-control col-sm-6 col-md-2 input_text mr-lr-2" type="text">
                                            <input disabled name="Host_NmEn2" value="{{$dependent->Host_NmEn2}}" class="Host_NmEn2 form-control col-sm-6 col-md-2 input_text mr-lr-2" type="text" >
                                            <input disabled name="Host_NmEn3" value="{{$dependent->Host_NmEn3}}" class="Host_NmEn3 form-control col-sm-6 col-md-2 input_text mr-lr-2" type="text" >
                                            <input disabled name="Host_NmEn4" value="{{$dependent->Host_NmEn4}}" class="Host_NmEn4 form-control col-sm-6 col-md-2 input_text" type="text" >
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 15px;">
                                        <div class="col-md-3">
                                            <label class="col-md-5" style="padding:0px;">{{trans('hr.relative_relation')}}</label>
                                            {{ Form::select('Relation',\App\Enums\RelationType::toSelectArray() ,null,
                                            array_merge(['class' => 'col-md-7 form-control input_text', 'disabled'=>'disabled','placeholder'=>trans('admin.select')])) }}

                                        </div>
                                        <div class="col-md-3">
                                            <label class="col-md-5" style="padding:0px;">{{trans('hr.nationality')}}</label>
                                            <select class="col-md-7 input_text form-control" disabled name="Cntry_No">
                                                <option disabled selected>{{trans('admin.select')}}</option>
                                                @foreach($countries as $country)
                                                    <option @if($dependent->Cntry_No == $country->id)selected @endif value="{{$country->id}}">{{$country->country_name_ar}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="col-md-5" style="padding:0px;">{{trans('hr.birth_date')}}</label>
                                            <input disabled name="Birth_dt" value="{{$dependent->Birth_dt}}" class="col-md-7 form-control datepicker input_text" type="text" >
                                        </div>
                                        <div class="col-md-3">
                                        @foreach(\App\Enums\GenderType::toSelectArray() as $key => $value)
                                            <input class="checkbox-inline" type="radio"
                                                disabled name="Gender" value="{{$key}}"
                                                style="" @if($dependent->Gender == $key) checked @endif>
                                            <label>{{$value}}</label>
                                        @endforeach
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 15px;">
                                        <div class="col-md-3">
                                            <label class="col-md-5" style="padding:0px;">{{trans('hr.religion')}}</label>
                                            {{ Form::select('Reljan_No',\App\Enums\Hr\HrReligion::toSelectArray() ,null,
                                            array_merge(['class' => 'col-md-7 form-control input_text', 'disabled'=>'disabled','placeholder'=>trans('admin.select')])) }}
                                        </div>
                                        <div class="col-md-3">
                                            <label class="col-md-5" style="padding:0px;">{{trans('hr.Pasprt_Ty')}}</label>
                                            {{ Form::select('Pasprt_Ty',\App\Enums\Hr\PassportType::toSelectArray() ,null,
                                            array_merge(['id'=>'Pasprt_Ty', 'disabled'=>'disabled','class' => 'col-md-7 input_text form-control Pasprt_Ty', 'style'=>'padding-bottom: 0px','placeholder'=>trans('admin.select')])) }}
                                        </div>
                                        <div class="col-md-3">
                                            <label class="col-md-5" style="padding:0px;">{{trans('hr.job')}}</label>
                                            <select class="col-md-7 form-control input_text" disabled name="Job">
                                                <option disabled selected>{{trans('admin.select')}}</option>
                                                @foreach($jobs as $job)
                                                    <option @if($dependent->Job == $job->Job_No)selected @endif value="{{$job->Job_No}}" disabled name="Job_No">{{$job->{'Job_Nm'.ucfirst(session('lang'))} }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 15px;">
                                        <div class="col-md-9">
                                            <label class="col-sm-6 col-md-2"></label>
                                            <label class="col-sm-6 col-md-2">{{trans('hr.number')}}</label>
                                            <label class="col-sm-6 col-md-2">{{trans('hr.version_pla')}}</label>
                                            <label class="col-sm-6 col-md-2">{{trans('hr.version_d')}}</label>
                                            <label class="col-sm-6 col-md-2">{{trans('hr.finishing_d')}}</label>
                                        </div>
                                        <!-- بيانات الاقامه -->
                                        <div class="col-md-9">
                                            <label class="col-md-2" style="padding:0px;">{{trans('hr.residence_data')}}</label>
                                            <input disabled name="Resid_No"  value="{{$dependent->Resid_No}}" class="Resid_No form-control col-sm-6 col-md-2 input_text mr-lr-2" type="text">
                                            <input disabled name="Resid_Plc" value="{{$dependent->Resid_Plc}}" class="Resid_Plc form-control col-sm-6 col-md-2 input_text mr-lr-2" type="text" >
                                            <input disabled name="Resid_Sdt" value="{{$dependent->Resid_Sdt}}" class="Resid_Sdt form-control col-sm-6 col-md-2 datepicker input_text mr-lr-2" type="text" >
                                            <input disabled name="Resid_Edt" value="{{$dependent->Resid_Edt}}" class="Resid_Edt form-control col-sm-6 col-md-2 datepicker input_text" type="text" >
                                        </div>
                                        <!-- بيانات الجواز -->
                                        <div class="col-md-9">
                                            <label class="col-md-2"   style="padding:0px;">{{trans('hr.Passport_data')}}</label>
                                            <input disabled name="Passprt_No"  value="{{$dependent->Passprt_No}}" class="Passprt_No form-control col-sm-6 col-md-2 input_text mr-lr-2" type="text">
                                            <input disabled name="Passprt_Plc" value="{{$dependent->Passprt_Plc}}" class="Passprt_Plc form-control col-sm-6 col-md-2 input_text mr-lr-2" type="text" >
                                            <input disabled name="Passprt_Sdt" value="{{$dependent->Passprt_Sdt}}" class="Passprt_Sdt form-control col-sm-6 col-md-2 datepicker input_text mr-lr-2" type="text" >
                                            <input disabled name="Passprt_Edt" value="{{$dependent->Passprt_Edt}}" class="Passprt_Edt form-control col-sm-6 col-md-2 datepicker input_text" type="text" >
                                        </div>
                                    </div>
                                    <!-- اسم الكفيل السابق -->
                                    <div class="row" style="margin-top: 15px;">
                                        <div class="col-md-9">
                                            <label class="col-md-2" style="padding:0px;">{{trans('hr.Trnsfer_OLdNm')}}</label>
                                            <input class="col-md-7 form-control input_text" value="{{$dependent->Trnsfer_OLdNm}}" type="text" disabled name="Trnsfer_OLdNm">
                                        </div>
                                    </div>

                                    <div class="panel panel-default" style="margin-top: 20px;">
                                        <div class="panel-body" style="background-color: darkseagreen;color: #fff;">
                                            <div class="row">
                                                <!-- تاشيرة القدوم -->
                                                <div class="col-md-4">
                                                    <div class="col-md-12">
                                                        <label class="col-md-6" style="padding:0px;">{{trans('hr.In_Job')}}</label>
                                                        <select class="col-md-6 mb-5 form-control input_text" disabled name="In_Job">
                                                            <option disabled selected>{{trans('admin.select')}}</option>
                                                            @foreach($job_gov as $gov)
                                                                <option @if($dependent->In_Job == $gov->Job_No)selected @endif value="{{$gov->Job_No}}">{{$gov->Job_NmAr}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label class="col-md-6" style="padding:0px;">{{trans('hr.In_VisaNo')}}</label>
                                                        <input class="col-md-6 mb-5 form-control input_text"  value="{{$dependent->In_VisaNo}}" disabled name="In_VisaNo" type="text">
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label class="col-md-6" style="padding:0px;">{{trans('hr.In_VisaDt')}}</label>
                                                        <input class="col-md-6 mb-5 form-control input_text datepicker" value="{{$dependent->In_VisaDt}}" disabled name="In_VisaDt" type="text">
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label class="col-md-6" style="padding:0px;">{{trans('hr.In_Port')}}</label>
                                                        <select class="col-md-6 mb-5 form-control input_text" disabled name="In_Port">
                                                            <option disabled selected>{{trans('admin.select')}}</option>
                                                            @foreach($ports as $port)
                                                                <option @if($dependent->In_Port == $port->Ports_No)selected @endif value="{{$port->Ports_No}}">{{$port->{'Ports_Nm'.ucfirst(session('lang'))} }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label class="col-md-6" style="padding:0px;">{{trans('hr.in_no')}}</label>
                                                        <input class="col-md-6 mb-5 form-control input_text" value="{{$dependent->In_EntrNo}}" disabled name="In_EntrNo" type="text">
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label class="col-md-6" style="padding:0px;">{{trans('hr.in_date')}}</label>
                                                        <input class="col-md-6 input_text form-control datepicker" value="{{$dependent->In_Date}}" disabled name="In_Date" type="text">
                                                    </div>
                                                </div>
                                                <!-- تاشيرة المغادره -->
                                                <div class="col-md-4">
                                                    <div class="col-md-12">
                                                        <label class="col-md-6" style="padding:0px;">{{trans('hr.Out_VisaNo')}}</label>
                                                        <input class="col-md-6 form-control input_text mb-5" value="{{$dependent->Out_VisaNo}}" disabled name="Out_VisaNo" type="text">
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label class="col-md-6" style="padding:0px;">{{trans('hr.Out_VisaDt')}}</label>
                                                        <input class="col-md-6 form-control input_text mb-5 datepicker" value="{{$dependent->Out_VisaDt}}" disabled name="Out_VisaDt" type="text">
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label class="col-md-6" style="padding:0px;">{{trans('hr.Out_Date')}}</label>
                                                        <input class="col-md-6 form-control input_text mb-5 datepicker" value="{{$dependent->Out_Date}}" disabled name="Out_Date" type="text">
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label class="col-md-6" style="padding:0px;">{{trans('hr.Out_Port')}}</label>
                                                        <select class="col-md-6 form-control input_text mb-5" disabled name="Out_Port">
                                                            <option disabled selected>{{trans('admin.select')}}</option>
                                                            @foreach($ports as $port)
                                                                <option @if($dependent->Out_Port == $port->Ports_No)selected @endif value="{{$port->Ports_No}}">{{$port->{'Ports_Nm'.ucfirst(session('lang'))} }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label class="col-md-6" style="padding:0px;">{{trans('hr.bail_transfer_date')}}</label>
                                                        <input class="col-md-6 form-control input_text datepicker" value="{{$dependent->Trnsfer_Dt}}" disabled name="Trnsfer_Dt" type="text">
                                                    </div>
                                                </div>
                                                <!-- image -->
                                                <div class="col-md-4">
                                                    <input value="{{$dependent->Photo}}" disabled name="Photo" type="file">
                                                </div>
                                                <div id="preview">
                                                    <img src="{{asset($dependent->Photo)}}" class="col-md-4" style="height: 180px;margin-top: 6px;">
                                                </div>

                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                {{Form::close()}}
            </div>
        </div>
    @endcan
@endsection
