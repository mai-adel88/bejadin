@extends('hr.index')

@section('title', trans('hr.show_address'))
@section('root_link', route('address.index'))
@section('root_name', trans('hr.address'))

@section('content')
    @push('css')
        <style>
            .p-0{ padding:0px; }
            .mp-0{ padding:0px;margin:0; }
            .mt-15{ margin-top:15px; }
            .pt-3{ padding-top: 3px; }
            .color-red{ color:red; }
            .br-4{ border-radius: 4px;}
            /* fieldset */
            fieldset
            {
                border: 1px solid #ddd !important;
                margin: 0;
                min-width: 0;
                padding: 10px;
                position: relative;
                border-radius:4px;
                background-color:#f5f5f5;
                padding-left:10px!important;
            }

            legend
            {
                font-size:14px;
                font-weight:bold;
                margin-bottom: 0px;
                width: 100%;
                border: 1px solid #ddd;
                border-radius: 4px;
                padding: 5px 5px 5px 10px;
                background-color: #ffffff;
            }
        </style>
    @endpush
        
    <div class="box">
        <div class="box-header">
        </div>
        <div class="box-body"> 
            <div class="col-md-12 card text-white bg-info mb-3" style="margin-bottom: 15px;">
                <div class="card-header">
                    
                </div>
                <div class="card-body">
                    <div class="col-md-12 appendDiv" style="margin-bottom: 10px;margin-top:20px;">
                        <div class="form-group row">
                            <!-- الشركات -->
                            <div class="col-md-6">
                                <div class="col-md-12">
                                    <label class="col-md-3">{{trans('hr.company')}}</label>
                                    <div class="col-md-9 p-0">
                                    <div class="form-control">
                                        {{$emp_data->company->{'Cmp_Nm'.ucfirst(session('lang'))} }}
                                    </div>
                                    </div>
                                </div>
                            </div> <!-- end of first right row col-md-5 -->
                            <!-- الموظفين -->
                            <div class="col-md-6">
                                <div class="col-md-12">
                                    <label class="col-md-3">{{trans('hr.employee')}}</label>
                                    <div class="col-md-9 p-0">
                                        <div class="form-control">
                                            {{$emp_data->employee->{'Emp_Nm'.ucfirst(session('lang'))} }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end of form-group row row -->
                    </div> <!-- end of col-md-12-->
                </div>
            </div>
                <!-- second row -->
            <div class="form-group empAddressData">
                <div class="col-md-6">
                    <fieldset id="tableFilter">
                        <legend>داخل المملكة</legend>
                        <div class="row form-group">
                            <label class="col-md-2">اسم المدينة</label>
                            <div class="form-control col-md-4">
                                {{$emp_data->city->{'city_name_'.session('lang')} }}
                            </div>
                            <label class="col-md-2">المنطقه</label>
                            <div class="form-control col-md-3">
                                {{$emp_data->state->{'city_name_'.session('lang')} }}
                            </div>
                        </div>
                        <div class="row form-group">
                            <label class="col-md-2">هاتف</label>
                            <div class="form-control col-md-4">
                            {{$emp_data->Emp_Phon ? $emp_data->Emp_Phon : ''}}
                            </div>
                            <label class="col-md-2">الموبايل</label>
                            <div class="form-control col-md-3">
                            {{$emp_data->Emp_Mobile?$emp_data->Emp_Mobile:''}}
                            </div>
                        </div>
                        <div class="row form-group">
                            <label class="col-md-2 ">العنوان</label>
                            <div class="form-control col-md-9">
                            {{$emp_data->Emp_Street ? $emp_data->Emp_Street:''}}
                            </div>
                        </div>

                        <div class="row form-group">
                            <label class="col-md-2">شخص للرجوع اليه</label>
                            <div class="form-control col-md-9 form-group">
                            {{$emp_data->RefPerson_Nm ? $emp_data->RefPerson_Nm:''}}
                            </div>
                            <label class="col-md-2">هاتف</label>
                            <div class="form-control col-md-9">
                                {{$emp_data->RefPerson_Nm ? $emp_data->RefPerson_Mobile:''}}
                            </div>
                        </div>
                        <div class="row form-group">
                            <label class="col-md-2">الايميل</label>
                            <div class="form-control col-md-9">
                                {{$emp_data->E_Email ? $emp_data->E_Email:''}}
                            </div>
                        </div>
                    </fieldset>
                </div> <!-- end of col-md-6 داخل المملكة-->
                <div class="col-md-6">
                    <fieldset id="tableFilter">
                        <legend>خارج المملكة</legend>
                        <div class="row form-group">
                            <label class="col-md-2">الدولة</label>
                            <div class="form-control col-md-4">
                                {{$emp_data->country ? $emp_data->country->{'country_name_'.session('lang')} : '' }}
                            </div>
                        </div>
                        <div class="row form-group">
                            <label class="col-md-2">هاتف</label>
                            <div class="form-control col-md-4">
                                {{$emp_data->Phon_Cntry ? $emp_data->Phon_Cntry:''}}
                            </div>
                        </div>
                        <div class="row form-group">
                            <label class="col-md-2 ">العنوان</label>
                            <div class="form-control col-md-9 br-5">
                            {{$emp_data->Emp_Adrs ? $emp_data->Emp_Adrs:''}}
                            </div>
                        </div>
                        <div class="row form-group">
                            <label class="col-md-2 ">احد الاقارب</label>
                            <div class="form-control col-md-9 form-group">
                                {{$emp_data->Name_Nerst ? $emp_data->Name_Nerst:''}}
                            </div>
                            <label class="col-md-2">الهاتف</label>
                            <div class="form-control col-md-9">
                            {{$emp_data->Phon_nerst ? $emp_data->Phon_nerst:''}}
                            </div>
                        </div>
                        <div class="row form-group">
                            <label class="col-md-2 ">العنوان</label>
                            <div class="form-control col-md-9">
                            {{$emp_data->Adrs_Nerst ? $emp_data->Adrs_Nerst:''}}
                            </div>
                        </div>


                        <div class="row form-group">
                            <label class="col-md-2">ملاحظات</label>
                            <div class="form-control col-md-9">
                            {{$emp_data->Notes ? $emp_data->Notes:''}}
                            </div>
                        </div>
                    </fieldset>
                </div> <!-- end of col-md-6 خارج المملكة-->
            </div>
            <!-- end second row -->
        </div> {{--end of  box-body --}}
        <!-- last of day -->
    </div> {{--end of div box--}}
@endsection
