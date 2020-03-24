
@extends('hr.index')
@section('title', trans('hr.hlds'))
@section('root_name', trans('hr.hlds'))
@section('content')
    @can('create')
        @push('css')
        <style>
            .input_text{
                    max-width: 100%;
                    height: 30px;
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
        @push('js')
            <script>
            $(document).ready(function () {

                $('.select2').select2({
                    dir: "{{direction()}}",
                    width: "100%"
                });
            </script>
        @endpush

        <div class="box">

            <div class="box-body">
            @include('hr.layouts.message')
                {{ Form::open(['method'=>'post', 'route' => 'dependents.store','files'=>true]) }}
                <div style="padding-bottom: 42px;">
                    {{Form::submit(trans('hr.save'), ['class'=>'btn btn-outline-success pull-left','style'=>'background-color: #34515f;color:#fff;'])}}
                </div>

                    <!-- First panel -->
                    <div class="panel panel-default">
                        <div class="panel-body" style="background-color: #34515f;color: #fff;">
                            <div class="row">
                                <div class="col-md-4">
                                    <label>{{trans('admin.company')}}</label>
                                    <select name="Cmp_No" class="Cmp_No select2 form-control">
                                        <option disabled selected>{{trans('admin.select')}}</option>

                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label>{{trans('hr.The_employee')}}</label>
                                    <select name="Emp_No" id="Emp_No" class="Emp_No select2 form-control">
                                        <option disabled selected>{{trans('admin.select')}}</option>

                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label>{{trans('hr.emp_no')}}</label>
                                    <input readonly style="margin-bottom:6px;" class="emp_no form-control input_text col-md-10" type="text">
                                </div>
                                <div class="col-md-2">
                                    <label>{{trans('hr.Passprt_No')}}</label>
                                    <input readonly name="Pasprt_No" style="margin-bottom:6px;" class="Pasprt_No form-control input_text col-md-10" type="text">
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-body" style="background-color: 34515f9e;color: #fff;">
                                    <!-- اسم الرافق عربي ورقمه -->
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="col-md-5" style="padding:0px;">{{trans('hr.escorts_no')}}</label>
                                            <input type="text" name="Host_No" value="" class="input_text form-control col-md-6" readonly>
                                        </div>
                                        <div class="col-md-9">
                                            <label class="col-md-1" style="padding:0px;">{{trans('hr.name_ar')}}</label>
                                            <input name="Host_NmAr1" class="Host_NmAr1 col-sm-6 col-md-2 input_text mr-lr-2" placeholder="الاول" style="margin-bottom: 2px;" type="text">
                                            <input name="Host_NmAr2" class="Host_NmAr2 col-sm-6 col-md-2 input_text mr-lr-2" placeholder="الثاني" type="text" >
                                            <input name="Host_NmAr3" class="Host_NmAr3 col-sm-6 col-md-2 input_text mr-lr-2" placeholder="الثالث" type="text" >
                                            <input name="Host_NmAr4" class="Host_NmAr4 col-sm-6 col-md-2 input_text" placeholder="الرابع" type="text" >
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
                                            <input name="Host_NmEn1" class="Host_NmEn1 col-sm-6 col-md-2 input_text mr-lr-2" type="text">
                                            <input name="Host_NmEn2" class="Host_NmEn2 col-sm-6 col-md-2 input_text mr-lr-2" type="text" >
                                            <input name="Host_NmEn3" class="Host_NmEn3 col-sm-6 col-md-2 input_text mr-lr-2" type="text" >
                                            <input name="Host_NmEn4" class="Host_NmEn4 col-sm-6 col-md-2 input_text" type="text" >
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 15px;">
                                        <div class="col-md-3">
                                            <label class="col-md-5" style="padding:0px;">{{trans('hr.relative_relation')}}</label>
                                            {{ Form::select('Relation',\App\Enums\RelationType::toSelectArray() ,null,
                                            array_merge(['class' => 'col-md-7 input_text','placeholder'=>trans('admin.select')])) }}

                                        </div>
                                        <div class="col-md-3">
                                            <label class="col-md-5" style="padding:0px;">{{trans('hr.nationality')}}</label>
                                            <select class="col-md-7 input_text" name="Cntry_No">
                                                <option disabled selected>{{trans('admin.select')}}</option>

                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="col-md-5" style="padding:0px;">{{trans('hr.birth_date')}}</label>
                                            <input name="Birth_dt" class="col-md-7 datepicker input_text" type="text" >
                                        </div>
                                        <div class="col-md-3">
                                        @foreach(\App\Enums\GenderType::toSelectArray() as $key => $value)
                                            <input class="checkbox-inline" type="radio"
                                                name="Gender" value="{{$key}}"
                                                style="" @if($key == 1) checked @endif>
                                            <label>{{$value}}</label>
                                        @endforeach
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 15px;">
                                        <div class="col-md-3">
                                            <label class="col-md-5" style="padding:0px;">{{trans('hr.religion')}}</label>
                                            {{ Form::select('Reljan_No',\App\Enums\Hr\HrReligion::toSelectArray() ,null,
                                            array_merge(['class' => 'col-md-7 input_text','placeholder'=>trans('admin.select')])) }}
                                        </div>
                                        <div class="col-md-3">
                                            <label class="col-md-5" style="padding:0px;">{{trans('hr.Pasprt_Ty')}}</label>
                                            {{ Form::select('Pasprt_Ty',\App\Enums\Hr\PassportType::toSelectArray() ,null,
                                            array_merge(['id'=>'Pasprt_Ty', 'class' => 'col-md-7 input_text form-control Pasprt_Ty', 'style'=>'padding-bottom: 0px','placeholder'=>trans('admin.select')])) }}
                                        </div>
                                        <div class="col-md-3">
                                            <label class="col-md-5" style="padding:0px;">{{trans('hr.job')}}</label>
                                            <select class="col-md-7 input_text" name="Job">
                                                <option disabled selected>{{trans('admin.select')}}</option>

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
                                            <input name="Resid_No"  class="Resid_No col-sm-6 col-md-2 input_text mr-lr-2" type="text">
                                            <input name="Resid_Plc" class="Resid_Plc col-sm-6 col-md-2 input_text mr-lr-2" type="text" >
                                            <input name="Resid_Sdt" class="Resid_Sdt col-sm-6 col-md-2 datepicker input_text mr-lr-2" type="text" >
                                            <input name="Resid_Edt" class="Resid_Edt col-sm-6 col-md-2 datepicker input_text" type="text" >
                                        </div>
                                        <!-- بيانات الجواز -->
                                        <div class="col-md-9">
                                            <label class="col-md-2"   style="padding:0px;">{{trans('hr.Passport_data')}}</label>
                                            <input name="Passprt_No"  class="Passprt_No col-sm-6 col-md-2 input_text mr-lr-2" type="text">
                                            <input name="Passprt_Plc" class="Passprt_Plc col-sm-6 col-md-2 input_text mr-lr-2" type="text" >
                                            <input name="Passprt_Sdt" class="Passprt_Sdt col-sm-6 col-md-2 datepicker input_text mr-lr-2" type="text" >
                                            <input name="Passprt_Edt" class="Passprt_Edt col-sm-6 col-md-2 datepicker input_text" type="text" >
                                        </div>
                                    </div>
                                    <!-- اسم الكفيل السابق -->
                                    <div class="row" style="margin-top: 15px;">
                                        <div class="col-md-9">
                                            <label class="col-md-2" style="padding:0px;">{{trans('hr.Trnsfer_OLdNm')}}</label>
                                            <input class="col-md-7 input_text" type="text" name="Trnsfer_OLdNm">
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
