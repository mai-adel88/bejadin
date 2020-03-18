
@extends('hr.index')
@section('title', trans('hr.escorts'))
@section('root_link', route('hrcountries.index'))
@section('root_name', trans('hr.departments'))
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
         });
        </script>
        @endpush
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">{{trans('hr.add_escorts')}}</h3>
                @include('hr.layouts.message')
                {{ Form::open(['method'=>'post', 'route' => 'hrdepartments.store']) }}
                {{Form::submit(trans('hr.save'), ['class'=>'btn btn-outline-success my-2 my-sm-0 pull-left','style'=>'background-color: #708e70;color:#fff;'])}}
            </div>
            <div class="box-body">

                    {{--First tap--}}
                    <div class="panel panel-default">
                        <div class="panel-body" style="background-color: #708e70;color: #fff;">
                            <div class="row">
                                <div class="col-md-4">
                                    <label>{{trans('admin.company')}}</label>
                                    <select name="Cmp_No" class="Cmp_No col-md-9 select2 form-control">
                                        <option disabled selected>{{trans('admin.select')}}</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label>{{trans('hr.The_employee')}}</label>
                                    <select name="Cmp_No" class="Cmp_No col-md-9 select2 form-control">
                                        <option disabled selected>{{trans('admin.select')}}</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label>{{trans('hr.emp_no')}}</label>
                                    <input readonly style="margin-bottom:6px;" class="form-control input_text col-md-10" type="text">
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-body" style="background-color: darkseagreen;color: #fff;">
                                    <!-- اسم الرافق عربي ورقمه -->
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="col-md-5" style="padding:0px;">{{trans('hr.escorts_no')}}</label>
                                            <input type="text" class="input_text form-control col-md-6" readonly>
                                        </div>
                                        <div class="col-md-9">
                                            <label class="col-md-1" style="padding:0px;">{{trans('hr.name_ar')}}</label>
                                            <input name="Emp_NmAr1" class="Emp_NmAr1 col-sm-6 col-md-2 input_text mr-lr-2" placeholder="الاول" style="margin-bottom: 2px;" type="text">
                                            <input name="Emp_NmAr2" class="Emp_NmAr2 col-sm-6 col-md-2 input_text mr-lr-2" placeholder="الثاني" type="text" >
                                            <input name="Emp_NmAr3" class="Emp_NmAr3 col-sm-6 col-md-2 input_text mr-lr-2" placeholder="الثالث" type="text" >
                                            <input name="Emp_NmAr4" class="Emp_NmAr4 col-sm-6 col-md-2 input_text" placeholder="الرابع" type="text" >
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
                                            <input name="Emp_NmAr1" class="Emp_NmAr1 col-sm-6 col-md-2 input_text mr-lr-2" type="text">
                                            <input name="Emp_NmAr2" class="Emp_NmAr2 col-sm-6 col-md-2 input_text mr-lr-2" type="text" >
                                            <input name="Emp_NmAr3" class="Emp_NmAr3 col-sm-6 col-md-2 input_text mr-lr-2" type="text" >
                                            <input name="Emp_NmAr4" class="Emp_NmAr4 col-sm-6 col-md-2 input_text" type="text" >
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 15px;">
                                        <div class="col-md-3">
                                            <label class="col-md-5" style="padding:0px;">{{trans('hr.relative_relation')}}</label>
                                            <select class="col-md-7 input_text" name="" id="">
                                                <option disabled selected>{{trans('admin.select')}}</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="col-md-5" style="padding:0px;">{{trans('hr.nationality')}}</label>
                                            <select class="col-md-7 input_text" name="" id="">
                                                <option disabled selected>{{trans('admin.select')}}</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="col-md-5" style="padding:0px;">{{trans('hr.birth_date')}}</label>
                                            <input class="col-md-7 datepicker" type="text" >
                                        </div>
                                        <div class="col-md-3">
                                            @foreach(\App\Enums\GenderType::toSelectArray() as $key => $value)
                                            <input id="{{$value}}" class="checkbox-inline" type="radio"
                                                    name="Gender" value="{{$key}}"
                                                     @if($key == 1) checked @endif>
                                            <label for="{{$value}}">{{$value}}</label>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 15px;">
                                        <div class="col-md-3">
                                            <label class="col-md-5" style="padding:0px;">{{trans('hr.religion')}}</label>
                                            <select class="col-md-7 input_text" name="" id="">
                                                <option disabled selected>{{trans('admin.select')}}</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="col-md-5" style="padding:0px;">{{trans('hr.Pasprt_Ty')}}</label>
                                            <select class="col-md-7 input_text" name="" id="">
                                                <option disabled selected>{{trans('admin.select')}}</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="col-md-5" style="padding:0px;">{{trans('hr.job')}}</label>
                                            <select class="col-md-7 input_text" name="" id="">
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
                                            <input name="Emp_NmAr1" class="Emp_NmAr1 col-sm-6 col-md-2 input_text mr-lr-2" type="text">
                                            <input name="Emp_NmAr2" class="Emp_NmAr2 col-sm-6 col-md-2 input_text mr-lr-2" type="text" >
                                            <input name="Emp_NmAr3" class="Emp_NmAr3 col-sm-6 col-md-2 datepicker input_text mr-lr-2" type="text" >
                                            <input name="Emp_NmAr4" class="Emp_NmAr4 col-sm-6 col-md-2 datepicker input_text" type="text" >
                                        </div>
                                        <!-- بيانات الجواز -->
                                        <div class="col-md-9">
                                            <label class="col-md-2" style="padding:0px;">{{trans('hr.Passport_data')}}</label>
                                            <input name="Emp_NmAr1" class="Emp_NmAr1 col-sm-6 col-md-2 input_text mr-lr-2" type="text">
                                            <input name="Emp_NmAr2" class="Emp_NmAr2 col-sm-6 col-md-2 input_text mr-lr-2" type="text" >
                                            <input name="Emp_NmAr3" class="Emp_NmAr3 col-sm-6 col-md-2 datepicker input_text mr-lr-2" type="text" >
                                            <input name="Emp_NmAr4" class="Emp_NmAr4 col-sm-6 col-md-2 datepicker input_text" type="text" >
                                        </div>
                                    </div>
                                    <!-- اسم الكفيل السابق -->
                                    <div class="row" style="margin-top: 15px;">
                                        <div class="col-md-9">
                                            <label class="col-md-2" style="padding:0px;">{{trans('hr.Trnsfer_OLdNm')}}</label>
                                            <input class="col-md-7 input_text" type="text" name="">
                                        </div>
                                    </div>

                                    <div class="panel panel-default" style="margin-top: 20px;">
                                        <div class="panel-body" style="background-color: darkseagreen;color: #fff;">
                                            <div class="row">
                                                <!-- تاشيرة القدوم -->
                                                <div class="col-md-4">
                                                    <div class="col-md-12">
                                                        <label class="col-md-6" style="padding:0px;">{{trans('hr.In_Job')}}</label>
                                                        <select class="col-md-6 mb-5 input_text" name="">
                                                            <option disabled selected>{{trans('admin.select')}}</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label class="col-md-6" style="padding:0px;">{{trans('hr.In_VisaNo')}}</label>
                                                        <input class="col-md-6 mb-5 input_text datepicker" type="text">
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label class="col-md-6" style="padding:0px;">{{trans('hr.In_VisaDt')}}</label>
                                                        <input class="col-md-6 mb-5 input_text" type="text">
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label class="col-md-6" style="padding:0px;">{{trans('hr.In_Port')}}</label>
                                                        <select class="col-md-6 mb-5 input_text" name="">
                                                            <option disabled selected>{{trans('admin.select')}}</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label class="col-md-6" style="padding:0px;">{{trans('hr.in_no')}}</label>
                                                        <input class="col-md-6 mb-5 input_text" type="text">
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label class="col-md-6" style="padding:0px;">{{trans('hr.in_date')}}</label>
                                                        <input class="col-md-6 input_text datepicker" type="text">
                                                    </div>
                                                </div>
                                                <!-- تاشيرة المغادره -->
                                                <div class="col-md-4">
                                                    <div class="col-md-12">
                                                        <label class="col-md-6" style="padding:0px;">{{trans('hr.Out_VisaNo')}}</label>
                                                        <input class="col-md-6 input_text mb-5" type="text">
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label class="col-md-6" style="padding:0px;">{{trans('hr.Out_VisaDt')}}</label>
                                                        <input class="col-md-6 input_text mb-5 datepicker" type="text">
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label class="col-md-6" style="padding:0px;">{{trans('hr.Out_Date')}}</label>
                                                        <input class="col-md-6 input_text mb-5 datepicker" type="text">
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label class="col-md-6" style="padding:0px;">{{trans('hr.Out_Port')}}</label>
                                                        <select class="col-md-6 input_text mb-5" name="">
                                                            <option disabled selected>{{trans('admin.select')}}</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label class="col-md-6" style="padding:0px;">{{trans('hr.bail_transfer_date')}}</label>
                                                        <input class="col-md-6 input_text datepicker" type="text">
                                                    </div>
                                                </div>
                                                <!-- image -->
                                                <div class="col-md-4">
                                                    <input type="file" class="form-control">
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
