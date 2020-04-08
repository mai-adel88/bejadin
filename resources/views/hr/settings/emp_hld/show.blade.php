<div class="empData">
    <div class="panel panel-default">
        <div class="panel-body" style="background-color: #fff;color: #4d6672;">
            <div class="row" style="margin-top: 15px;">
                <div class="col-md-4">
                    <div class="col-md-12">
                        <label class="col-md-5" style="padding:0px;">{{trans('hr.month_share')}}</label>
                        <input type="text"  disabled id="month_share" class="col-md-6 month_share input_text form-control">
                    </div>
                    <div class="col-md-12">
                        <label class="col-md-5" style="padding:0px;">{{trans('hr.Open_Balnc')}}</label>
                        <input type="text"  disabled name="Open_Balnc" value="{{$emp_data->Open_Balnc?$emp_data->Open_Balnc:''}}" class="col-md-6 input_text form-control">
                    </div>
                    <div class="col-md-12">
                        <label class="col-md-5" style="padding:0px;">{{trans('hr.Pat_Hld')}}</label>
                        <input type="text"  disabled name="Pat_Hld" value="{{$emp_data->Pat_Hld?$emp_data->Pat_Hld:''}}" class="col-md-6 input_text form-control">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="col-md-12">
                        <label style="margin-bottom: 20px;">
                            <input type="checkbox" value="1" disabled name="Unpad_Nxtyer">{{trans('hr.Unpad_Nxtyer')}}
                        </label>
                    </div>
                    <div class="col-md-12">
                        <label class="col-md-6" style="padding:0px;">{{trans('hr.due_to_date')}}</label>
                        <input type="text" disabled id="due_to_date" class="col-md-6 input_text form-control">
                    </div>
                    <div class="col-md-12">
                        <label class="col-md-6" style="padding:0px;">{{trans('hr.Last_Ret_Dt')}}</label>
                        <input type="date" disabled name="Last__Ret_Dt" value="{{$emp_data->Last__Ret_Dt?$emp_data->Last__Ret_Dt:''}}" class="col-md-6 input_text form-control">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="col-md-12">
                        <label class="col-md-6" style="padding:0px;">{{trans('hr.date_of_hiring')}}</label>
                        <input type="date" disabled name="Start_Date" id="hiring_date" value="{{$data->Start_Date? $data->Start_Date:''}}" class="col-md-6 input_text form-control">
                    </div>
                    <div class="col-md-12">
                        <label class="col-md-6" style="padding:0px;">{{trans('hr.actual_days')}}</label>
                        <input type="text" disabled id="actual_days" class="col-md-6 input_text form-control">
                    </div>
                    <div class="col-md-12">
                        <label class="col-md-6" style="padding:0px;">{{trans('hr.Blnc_Paid')}}</label>
                        <input type="text"  disabled name="Blnc_Paid" value="{{$emp_data->Blnc_Paid?$emp_data->Blnc_Paid:''}}" class="col-md-6 input_text form-control">
                    </div>
                    <div class="col-md-12">
                        <label class="col-md-6" style="padding:0px;">{{trans('hr.Blnc_UnPaid')}}</label>
                        <input type="text"  disabled name="Blnc_UnPaid" value="{{$emp_data->Blnc_UnPaid?$emp_data->Blnc_UnPaid:''}}" class="col-md-6 input_text form-control">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body" style="background-color: #fff;color: #4d6672;">
            <ul class="nav nav-tabs nav-justified" id="myTab1" role="tablist">
                <li class="nav-item active">
                    <a class="nav-link" id="home-tab1" data-toggle="tab" href="#yearly" role="tab" aria-controls="home"
                    aria-selected="true">{{trans('hr.annual_increase')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="home-tab1" data-toggle="tab" href="#vacancies" role="tab" aria-controls="home"
                    aria-selected="true">{{trans('hr.last_vacation_data')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="home-tab1" data-toggle="tab" href="#basic_data" role="tab" aria-controls="home"
                    aria-selected="true">{{trans('hr.basic_data')}}</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent1">
                <!-- first tab -->
                <div class="tab-pane fade show active in" id="yearly" role="tabpanel" aria-labelledby="home-tab">
                    <div class="row">
                        <div class="col-md-2" style="margin-top:10px;">
                            <div class="col-md-12">
                                <input type="radio" value="1" checked id="first_Inc_Typ" disabled name="Inc_Typ" class="col-md-2 radio-inline">
                                <label class="col-md-10 pl-0 p-0">{{trans('hr.no_bonus')}}</label>
                            </div>
                            <div class="col-md-12">
                                <input type="radio" value="2" disabled name="Inc_Typ" class="col-md-2 radio-inline">
                                <label class="col-md-10 pl-0 p-0">{{trans('hr.fix_bonus')}}</label>
                            </div>
                            <div class="col-md-12">
                                <input type="radio" value="3" disabled name="Inc_Typ" class="col-md-2 radio-inline">
                                <label class="col-md-10 pl-0 p-0">{{trans('hr.ch_bonus')}}</label>
                            </div>
                        </div>
                        <div class="col-md-3" style="margin-top:10px;">
                            <div class="col-md-12">
                                <label class="col-md-7">{{trans('hr.bonus_year')}}</label>
                                <input type="number" min="1" disabled id="Inc_Yer" disabled name="Inc_Yer" value="{{$emp_data->Inc_Yer?$emp_data->Inc_Yer:''}}" class="col-md-5 input_text form-control">
                            </div>
                            <div class="col-md-12">
                                <label class="col-md-7">{{trans('hr.no_days')}}</label>
                                <input type="number" min="1" disabled id="Inc_days" disabled name="Inc_days" value="{{$emp_data->Inc_days?$emp_data->Inc_days:''}}" class="col-md-5 input_text form-control">
                            </div>
                        </div>
                        <div class="col-md-7">
                            <table style="border-spacing: 5px;">
                                <tr>
                                    <th>{{trans('hr.work_year')}}</th>
                                    <th>{{trans('hr.num_days')}}</th>
                                    <th>{{trans('hr.notes')}}</th>
                                </tr>
                                <tr>
                                    <td><input type="text"  disabled name="Work_Yer" value="{{$emp_pyemp->Work_Yer?$emp_pyemp->Work_Yer:''}}"></td>
                                    <td><input type="text"  disabled name="Increase_Days" value="{{$emp_pyemp->Increase_Days?$emp_pyemp->Increase_Days:''}}"></td>
                                    <td><input type="text"  disabled name="Notes" value="{{$emp_pyemp->Notes?$emp_pyemp->Notes:''}}"></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- second tab -->
                <div class="tab-pane fade" id="vacancies" role="tabpanel" aria-labelledby="home-tab">
                    <div class="row">
                        <div class="col-md-2" style="margin-top: 35px;">
                            <label style="padding:0px;">{{trans('hr.hld_year')}}</label>
                            <label style="padding:0px;margin-top: 10px;">{{trans('hr.Hld_No2')}}</label>
                            <label style="padding:0px;margin-top: 10px;">{{trans('hr.hld_emergency')}}</label>
                            <label style="padding:0px;margin-top: 10px;">{{trans('hr.Hld_No3')}}</label>
                            <label style="padding:0px;margin-top: 10px;">{{trans('hr.Hld_No5')}}</label>
                            <label style="padding:0px;margin-top: 10px;">{{trans('hr.Visainout')}}</label>
                        </div>
                        <div class="col-md-2" style="padding: 2px;">
                            <label>{{trans('hr.star_date')}}</label>
                            <input type="date" disabled name="Hld_Stdt1" value="{{$emp_data->Hld_Stdt1?$emp_data->Hld_Stdt1:''}}" class="Hld_Stdt1 input_text form-control">
                            <input type="date" disabled name="Hld_Stdt2" value="{{$emp_data->Hld_Stdt2?$emp_data->Hld_Stdt2:''}}" class="Hld_Stdt2 input_text form-control">
                            <input type="date" disabled name="Hld_Stdt4" value="{{$emp_data->Hld_Stdt4?$emp_data->Hld_Stdt4:''}}" class="Hld_Stdt3 input_text form-control">
                            <input type="date" disabled name="Hld_Stdt3" value="{{$emp_data->Hld_Stdt3?$emp_data->Hld_Stdt3:''}}" class="Hld_Stdt4 input_text form-control">
                            <input type="date" disabled name="Hld_Stdt5" value="{{$emp_data->Hld_Stdt5?$emp_data->Hld_Stdt5:''}}" class="Hld_Stdt5 input_text form-control">
                            <input type="date" disabled name="Visainout_ActDt" value="{{$emp_data->Visainout_ActDt?$emp_data->Visainout_ActDt:''}}" class="Visainout_ActDt input_text form-control">
                        </div>
                        <div class="col-md-2" style="padding: 2px;">
                            <label>{{trans('hr.finishing_d')}}</label>
                            <input type="date" disabled name="Hld_Endt1" value="{{$emp_data->Hld_Endt1?$emp_data->Hld_Endt1:''}}" class="input_text form-control">
                            <input type="date" disabled name="Hld_Endt2" value="{{$emp_data->Hld_Endt2?$emp_data->Hld_Endt2:''}}" class="input_text form-control">
                            <input type="date" disabled name="Hld_Endt4" value="{{$emp_data->Hld_Endt4?$emp_data->Hld_Endt4:''}}" class="input_text form-control">
                            <input type="date" disabled name="Hld_Endt3" value="{{$emp_data->Hld_Endt3?$emp_data->Hld_Endt3:''}}" class="input_text form-control">
                            <input type="date" disabled name="Hld_Endt5" value="{{$emp_data->Hld_Endt5?$emp_data->Hld_Endt5:''}}" class="input_text form-control">
                            <input type="date" disabled name="Visainout_ExtDt" value="{{$emp_data->Visainout_ExtDt?$emp_data->Visainout_ExtDt:''}}" class="Visainout_ExtDt input_text form-control">
                        </div>
                        <div class="col-md-2" style="padding: 2px;">
                            <label>{{trans('hr.Hld_Rtdt1')}}</label>
                            <input type="date" disabled name="Hld_Rtdt1" value="{{$emp_data->Hld_Rtdt1?$emp_data->Hld_Rtdt1:''}}" class="Hld_Rtdt1 input_text form-control">
                            <input type="date" disabled name="Hld_Rtdt2" value="{{$emp_data->Hld_Rtdt2?$emp_data->Hld_Rtdt2:''}}" class="Hld_Rtdt2 input_text form-control">
                            <input type="date" disabled name="Hld_Rtdt4" value="{{$emp_data->Hld_Rtdt4?$emp_data->Hld_Rtdt4:''}}" class="Hld_Rtdt3 input_text form-control">
                            <input type="date" disabled name="Hld_Rtdt3" value="{{$emp_data->Hld_Rtdt3?$emp_data->Hld_Rtdt3:''}}" class="Hld_Rtdt4 input_text form-control">
                            <input type="date" disabled name="Hld_Rtdt5" value="{{$emp_data->Hld_Endt1?$emp_data->Hld_Rtdt5:''}}" class="Hld_Rtdt5 input_text form-control">
                            <label class="col-md-12">{{trans('hr.visa')}}</label>
                        </div>
                        <div class="col-md-1" style="padding: 2px;">
                            <label>{{trans('hr.Hld_Prod1')}}</label>
                            <input type="text"  disabled name="Hld_Prod1" value="{{$emp_data->Hld_Prod1?$emp_data->Hld_Prod1:''}}" class="Hld_Prod1 input_text form-control">
                            <input type="text"  disabled name="Hld_Prod2" value="{{$emp_data->Hld_Prod2?$emp_data->Hld_Prod2:''}}" class="Hld_Prod2 input_text form-control">
                            <input type="text"  disabled name="Hld_Prod4" value="{{$emp_data->Hld_Prod4?$emp_data->Hld_Prod4:''}}" class="Hld_Prod3 input_text form-control">
                            <input type="text"  disabled name="Hld_Prod3" value="{{$emp_data->Hld_Prod3?$emp_data->Hld_Prod3:''}}" class="Hld_Prod4 input_text form-control">
                            <input type="text"  disabled name="Hld_Prod5" value="{{$emp_data->Hld_Prod5?$emp_data->Hld_Prod5:''}}" class="Hld_Prod5 input_text form-control">
                            <input type="text"  disabled name="Visainout_Period" value="{{$emp_data->Visainout_Period?$emp_data->Visainout_Period:''}}" class="input_text form-control" placeholder="مدة التأشيره">
                        </div>
                        <div class="col-md-2" style="padding: 2px;">
                            <label>{{trans('hr.Isu_Bln1')}}</label>
                            <input type="text"  disabled name="Isu_Bln1" value="{{$emp_data->Isu_Bln1?$emp_data->Isu_Bln1:''}}" class="input_text form-control">
                            <input type="text"  disabled name="Isu_Bln2" value="{{$emp_data->Isu_Bln2?$emp_data->Isu_Bln2:''}}" class="input_text form-control">
                            <input type="text"  disabled name="Isu_Bln4" value="{{$emp_data->Isu_Bln4?$emp_data->Isu_Bln4:''}}" class="input_text form-control">
                            <input type="text"  disabled name="Isu_Bln3" value="{{$emp_data->Isu_Bln3?$emp_data->Isu_Bln3:''}}" class="input_text form-control">
                            <input type="text"  disabled name="Isu_Bln5" value="{{$emp_data->Isu_Bln5?$emp_data->Isu_Bln5:''}}" class="input_text form-control">
                            <input type="text"  disabled name="Visainout_Type" value="{{$emp_data->Visainout_Type?$emp_data->Visainout_Type:''}}" class="input_text form-control" placeholder="نوع التأشيره">
                        </div>
                        <div class="col-md-1" style="padding: 2px;">
                            <label>{{trans('hr.Hld_No1')}}</label>
                            <input type="text"  disabled name="Hld_No1" value="{{$emp_data->Hld_No1?$emp_data->Hld_No1:''}}" class="input_text form-control">
                            <input type="text"  disabled name="Hld_No2" value="{{$emp_data->Hld_No2?$emp_data->Hld_No2:''}}" class="input_text form-control">
                            <input type="text"  disabled name="Hld_No4" value="{{$emp_data->Hld_No4?$emp_data->Hld_No4:''}}" class="input_text form-control">
                            <input type="text"  disabled name="Hld_No3" value="{{$emp_data->Hld_No3?$emp_data->Hld_No3:''}}" class="input_text form-control">
                            <input type="text"  disabled name="Hld_No5" value="{{$emp_data->Hld_No5?$emp_data->Hld_No5:''}}" class="input_text form-control">
                            <input type="text"  disabled name="Visainout_ID" value="{{$emp_data->Visainout_ID?$emp_data->Visainout_ID:''}}" class="input_text form-control" placeholder="رقم التأشيره">
                        </div>
                    </div>
                </div>
                <!-- third tab -->
                <div class="tab-pane fade" id="basic_data" role="tabpanel" aria-labelledby="home-tab">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-12" style="margin-top:5px; padding:0px;">
                                <div class="col-md-6">
                                    <label class="col-md-6" style="padding:0px;">{{trans('hr.vacations_merit_types')}}</label>
                                    <select disabled name="HLdy_Ty" id="HLdy_Ty" @if($data->HLdy_Ty != null )selected @endif class="col-md-6 input_text form-control" placeholder="{{trans('admin.select')}}">
                                        <option>{{trans('hr.select')}}</option>
                                        <option value="">حسب القانون</option>
                                        <option value="15">سنويه 15</option>
                                        <option value="30">سنويه 30</option>
                                        <option value="21">سنويه 21</option>
                                        <option value="45">سنويه 45</option>
                                        <option value="30">سنتين 30</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="col-md-6" style="padding:0px;">{{trans('hr.Hld_Ern_Prod')}}</label>
                                    <input type="text"  id="HLd_Period" disabled name="HLd_Period" value="{{$data->HLd_Period ?$data->HLd_Period:''}}" class="col-md-6 input_text form-control">
                                </div>
                                <div class="col-md-3">
                                    <label class="col-md-6" style="padding:0px;">{{trans('hr.duration_contract')}}</label>
                                    <input type="text"  disabled name="Cnt_Period" value="{{$data->Cnt_Period ?$data->Cnt_Period:''}}" class="col-md-6 input_text form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12" style="padding:0px;">
                                <div class="col-md-8">
                                    <label class="col-md-8" style="padding:0px;">{{trans('hr.DueDt_Hldy')}}</label>
                                    <input type="date" disabled name="DueDt_Hldy" value="{{$data->DueDt_Hldy ?$data->DueDt_Hldy:''}}" class="col-md-4 input_text form-control">
                                </div>
                                <div class="col-md-4">
                                    <label class="col-md-4" style="padding:0px;">{{trans('hr.Cnt_Stdt_Hi')}}</label>
                                    <input type="text"  disabled name="DueDt_HldyHij" value="{{$data->DueDt_HldyHij ?$data->DueDt_HldyHij:''}}" class="col-md-8 input_text form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12" style="padding:0px;">
                                <div class="col-md-8">
                                    <label class="col-md-8" style="padding:0px;">{{trans('hr.DueDt_Tkt')}}</label>
                                    <input type="date" disabled name="DueDt_Tkt" value="{{$data->DueDt_Tkt ?$data->DueDt_Tkt:''}}" class="col-md-4 input_text form-control">
                                </div>
                                <div class="col-md-4">
                                    <label class="col-md-4" style="padding:0px;">{{trans('hr.Cnt_Stdt_Hi')}}</label>
                                    <input type="text"  disabled name="DueDt_TktHij" value="{{$data->DueDt_TktHij ?$data->DueDt_TktHij:''}}" class="col-md-8 input_text form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-9">
                                <label class="col-md-7" style="padding:0px;"> {{trans('hr.Start_Paid')}} </label>
                                <input type="text"  disabled name="Start_Paid" value="{{$data->Start_Paid ?$data->Start_Paid:''}}" class="input_text col-md-2 form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-9">
                                <label class="col-md-7" style="padding:0px;"> {{trans('hr.Start_UnPaid')}}  </label>
                                <input type="text"  disabled name="Start_UnPaid" value="{{$data->Start_UnPaid ?$data->Start_UnPaid:''}}" class="input_text col-md-2 form-control ">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">

                        <div class="row">
                            <label class="col-md-1" style="padding:0px;"></label>
                            <label class="col-md-3" style="padding:0px;">وسيلة السفر</label>
                            <label class="col-md-2" style="padding:0px;">عدد التذاكر</label>
                            <label class="col-md-3" style="padding:0px;">الدرجة</label>
                            <label class="col-md-3" style="padding:0px;">اتجاة التذكرة</label>
                        </div>
                        <div class="row">
                            <label class="col-md-1 p-0">{{trans('hr.The_employee')}}</label>
                            <select disabled name="HldTrnsp_No" class="col-md-2 input_text form-control" placeholder="{{trans('hr.select')}}">
                            @foreach(\App\Enums\Hr\HrTransType::toSelectArray() as $key=>$value)
                                <option @if($data->HldTrnsp_No == $key) selected @endif value="{{$key}}">{{$value}}</option>
                            @endforeach
                            </select>

                            <!-- Tkt_No عدد التذاكر  -->
                            <div class="col-md-2">
                                <input type="number" disabled name="Tkt_No" value="{{$data->Tkt_No ?$data->Tkt_No:''}}" min="1" class="input_text">
                            </div>
                            <div class="col-md-3">
                                <input disabled name="Tkt_Class" disabled name="Tkt_Class" type="text"  value="{{$data->Tkt_Class ?$data->Tkt_Class:''}}" class="input_text">
                            </div>
                            <div class="col-md-4">
                                <input type="text"  disabled name="Tkt_Sector" value="{{$data->Tkt_Sector ?$data->Tkt_Sector:''}}" class="input_text">
                            </div>

                        </div>
                        <div class="row">
                            <label class="col-md-1 p-0">{{trans('hr.husband')}}</label>
                            <select disabled name="HldTrnsp_No1" class="col-md-2 input_text form-control" placeholder="{{trans('hr.select')}}">
                            @foreach(\App\Enums\Hr\HrTransType::toSelectArray() as $key=>$value)
                                <option @if($data->HldTrnsp_No1 == $key) selected @endif value="{{$key}}">{{$value}}</option>
                            @endforeach
                            </select>

                            <div class="col-md-2">
                                <input type="number" disabled name="Tkt_No1" value="{{$data->Tkt_No1 ?$data->Tkt_No1:''}}" min="1" class="input_text">
                            </div>
                            <div class="col-md-3">
                                <input type="text"  disabled name="Tkt_Class1" value="{{$data->Tkt_Class1 ?$data->Tkt_Class1:''}}" class="input_text">
                            </div>
                            <div class="col-md-4">
                                <input type="text"  disabled name="Tkt_Sector1" value="{{$data->Tkt_Sector1 ?$data->Tkt_Sector1:''}}" class="input_text">
                            </div>

                        </div>
                        <div class="row">
                            <label class="col-md-1 p-0">{{trans('hr.boys')}}</label>
                            <select disabled name="HldTrnsp_No2" class="col-md-2 input_text form-control" placeholder="{{trans('hr.select')}}">
                            @foreach(\App\Enums\Hr\HrTransType::toSelectArray() as $key=>$value)
                                <option @if($data->HldTrnsp_No2 == $key) selected @endif value="{{$key}}">{{$value}}</option>
                            @endforeach
                            </select>

                            <div class="col-md-2">
                                <input type="number" disabled name="Tkt_No2" value="{{$data->Tkt_No2 ?$data->Tkt_No2:''}}" min="1" class="input_text">
                            </div>
                            <div class="col-md-3">
                                <input type="text"  disabled name="Tkt_Class2" value="{{$data->Tkt_Class2 ?$data->Tkt_Class2:''}}" class="input_text">
                            </div>
                            <div class="col-md-4">
                                <input type="text"  disabled name="Tkt_Sector2" value="{{$data->Tkt_Sector2 ?$data->Tkt_Sector2:''}}" class="input_text">
                            </div>

                        </div>

                    </div> <!-- end of col-md-6 -->
                    <!-- بداية استحقاق التذكرة -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-2">
                                <fieldset id="tableFilter">
                                    <legend>وقت استحقاق التذاكر</legend>
                                    <!-- عند الاستقدام -->
                                    <div class="row">
                                        <input id="Tkt_Ty1" type="checkbox" @if($data->Tkt_Ty1 ==1) selected @endif value="{{$data->Tkt_Ty1}}" disabled name="Tkt_Ty1" class="Tkt_Ty1 col-md-2 radio-inline">
                                        <label for="Tkt_Ty1" class="col-md-10 p-0">{{ trans('admin.Tkt_Ty1') }}</label>
                                    </div>
                                    <!-- عند الاجازة السنوية -->
                                    <div class="row">
                                        <input id="Tkt_Ty2" type="checkbox" @if($data->Tkt_Ty2 ==1) selected @endif value="{{$data->Tkt_Ty2}}" disabled name="Tkt_Ty2" class="Tkt_Ty2 col-md-2 radio-inline">
                                        <label for="Tkt_Ty2" class="col-md-10 p-0 fs-13">{{ trans('admin.Tkt_Ty2') }}</label>
                                    </div>
                                    <!-- عند نهاية العقد -->
                                    <div class="row">
                                        <input id="Tkt_Ty3" type="checkbox" @if($data->Tkt_Ty3 ==1) selected @endif value="{{$data->Tkt_Ty3}}" disabled name="Tkt_Ty3" class="Tkt_Ty3 col-md-2 radio-inline">
                                        <label for="Tkt_Ty3" class="Tkt_Ty3 col-md-10 p-0">{{ trans('admin.Tkt_Ty3') }}</label>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="col-md-10">
                                <fieldset id="tableFilter">
                                    <legend>شروط استحقاق التذاكر</legend>
                                    <!-- لا يتم تعويض التذكرة ان لم يكن الضفر فعلى -->
                                    <div class="row">
                                        <input id="Tkt_Ty4" type="checkbox" @if($data->Tkt_Ty4 ==1) selected @endif value="{{$data->Tkt_Ty4}}" disabled name="Tkt_Ty4" class="Tkt_Ty4 col-md-2 radio-inline">
                                        <label FOR="Tkt_Ty4" class="col-md-10 p-0">{{trans('hr.Tkt_Ty4')}}</label>
                                    </div>
                                    <!-- نصف تذكرة فى حالة السفر بالبر او البحر -->
                                    <div class="row">
                                        <input id="Tkt_Ty5" type="checkbox" @if($data->Tkt_Ty5 ==1) selected @endif value="{{$data->Tkt_Ty5}}" disabled name="Tkt_Ty5" class="Tkt_Ty5 col-md-2 radio-inline">
                                        <label FOR="Tkt_Ty5" class="col-md-10 p-0 fs-13">{{trans('hr.Tkt_Ty5')}}</label>
                                    </div>
                                    <!-- يحق لنا اختيار ارخص الخطوط سواء مباشرة او غير مياشرة -->
                                    <div class="row">
                                        <input id="Tkt_Ty6" type="checkbox" @if($data->Tkt_Ty6 ==1) selected @endif value="{{$data->Tkt_Ty6}}" disabled name="Tkt_Ty6" class="Tkt_Ty6 col-md-2 radio-inline">
                                        <label FOR="Tkt_Ty6" class="col-md-10 p-0">{{trans('hr.Tkt_Ty6')}}</label>
                                    </div>
                                    <!-- السفر اتلفعلى لمحرم المتقاعد -->
                                    <div class="row">
                                        <input id="Tkt_Ty7" type="checkbox" @if($data->Tkt_Ty7 ==1) selected @endif value="{{$data->Tkt_Ty7}}" disabled name="Tkt_Ty7" class="Tkt_Ty7 col-md-2 radio-inline">
                                        <label FOR="Tkt_Ty7" class="col-md-10 p-0">{{trans('hr.Tkt_Ty7')}}</label>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                    </div> <!-- نهاية استحقاق التذكرة -->
                </div>
            </div>
        </div>
    </div>
</div>
