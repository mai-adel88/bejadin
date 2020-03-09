@extends('admin.index')
@section('title',trans('admin.edit_employee'))
@section('content')
    @push('css')
        <style>
            .datepicker{direction: rtl;}
            .nav-pills > li.active > a, .nav-pills > li.active > a:hover, .nav-pills > li.active > a:focus{
                border-top-color: #538a9e;background-color: #538a9e;text-align: center;
            }
        </style>
    @endpush
    @push('js')
        <script>
            $(document).ready(function () {

                //get data مكان العمل
                // $.ajax({
                //         url: "{{route('getProjects')}}",
                //         type: 'get',
                //         data: {Cmp_No: $('#Cmp_No').children('option:selected').val(), Prj_No: {{ $hr->Prj_No }} },
                //         dataType: 'html',
                //         success: function (data) {
                //             $('#Prj_No').html(data);
                //         }
                // });

                
                //         $.ajax({
                //         url: "{{route('getProjectsChild')}}",
                //         type: 'get',
                //         data:{Prj_No: Prj_No},
                //         dataType: 'html',
                //         success: function (data) {  
                //             $('#PjLoc_No').html(data);
                //         }
                //     });
                
                //تاريخ بداية التعاقد
                $('input.Cnt_Stdt').change(function () {
                    let Hijri = $(this).val();
                    $.ajax({
                        url: "{{route('hijri')}}",
                        type: 'get',
                        data:{Hijri: Hijri} ,
                        dataType: 'json',
                        success: function (data) {
                            $('.Cnt_StdtHij').val(data);
                        }
                    });
                });
                //تاريخ نهاية التعاقد
                $('input.Cnt_Endt').change(function () {
                    let Hijri = $(this).val();
                    $.ajax({
                        url: "{{route('hijri')}}",
                        type: 'get',
                        data:{Hijri: Hijri} ,
                        dataType: 'json',
                        success: function (data) {
                            $('.Cnt_EndtHij').val(data);
                        }
                    })
                });
                //تاريخ تجديد التعاقد
                $('input.Cnt_Nwdt').change(function () {
                    let Hijri = $(this).val();
                    $.ajax({
                        url: "{{route('hijri')}}",
                        type: 'get',
                        data:{Hijri: Hijri} ,
                        dataType: 'json',
                        success: function (data) {
                            $('.Cnt_NwdtHij').val(data);
                        }
                    })
                });

                //حساب اجمالي الراتب
                $(document).on('keyup', '#Bsc_Salary ,#Add_Alw, #Hous_Alw,#Wrk_Hour, #Trnsp_Alw, #Food_Alw, #ALw2, #ALw1, #ALw4, #ALw3, #Other_Alw, #ALw5', function() {
                    var Bsc_Salary  = $('#Bsc_Salary').val();
                    var Add_Alw     = $('#Add_Alw').val();
                    var Hous_Alw    = $('#Hous_Alw').val();
                    var Trnsp_Alw   = $('#Trnsp_Alw').val();
                    var Food_Alw    = $('#Food_Alw').val();
                    var ALw2        = $('#ALw2').val();
                    var ALw1        = $('#ALw1').val();
                    var ALw4        = $('#ALw4').val();
                    var ALw3        = $('#ALw3').val();
                    var Other_Alw   = $('#Other_Alw').val();
                    var ALw5        = $('#ALw5').val();

                    var Total = (Number(Bsc_Salary) + Number(Add_Alw)+ Number(Hous_Alw)+ Number(Trnsp_Alw)
                        + Number(Food_Alw)+ Number(ALw2)+ Number(ALw1)+ Number(ALw4)+ Number(ALw3)+ Number(Other_Alw)+ Number(ALw5));
                    $('#Gross_Salary').val(Total);


                });

                //حساب تكلفة الساعه
                $(document).on('change', '#Bsc_Salary, #Wrk_Hour', function () {
                    var Wrk_Hour    = $('#Wrk_Hour').val(); //عدد ساعات العمل
                    var Bsc_Salary  = $('#Bsc_Salary').val();
                    if(Wrk_Hour != 0){
                        var hourly_cost =( ((Number(Bsc_Salary) / 30)) / Number(Wrk_Hour) );

                        $('#Wrk_CostHour').val(hourly_cost.toFixed(2));
                    }
                });
                //حساب الراتب بالبونص
                $(document).on('change', '#Bouns_Prct', function () {
                    var Bouns = $(this).val();
                    var Bsc_Salary  = $('#Bsc_Salary').val();
                    var percentage = Number(Bsc_Salary)*(Number(Bouns) /100);
                    var res = Number(percentage) + Number(Bsc_Salary);

                    $('#Gross_Salary').val(res);
                });
                //مكان العمل تبع الشركه
                $('#Cmp_No').change(function(){
                    var Cmp_No = $('#Cmp_No').val();
                    $.ajax({
                        url: "{{route('getProjects')}}",
                        type: 'get',
                        data:{Cmp_No: Cmp_No},
                        dataType: 'html',
                        success: function (data) {
                            $('#Prj_No').html(data);
                        }
                    });
                });

                //المكان الفرعي تبع مكان العمل (المشروع )
                $(document).on('change' ,'#Prj_No' ,function(){
                    var Prj_No = $('#Prj_No').val();
                    if(Prj_No !== ''){
                        $.ajax({
                        url: "{{route('getProjectsChild')}}",
                        type: 'get',
                        data:{Prj_No: Prj_No},
                        dataType: 'html',
                        success: function (data) {  
                            $('#PjLoc_No').html(data);
                        }
                    });
                    }
                });
            });
        </script>
    @endpush
    @hasanyrole('writer|admin')
    @can('edit')
        <div class="box">
        {{Form::model($hr,['method'=>'PUT','route'=>['employees.update',$hr->ID_No],'class'=>'form-group','files'=>true])}}
        {{Form::submit(trans('admin.edit'),['class'=>'btn', 'style'=>'background-color: #538a9e;color:#fff;float:left;'])}}
        <!-- Nav tabs -->
            <ul class="nav nav-pills">
                <li role="presentation" style="width: 40%;" class="active"><a href="#main_data" aria-controls="home" role="tab" data-toggle="tab">{{trans('admin.main_data')}}</a></li>
                <li role="presentation" style="width: 50%;"><a href="#responsible_persons" aria-controls="profile" role="tab" data-toggle="tab">{{trans('admin.transs')}}</a></li>
            </ul>
            <div class="tab-content">
                {{--البيانات الاساسيه--}}

                <div class="tab-pane active" id="main_data">
                    @include('admin.layouts.message')
                    <div class="box-header">
                        <h3 class="box-title">{{$title}}</h3>
                    </div>
                    <div class="box-body">
                        <div class="col-md-9" style="border: 1px solid #ccc;">
                            <div class="row form-group" style="margin-top: 10px;">
                                <div class="col-md-6">
                                    <label class="col-md-2">{{trans('admin.company')}}</label>
                                    <select name="Cmp_No" id="Cmp_No" class="col-md-9 form-control">
                                        @foreach($companies as $company)
                                            <option @if($hr->Cmp_No == $company->Cmp_No) selected @endif value="{{$company->Cmp_No}}">{{$company->{'Cmp_Nm'.ucfirst(session('lang'))} }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="col-md-5">{{trans('admin.emp_class')}}</label>
                                    {{ Form::select('Emp_Type',\App\Enums\CompanyEmployeeClass::toSelectArray() ,null,
                                    array_merge(['class' => 'form-control col-md-7','placeholder'=>trans('admin.select')])) }}
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-6">
                                    <label class="col-md-2">{{trans('admin.dep')}}</label>
                                    <select name="SubCmp_No" class="form-control col-md-9">
                                        <option>{{trans('admin.select')}}</option>
                                        @foreach($depmCmp as $depm)
                                            <option @if($hr->SubCmp_No == $depm->Depm_Main) selected @endif value="{{$depm->Depm_Main}}">{{$depm->{'Depm_Nm'.ucfirst(session('lang'))} }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="col-md-5">{{trans('admin.dep_no')}}</label>
                                    <input value="{{$hr->Emp_SubNo}}" name="Emp_SubNo" class="form-control col-md-7" type="text">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9" style="margin-top: 10px;">
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="col-md-4">{{trans('admin.numberr')}}</label>
                                        <input value="{{$hr->Emp_No}}" name="Emp_No" readonly type="text" class="col-md-8 form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="col-md-4">{{trans('admin.nationality')}}</label>
                                        {{ Form::select('Cntry_No',\App\Enums\Nationalities::toSelectArray() ,null,
                                        array_merge(['class' => 'form-control col-md-8','placeholder'=>trans('admin.select')])) }}
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <label class="col-md-2">{{trans('admin.subscriber_name_ar')}}</label>
                                    <input value="{{$hr->Emp_NmAr}}" name="Emp_NmAr" value="{{$hr->Emp_NmAr}}" type="text" class="col-md-10 form-control">
                                </div>
                                <br>
                                <div class="row">
                                    <label class="col-md-2">{{trans('admin.subscriber_name_en')}}</label>
                                    <input value="{{$hr->Emp_NmEn}}" name="Emp_NmEn" value="{{$hr->Emp_NmEn}}" type="text" class="col-md-10 form-control">
                                </div>
                                <br>
                                <div class="row">
                                    <label class="col-md-3">{{trans('admin.work_place')}}</label>
                                    <select name="Prj_No" id="Prj_No" class="col-md-9 Prj_No form-control">
                                        <option  value="{{null}}"></option>
                                    </select>
                                </div>
                                <br>
                                <div class="row">
                                    <label class="col-md-3">{{trans('admin.PjLoc_No')}}</label>
                                    <select name="PjLoc_No" id="PjLoc_No" class="col-md-9 form-control">
                                        <option value={{$hr->PjLoc_No}}>{{trans('admin.select')}}</option>
                                    </select>
                                </div> <br>
                                <div class="row">
                                    <label class="col-md-3">{{trans('admin.Acc_NoDb1')}}</label>
                                    <select name="Acc_NoDb1" class="col-md-9 form-control">
                                        <option>{{trans('admin.select')}}</option>
                                        @foreach($accounts as $account)
                                            <option @if($hr->Acc_NoDb1 == $account->Acc_No) selected @endif value="{{$account->Acc_No}}">{{$account->{'Acc_Nm'.ucfirst(session('lang'))} }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row form-group" style="margin-right: 69px;">
                                    @foreach(\App\Enums\GenderType::toSelectArray() as $key => $value)
                                        <input class="checkbox-inline" type="radio"
                                               name="Gender" value="{{$key}}"
                                               style="margin: 3px;" @if($hr->Gender == $key) checked @endif>
                                        <label>{{$value}}</label>
                                    @endforeach
                                </div>
                                <div class="row form-group" style="margin-right: 69px;">
                                    @foreach(\App\Enums\SpecialNeeds::toSelectArray() as $key => $value)
                                        <input class="checkbox-inline" type="radio"
                                               name="Specl_Need" value="{{$key}}"
                                               style="margin: 3px;" @if($hr->Specl_Need == $key) checked @endif>
                                        <label>{{$value}}</label>
                                    @endforeach
                                </div>
                                <div class="row">
                                    <label class="col-md-4">{{trans('admin.administration')}}</label>
                                    <select name="Depm_No" class="col-md-8 form-control">
                                        <option>{{trans('admin.select')}}</option>
                                        @foreach($dep as $deps)
                                            <option @if($hr->Depm_No == $deps->Class_No) selected @endif value="{{$deps->Class_No}}">{{$deps->{'Class_Nm'.ucfirst(session('lang'))} }}</option>
                                        @endforeach
                                    </select>
                                </div> <br>
                                <div class="row">
                                    <label class="col-md-4">{{trans('admin.job')}}</label>
                                    <select name="Job_No" class="col-md-8 form-control">
                                        <option>{{trans('admin.select')}}</option>
                                        @foreach($pyjobs as $pyjob)
                                            <option @if($hr->Job_No == $pyjob->Job_No) selected @endif value="{{$pyjob->Job_No}}">{{$pyjob->{'Job_Nm'.ucfirst(session('lang'))} }}</option>
                                        @endforeach
                                    </select>
                                </div> <br>
                                <div class="row">
                                    <label class="col-md-4">{{trans('admin.job_status')}}</label>
                                    {{ Form::select('Job_Stu',\App\Enums\JobStatus::toSelectArray() ,null,
                                    array_merge(['class' => 'form-control col-md-8','placeholder'=>trans('admin.select')])) }}
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="col-md-12">
                            <div class="row" style="background-color: #538a9e;color: #fff;margin-top: 10px;">
                                <div class="col-md-2" style="margin-top: 10px;">
                                    <label class="col-md-5">{{trans('admin.duration_contract')}}</label>
                                    <input value="{{$hr->Cnt_Period}}" style="padding-left: 0px;" name="Cnt_Period" type="text" class="col-md-7 form-control" placeholder="{{'المده/سنه'}}">
                                </div>
                                <div class="col-md-3" style="margin-top: 10px;">
                                    <label class="col-md-5">{{trans('admin.Huspym_No')}}</label>
                                    {{ Form::select('Pymnt_No',\App\Enums\HrHousePaymentType::toSelectArray() ,null,
                                     array_merge(['class' => 'form-control col-md-7','placeholder'=>trans('admin.select')])) }}
                                </div>
                                <div class="col-md-2" style="margin-top: 10px;">
                                    <label class="col-md-5">{{trans('admin.work_type')}}</label>
                                    {{ Form::select('Shift_Type',\App\Enums\ShiftTypes::toSelectArray() ,null,
                                    array_merge(['class' => 'form-control col-md-7'])) }}
                                </div>
                                <div class="col-md-2" style="margin-top: 10px;">
                                    <label class="col-md-5">{{trans('admin.Salary_Class_No')}}</label>
                                    {{ Form::select('Salary_Class_No',\App\Enums\SalaryClassNo::toSelectArray() ,null,
                                    array_merge(['class' => 'form-control col-md-7'])) }}
                                </div>
                                <div class="col-md-3" style="margin-top: 10px;">
                                    <label class="col-md-6">{{trans('admin.payment_methods')}}</label>
                                    {{ Form::select('Pymnt_No',\App\Enums\SalaryPaymentWay::toSelectArray() ,null,
                                    array_merge(['class' => 'form-control col-md-6'])) }}
                                </div>
                            </div>
                            <div class="row" style="margin-top: 10px;">
                                <div class="col-md-3">
                                    <div class="row">
                                        <label class="col-md-5">{{trans('admin.basic_salary')}}</label>
                                        <input value="{{$hr->Bsc_Salary}}" class="col-md-5 form-control" id="Bsc_Salary" type="text" name="Bsc_Salary">
                                    </div> <br>
                                    <div class="row">
                                        <label class="col-md-5">{{trans('admin.Add_Alw')}}</label>
                                        <input value="{{$hr->Add_Alw}}" class="col-md-5 form-control" id="Add_Alw" type="text" name="Add_Alw">
                                    </div> <br>
                                    <div class="row">
                                        <label class="col-md-5">{{trans('admin.Hous_Alw')}}</label>
                                        <input value="{{$hr->Hous_Alw}}" class="col-md-5 form-control" id="Hous_Alw" type="text" name="Hous_Alw">
                                    </div> <br>
                                    <div class="row">
                                        <label class="col-md-5">{{trans('admin.ALw1')}}</label>
                                        <input value="{{$hr->ALw1}}" class="col-md-5  form-control" type="text" id="ALw1" name="ALw1">
                                    </div> <br>
                                    <div class="row">
                                        <label class="col-md-5">{{trans('admin.Trnsp_Alw')}}</label>
                                        <input value="{{$hr->Trnsp_Alw}}" class="col-md-5 form-control" id="Trnsp_Alw" type="text" name="Trnsp_Alw">
                                    </div> <br>
                                    <div class="row">
                                        <label class="col-md-5">{{trans('admin.Food_Alw')}}</label>
                                        <input value="{{$hr->Food_Alw}}" class="col-md-5 form-control" id="Food_Alw" type="text" name="Food_Alw">
                                    </div> <br>
                                    <div class="row">
                                        <label class="col-md-5">{{trans('admin.ALw2')}}</label>
                                        <input value="{{$hr->ALw2}}" class="col-md-5 form-control" id="ALw2" type="text" name="ALw2">
                                    </div> <br>
                                    <div class="row">
                                        <label class="col-md-5">{{trans('admin.ALw4')}}</label>
                                        <input value="{{$hr->ALw4}}" class="col-md-5 form-control" id="ALw4" type="text" name="ALw4">
                                    </div> <br>
                                    <div class="row">
                                        <label class="col-md-5">{{trans('admin.ALw3')}}</label>
                                        <input value="{{$hr->ALw3}}" class="col-md-5 form-control" id="ALw3" type="text" name="ALw3">
                                    </div> <br>
                                    <div class="row">
                                        <label class="col-md-5">{{trans('admin.Other_Alw')}}</label>
                                        <input value="{{$hr->Other_Alw}}" class="col-md-5 form-control" id="Other_Alw" type="text" name="Other_Alw">
                                    </div> <br>
                                    <div class="row">
                                        <label class="col-md-5">{{trans('admin.ALw5')}}</label>
                                        <input value="{{$hr->ALw5}}" class="col-md-5 form-control" id="ALw5" type="text" name="ALw5">
                                    </div> <br>
                                    <div class="row">
                                        <label class="col-md-5">{{trans('admin.Gross_Salary')}}</label>
                                        <input value="{{$hr->Gross_Salary}}" class="col-md-6 form-control" id="Gross_Salary" readonly type="text" name="Gross_Salary">
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="col-md-3">
                                        <label class="col-md-4">{{trans('admin.OvrTime_HR3')}}</label>
                                        <input value="{{$hr->Wrk_Hour}}" type="text" name="Wrk_Hour" id="Wrk_Hour" class="col-md-4 form-control">
                                        <label class="col-md-3">{{trans('admin.hours')}}</label>
                                    </div>
                                    <div class="col-md-4">
                                        <input value="{{$hr->OvrTime_HR3}}" type="text" name="OvrTime_HR3" class="col-md-3 form-control">
                                        <label class="col-md-5">{{trans('admin.hours_week')}}</label>
                                    </div>
                                    <div class="col-md-5">
                                        <label class="col-md-10">{{trans('admin.Start_Paid')}}</label>
                                        <input value="{{$hr->Start_Paid}}" type="text" name="Start_Paid" class="col-md-2 form-control">
                                    </div>
                                </div>
                                <div class="col-md-9" style="margin-top: 15px;">
                                    <div class="col-md-3">
                                        <label class="col-md-4">{{trans('admin.OvrTime_HR3')}}</label>
                                        <input value="{{$hr->OvrTime_HR1}}" type="text" name="OvrTime_HR1" class="col-md-4 form-control">
                                        <label class="col-md-3">{{trans('admin.hours')}}</label>
                                    </div>
                                    <div class="col-md-4">
                                        <input value="{{$hr->OvrTime_HR2}}" type="text" name="OvrTime_HR2" class="col-md-3 form-control">
                                        <label class="col-md-5">{{trans('admin.hours_week')}}</label>
                                    </div>
                                    <div class="col-md-5">
                                        <label class="col-md-10">{{trans('admin.Start_UnPaid')}}</label>
                                        <input value="{{$hr->Start_UnPaid}}" type="text" name="Start_UnPaid" class="col-md-2 form-control">
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <br>
                                    <div class="col-md-5">
                                        <div class="row">
                                            <label class="col-md-5">{{trans('admin.HusTyp_No')}}</label>
                                            {{ Form::select('HusTyp_No',\App\Enums\Hr\HousingClassification::toSelectArray() ,null,
                                            array_merge(['class' => 'form-control col-md-5','placeholder'=>trans('admin.select')])) }}
                                        </div> <br>
                                        <div class="row">
                                            <label class="col-md-5">{{trans('admin.bonus')}}</label>
                                            <input value="{{$hr->Bouns_Prct}}" id="Bouns_Prct" type="text" name="Bouns_Prct" class="col-md-2 form-control" style="padding-right: 0px;">
                                        </div> <br>
                                        <div class="row">
                                            <label class="col-md-5">{{trans('admin.hour_r')}}</label>
                                            <input value="{{$hr->Wrk_CostHour}}" type="text" name="Wrk_CostHour" id="Wrk_CostHour" style="margin-left: 1px;padding:0px;" class="col-md-2 form-control" placeholder="ثابت">
                                            <input value="{{$hr->Total_Wrk_CostHour}}" type="text" name="Total_Wrk_CostHour" style="padding:0px;" class="col-md-3 form-control" placeholder="اجمالي">
                                        </div> <br>
                                        <div class="row">
                                            <label class="col-md-5">{{trans('admin.Dection_ExpireDt')}}</label>
                                            <input value="{{$hr->Dection_ExpireDt}}" type="text" name="Dection_ExpireDt" class="col-md-5 datepicker form-control">
                                        </div> <br> <br>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="row">
                                            <label class="col-md-3">{{trans('admin.Bnk_No')}}</label>
                                            <select name="Bnk_No" class="col-md-9 form-control">
                                            @foreach($banks as $bank)
                                                <option @if($hr->Bnk_No == $bank->Acc_No) selected @endif value="{{$bank->Acc_No}}">{{$bank->{'Acc_Nm'.ucfirst(session('lang'))} }}</option>
                                            @endforeach
                                            </select>
                                        </div> <br>
                                        <div class="row">
                                            <label class="col-md-3">{{trans('admin.Sub_Bnk')}}</label>
                                            <select name="Sub_Bnk" class="col-md-9 form-control">
                                            @foreach($banks as $bank)
                                                <option @if($hr->Bnk_No == $bank->Acc_No) selected @endif value="{{$bank->Acc_No}}">{{$bank->{'Acc_Nm'.ucfirst(session('lang'))} }}</option>
                                            @endforeach
                                            </select>
                                        </div> <br>
                                        <div class="row">
                                            <label class="col-md-3">{{trans('admin.Bnk_Acntno')}}</label>
                                            <input value="{{$hr->Bnk_Acntno}}" type="text" name="Bnk_Acntno" class="col-md-9 form-control">
                                        </div> <br>
                                        <div class="row">
                                            <label class="col-md-3">{{trans('admin.Tkt_No')}}</label>
                                            <input value="{{$hr->Tkt_No}}" type="text" name="Tkt_No" class="col-md-9 form-control">
                                        </div> <br>
                                        <div class="row">
                                            <label class="col-md-3">{{trans('admin.Tkt_No2')}}</label>
                                            <input value="{{$hr->Tkt_No2}}" type="text" name="Tkt_No2" class="col-md-3 form-control">
                                            <label class="col-md-2">{{trans('admin.Tkt_Class2')}}</label>
                                            <input value="{{$hr->Tkt_Class2}}" type="text" name="Tkt_Class2" class="col-md-4 form-control">
                                        </div>
                                        <div class="row well">
                                            <div class="row">
                                                <label class="col-md-3">{{trans('admin.Cnt_Stdt')}}</label>
                                                <input value="{{$hr->Cnt_Stdt}}" type="text" name="Cnt_Stdt" class="col-md-3 Cnt_Stdt form-control datepicker">
                                                <label class="col-md-2">{{trans('admin.Cnt_Stdt_Hi')}}</label>
                                                <input value="{{$hr->Cnt_StdtHij}}" type="text" name="Cnt_StdtHij" class="col-md-4 Cnt_StdtHij form-control">
                                            </div> <br>
                                            <div class="row">
                                                <label class="col-md-3">{{trans('admin.Cnt_Endt')}}</label>
                                                <input type="text" value="{{$hr->Cnt_Endt}}" name="Cnt_Endt" class="col-md-3 Cnt_Endt form-control datepicker">
                                                <label class="col-md-2">{{trans('admin.Cnt_Stdt_Hi')}}</label>
                                                <input value="{{$hr->Cnt_EndtHij}}" type="text" name="Cnt_EndtHij" class="col-md-4 Cnt_EndtHij form-control">
                                            </div> <br>
                                            <div class="row">
                                                <label class="col-md-3">{{trans('admin.Cnt_Nwdt')}}</label>
                                                <input value="{{$hr->Cnt_Nwdt}}" type="text" name="Cnt_Nwdt" class="col-md-3 Cnt_Nwdt form-control datepicker">
                                                <label class="col-md-2">{{trans('admin.Cnt_Stdt_Hi')}}</label>
                                                <input value="{{$hr->Cnt_Stdt_Hi}}" type="text" name="Cnt_NwdtHij" class="col-md-4 Cnt_NwdtHij form-control">
                                            </div>
                                        </div>
                                        <div class="row well" style="padding: 6px;">
                                            <div class="col-md-3">
                                                <input @if($hr->Wrk_OvrTime == 1)checked @endif value="{{$hr->Wrk_OvrTime}}" class="col-md-3" type="checkbox" name="Wrk_OvrTime">
                                                <label class="col-md-4">{{trans('admin.addition')}}</label>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="col-md-8">{{trans('admin.add_rate')}}</label>
                                                <input value="{{$hr->OvrTime_Rate}}" class="col-md-4 form-control" style="padding: 0px;" type="text" name="OvrTime_Rate">
                                            </div>
                                            <div class="col-md-5">
                                                <label class="col-md-9">{{trans('admin.Lunch_hour')}}</label>
                                                <input value="{{$hr->Lunch_hour}}"  style="padding: 0;" class="col-md-3 form-control" type="text" name="Lunch_hour">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{--الحركات--}}
                <div class="tab-pane" id="responsible_persons">
                    <div class="box-header">
                        <h3 class="box-title">{{trans('admin.transs')}}</h3>
                    </div>
                    <div class="box-body">
                        {{-- الحركات --}}
                        <div class="col-md-10">
                            <div class="col-md-6">
                                <label class="col-md-4">{{trans('admin.first_date_debtor')}}</label>
                                <input value="{{$hr->Fbal_Db}}" type="text" name="Fbal_Db" class="col-md-6 form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="col-md-4">{{trans('admin.first_date_debtor')}}</label>
                                <input value="{{$hr->Fbal_CR}}" type="text" name="Fbal_CR" class="col-md-6 form-control">
                            </div>
                            <br>
                            <br>
                            <br>
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th scope="col">الشهر</th>
                                    <th scope="col">الحركة مدين</th>
                                    <th scope="col">الحركة دائن</th>
                                    <th scope="col">الرصيد الحالى</th>
                                    <th scope="col"> رصيد تقديرى</th>
                                </tr>
                                </thead>
                                <tbody>

                                <tr>
                                    <th scope="row">يناير</th>
                                    <td>
                                        0.00
                                    </td>
                                    <td>
                                        0.00
                                    </td>
                                    <td>
                                        0
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">فبراير</th>
                                    <td>
                                        0.00
                                    </td>
                                    <td>
                                        0.00
                                    </td>
                                    <td>
                                        0
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">مارس</th>
                                    <td>
                                        0.00
                                    </td>
                                    <td>
                                        0.00
                                    </td>
                                    <td>
                                        0
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">ابريل</th>
                                    <td>
                                        0.00
                                    </td>
                                    <td>
                                        0.00
                                    </td>
                                    <td>
                                        0
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">مايو</th>
                                    <td>
                                        0.00
                                    </td>
                                    <td>
                                        0.00
                                    </td>
                                    <td>
                                        0
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">يونيو</th>
                                    <td>
                                        0.00
                                    </td>
                                    <td>
                                        0.00
                                    </td>
                                    <td>
                                        0
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">يوليو</th>
                                    <td>
                                        0.00
                                    </td>
                                    <td>
                                        0.00
                                    </td>
                                    <td>
                                        0
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">اغسطس</th>

                                    <td>
                                        0.0
                                    </td>
                                    <td>
                                        0.00
                                    </td>
                                    <td>
                                        0
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">سبتمبر</th>

                                    <td>
                                        0.00
                                    </td>
                                    <td>
                                        0.00
                                    </td>
                                    <td>
                                        0
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">أكتوبر</th>

                                    <td>
                                        0.00
                                    </td>
                                    <td>
                                        0.00
                                    </td>
                                    <td>
                                        0
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">نوفمبر</th>

                                    <td>
                                        0.00
                                    </td>
                                    <td>
                                        0.00
                                    </td>
                                    <td>
                                        0
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">ديسمبر</th>

                                    <td>
                                        0.00
                                    </td>
                                    <td>
                                        0.00
                                    </td>
                                    <td>
                                        0
                                    </td>
                                </tr>

                                <tr style="background-color: #d3d9df">
                                    <th scope="row">الإجمالى</th>

                                    <td>
                                        0
                                    </td>
                                    <td>
                                        0
                                    </td>
                                    <td>
                                        0
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        {{-- نهاية الحركات --}}
                    </div>
                </div>
                {!! Form::close() !!}

            </div>
        </div>
    @endcan
    @else
        <div class="alert alert-danger">{{trans('admin.you_cannt_see_invoice_because_you_dont_have_role_to_access')}}</div>

        @endhasanyrole

@endsection
