@extends('hr.index')
@section('title', trans('hr.create_new_com'))
@section('root_link', route('mainCompany.index'))
@section('root_name', trans('hr.com_fixed'))
@section('content')
    @can('create')
        @push('css')
            <style>
                .nav-tabs.nav-justified>.active>a, .nav-tabs.nav-justified>.active>a:focus, .nav-tabs.nav-justified>.active>a:hover{
                    border-top: 1px groove black;
                    background: #8e8e8e5c;
                    border-radius: 0;
                    font-weight: bold;
                }

                .input_number{
                    width: 100%;
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
            </style>
        @endpush
        @push('js')
            <script>
                $(document).ready(function () {

                    $('.select_com_td select').select2({
                        dir: "{{direction()}}",
                        width: "100%"
                    });

                    $('input[type=checkbox].all_com').each(function () {
                        if($(this).attr('checked') === 'checked'){
                            $(this).parent('td').next('td.select_com_td').children('.select2-container').css({
                                visibility: 'hidden'
                            });
                        }
                        $(this).click(function () {
                            if ($(this).is(':checked')) {
                                $(this).parent('td').next('td.select_com_td').children('.select2-container').css({
                                    visibility: 'hidden'
                                });
                                $(this).parent('td').next('td.select_com_td').children('select').val('null');

                            } else {
                                $(this).parent('td').next('td.select_com_td').children('.select2-container').css({
                                    visibility: 'visible'
                                })
                            }
                        })
                    });

                })
            </script>


        @endpush
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">{{trans('hr.create_new_com')}}</h3>
            </div>
            <div class="box-body">
                @include('hr.layouts.message')
                {{ Form::open(['method'=>'post', 'route' => 'mainCompany.store', 'files' => true]) }}
                <ul class="nav nav-tabs nav-justified" id="myTab1" role="tablist">
                    <li class="nav-item active">
                        <a class="nav-link active" id="home-tab1" data-toggle="tab" href="#basic_information" role="tab" aria-controls="home"
                           aria-selected="true">{{trans('hr.basic_information')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab1" data-toggle="tab" href="#emp_renew" role="tab" aria-controls="profile"
                           aria-selected="false">{{trans('hr.emp_renew')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab2" data-toggle="tab" href="#car_renew" role="tab" aria-controls="profile"
                           aria-selected="false">{{trans('hr.car_renew')}}</a>
                    </li>
                </ul>
                <br>
                {{--tap container--}}
                <div class="tab-content" id="myTabContent1">
                    {{--First tap--}}
                    <div class="tab-pane fade show active in" id="basic_information" role="tabpanel" aria-labelledby="home-tab">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="col-md-1">
                                    <div class="form-group">
                                        {{Form::text('Cmp_No', count(\App\Models\Hr\HRMainCmpnam::all()) != 0?\App\Models\Hr\HRMainCmpnam::orderBy('ID_No', 'DESC')->latest()->first()->Cmp_No+1:1,['class' => 'form-control Cmp_No', 'readonly'])}}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {{Form::text('Cmp_ShrtNm', '',['class' => 'form-control Cmp_NmEn', 'placeholder'=>trans('hr.com_shortcut_name')])}}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {{Form::text('Cmp_NmAr', '',['class' => 'form-control Cmp_NmAr', 'placeholder' => trans('hr.com_name_ar')])}}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {{Form::text('Cmp_NmAr2', '',['class' => 'form-control Cmp_NmAr', 'placeholder' => trans('hr.com_second_name_ar')])}}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {{Form::text('Cmp_NmEn', '',['class' => 'form-control Cmp_NmEn', 'placeholder'=>trans('hr.com_name_en')])}}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {{Form::text('Cmp_NmEn2', '',['class' => 'form-control Cmp_NmEn', 'placeholder'=>trans('hr.com_second_name_en')])}}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {{Form::email('Cmp_Email', '',['class' => 'form-control Cmp_Email', 'placeholder'=>trans('hr.email')])}}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {{Form::text('Cmp_AddAr', '',['class' => 'form-control Cmp_AddAr', 'placeholder'=>trans('hr.com_address_ar')])}}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {{Form::text('Cmp_AddEn', '',['class' => 'form-control Cmp_AddEn', 'placeholder'=>trans('hr.com_address_en')])}}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {{Form::tel('Cmp_Tel', '',['class' => 'form-control Cmp_Tel', 'placeholder'=>trans('hr.com_phone')])}}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {{Form::tel('Cmp_Fax', '',['class' => 'form-control Cmp_Fax', 'placeholder'=>trans('hr.com_fax')])}}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {{Form::file('Picture',['class' => 'form-control Picture', 'placeholder'=>trans('hr.com_logo')])}}
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        {{Form::text('CR_No', '', ['class' => 'form-control CR_No', 'placeholder'=>trans('hr.commercial_register_number')])}}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {{Form::text('CC_No', '', ['class' => 'form-control CC_No', 'placeholder'=>trans('hr.commercial_chamber_number')])}}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {{Form::text('License_No', '', ['class' => 'form-control License_No', 'placeholder'=>trans('hr.licence_number')])}}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {{Form::text('Tax_No', '', ['class' => 'form-control Tax_No', 'placeholder'=>trans('hr.tax_number')])}}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {{Form::number('TaxExtra_Prct', '', ['class' => 'form-control TaxExtra_Prct', 'placeholder'=>trans('hr.vat_rate')])}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {{Form::number('Start_Month', '',['class' => 'form-control Cmp_NmEn', 'placeholder'=>trans('hr.month_start')])}}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {{Form::number('Start_Year', '',['class' => 'form-control Cmp_NmAr', 'placeholder' => trans('hr.year_start')])}}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {{Form::number('End_Month', '',['class' => 'form-control Cmp_NmAr', 'placeholder' => trans('hr.month_end')])}}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {{Form::number('End_year', '',['class' => 'form-control Cmp_NmEn', 'placeholder'=>trans('hr.year_end')])}}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {{Form::number('Start_MonthHij', '',['class' => 'form-control Cmp_NmEn', 'placeholder'=>trans('hr.month_start_ar')])}}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {{Form::number('Start_YearHij', '',['class' => 'form-control Cmp_Email', 'placeholder'=>trans('hr.year_start_ar')])}}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {{Form::number('End_MonthHij', '',['class' => 'form-control Cmp_AddAr', 'placeholder'=>trans('hr.month_end_ar')])}}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {{Form::number('End_yearHij', '',['class' => 'form-control Cmp_AddEn', 'placeholder'=>trans('hr.year_end_ar')])}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <ul class="nav nav-tabs nav-justified" id="myTab2" role="tablist">
                                    <li class="nav-item active">
                                        <a class="nav-link active" id="home-tab2" data-toggle="tab" href="#vacation_and_salary" role="tab" aria-controls="home"
                                           aria-selected="true">{{trans('hr.vacation_and_salary')}}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="profile-tab3" data-toggle="tab" href="#emp_affairs" role="tab" aria-controls="profile"
                                           aria-selected="false">{{trans('hr.emp_affairs')}}</a>
                                    </li>
                                </ul>
                                <br>
                                {{--tap container--}}
                                <div class="tab-content" id="myTabContent2">
                                    {{--First tap--}}
                                    <div class="tab-pane fade show active in" id="vacation_and_salary" role="tabpanel" aria-labelledby="home-tab">
                                        <div class="panel panel-primary">
                                            <div class="panel-heading">
                                                <div class="panel-title">
                                                    <p>{{trans('hr.salary_calc_depending_on')}}</p>
                                                </div>
                                            </div>
                                            <div class="panel-body">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        {{Form::label('HldIssue_Depend', trans('hr.date_of_hiring'))}}
                                                        <input class="radio-inline" id="HldIssue_Depend" type="radio" value="1" name="HldIssue_Depend">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        {{Form::label('last_date_vacation_return', trans('hr.last_date_vacation_return'))}}
                                                        <input class="radio-inline" id="last_date_vacation_return" type="radio" value="2" name="HldIssue_Depend">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                {{Form::label('Hldestm_Depend', trans('hr.depending_on_vacation_chart'))}}
                                                <input class="checkbox-inline" id="Hldestm_Depend" type="checkbox" value="1" name="Hldestm_Depend">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input class="form-control" type="number" min="1" name="NofDay_SalryMnth" placeholder="{{trans('hr.number_of_days_for_salary')}}">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input class="form-control" type="number" min="1" name="NofDay_PationHldy" placeholder="{{trans('hr.number_of_days_for_patient')}}">
                                            </div>
                                        </div>
                                    </div>
                                    {{--Second tap--}}
                                    <div class="tab-pane fade" id="emp_affairs" role="tabpanel" aria-labelledby="profile-tab">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input class="checkbox-inline" id="Emp_App" type="checkbox" value="1" name="Emp_App">
                                                {{Form::label('Emp_App', trans('hr.depending_on_emp_steps_app'))}}
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input class="checkbox-inline" id="Nation_Effect" type="checkbox" value="1" name="Nation_Effect">
                                                {{Form::label('Nation_Effect', trans('hr.saudi_emp_gulf_and_without_nationality'))}}
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input class="checkbox-inline" id="Dep_Budge" type="checkbox" value="1" name="Dep_Budge">
                                                {{Form::label('Dep_Budge', trans('hr.depending_on_evaluative_balance_for_emp'))}}
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input class="checkbox-inline" id="Job_Under" type="checkbox" value="1" name="Job_Under">
                                                {{Form::label('Job_Under', trans('hr.can_show_emp_count_have_same_job'))}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--Second tap--}}
                    @php
                        $empColumnArray = [
                            'Allw_RenewResidnc' => [
                                'days' => 'NofDys_RenewResidnc',
                                'all_com' => 'AllCmp_RenewResidnc',
                                'special_com' => 'CmpNo_RenewResidnc',
                                'label' => 'id_renew_before'
                            ],
                            'Allw_RenewPassport' => [
                                'days' => 'NofDys_RenewPassport',
                                'all_com' => 'AllCmp_RenewPassport',
                                'special_com' => 'CmpNo_RenewPassport',
                                'label' => 'passport_renew_before'
                            ],
                            'Allw_RenewDrivLicns' => [
                                'days' => 'NofDys_RenewDrivLicns',
                                'all_com' => 'AllCmp_RenewDrivLicns',
                                'special_com' => 'CmpNo_RenewDrivLicns',
                                'label' => 'drive_license_renew_before'
                            ],
                            'Allw_ReneWorkPermit' => [
                                'days' => 'NofDys_ReneWorkPermit',
                                'all_com' => 'AllCmp_ReneWorkPermit',
                                'special_com' => 'CmpNo_ReneWorkPermit',
                                'label' => 'work_permission_renew_before'
                            ]
                        ];
                    @endphp
                    <div class="tab-pane fade" id="emp_renew" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="col-md-12">
                            <div class="form-group">
                                <table class="table table-bordered table-responsive ">
                                    <thead>
                                    <tr>
                                        <th>{{trans('hr.renew_type')}}</th>
                                        <th class="col-md-2">{{trans('hr.day')}}</th>
                                        <th>{{trans('hr.all_com')}}</th>
                                        <th class="select_com_th">{{trans('hr.com_name')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($empColumnArray as $columnName => $values)
                                            <tr>
                                                <td>
                                                    <input type="checkbox" name="{{$columnName}}" value="1" id="{{$columnName}}" class="checkbox-inline {{$columnName}}">
                                                    <label for="{{$columnName}}">{{trans('hr.'.$values['label'].'')}}</label>
                                                </td>
                                                <td>
                                                    <input type="number" name="{{$values['days']}}" class="input_number">
                                                </td>
                                                <td class="soso">
                                                    <input type="checkbox" id="{{$values['all_com']}}" value="1" class="checkbox-inline all_com" name="{{$values['all_com']}}" checked>
                                                    <label for="{{$values['all_com']}}">{{trans('hr.all_com')}}</label>
                                                </td>
                                                <td class="select_com_td">
                                                    <select name="{{$values['special_com']}}" class="form-control select2">
                                                        <option value="">{{trans('hr.com_name')}}</option>
                                                        @foreach($mainCompanies as $mainCompany)
                                                            <option value="{{$mainCompany->ID_NO}}">{{$mainCompany->{'Cmp_Nm'.ucfirst(session('lang'))} }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    {{--third tap--}}
                    @php
                        $carColumnArray = [
                            'Allw_RenewCarlicense' => [
                                'days' => 'NofDys_RenewCarlicense',
                                'all_com' => 'AllCmp_RenewCarlicense',
                                'special_com' => 'CmpNo_RenewCarlicense',
                                'label' => 'car_license_renew_before'
                            ],
                            'Allw_RenewCarInsurance' => [
                                'days' => 'NofDys_RenewCarInsurance',
                                'all_com' => 'AllCmp_RenewCarInsurance',
                                'special_com' => 'CmpNo_RenewCarInsurance',
                                'label' => 'car_insurance_renew_before'
                            ]
                        ];
                    @endphp
                    <div class="tab-pane fade" id="car_renew" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="col-md-12">
                            <div class="form-group">
                                <table class="table table-bordered table-responsive ">
                                    <thead>
                                    <tr>
                                        <th>{{trans('hr.renew_type')}}</th>
                                        <th class="col-md-2">{{trans('hr.day')}}</th>
                                        <th>{{trans('hr.all_com')}}</th>
                                        <th class="select_com_th">{{trans('hr.com_name')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($carColumnArray as $columnName => $values)
                                        <tr>
                                            <td>
                                                <input type="checkbox" name="{{$columnName}}" value="1" id="{{$columnName}}" class="checkbox-inline {{$columnName}}">
                                                <label for="{{$columnName}}">{{trans('hr.'.$values['label'].'')}}</label>
                                            </td>
                                            <td>
                                                <input type="number" name="{{$values['days']}}" class="input_number">
                                            </td>
                                            <td>
                                                <input type="checkbox" id="{{$values['all_com']}}" value="1" class="checkbox-inline all_com" name="{{$values['all_com']}}" checked>
                                                <label for="{{$values['all_com']}}">{{trans('hr.all_com')}}</label>
                                            </td>
                                            <td class="select_com_td">
                                                <select name="{{$values['special_com']}}" class="form-control select2">
                                                    <option value="">{{trans('hr.com_name')}}</option>
                                                    @foreach($mainCompanies as $mainCompany)
                                                        <option value="{{$mainCompany->ID_NO}}">{{$mainCompany->{'Cmp_Nm'.ucfirst(session('lang'))} }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                {{Form::submit(trans('hr.save'), ['class'=>'btn btn-info btn-block'])}}
                {{Form::close()}}
            </div>
        </div>
    @endcan
@endsection
