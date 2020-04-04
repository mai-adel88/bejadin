<div class="empData">
    <div class="panel panel-default">
        <div class="panel-body" style="background-color: #fff;color: #4d6672;">
            <div class="row" style="margin-top: 15px;">
                <div class="col-md-4">
                    <div class="col-md-12">
                        <label class="col-md-5" style="padding:0px;">{{trans('hr.month_share')}}</label>
                        <input type="text" name="" id="month_share" class="col-md-6 month_share input_text form-control">
                    </div>
                    <div class="col-md-12">
                        <label class="col-md-5" style="padding:0px;">{{trans('hr.Open_Balnc')}}</label>
                        <input type="text" name="Open_Balnc" class="col-md-6 input_text form-control">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="col-md-12">
                        <label style="margin-bottom: 20px;">
                            <input type="checkbox" name="Unpad_Nxtyer">{{trans('hr.Unpad_Nxtyer')}}
                        </label>
                    </div>
                    <div class="col-md-12">
                        <label class="col-md-6" style="padding:0px;">{{trans('hr.due_to_date')}}</label>
                        <input type="text" name="" class="col-md-6 input_text form-control">
                    </div>
                    <div class="col-md-12">
                        <label class="col-md-6" style="padding:0px;">{{trans('hr.Last_Ret_Dt')}}</label>
                        <input type="text" name="" class="col-md-6 input_text form-control">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="col-md-12">
                        <label class="col-md-6" style="padding:0px;">{{trans('hr.date_of_hiring')}}</label>
                        <input type="text" name="" class="col-md-6 input_text form-control datepicker">
                    </div>
                    <div class="col-md-12">
                        <label class="col-md-6" style="padding:0px;">{{trans('hr.actual_days')}}</label>
                        <input type="text" name="" class="col-md-6 input_text form-control">
                    </div>
                    <div class="col-md-12">
                        <label class="col-md-6" style="padding:0px;">{{trans('hr.Blnc_Paid')}}</label>
                        <input type="text" name="Blnc_Paid" class="col-md-6 input_text form-control">
                    </div>
                    <div class="col-md-12">
                        <label class="col-md-6" style="padding:0px;">{{trans('hr.Blnc_UnPaid')}}</label>
                        <input type="text" name="Blnc_UnPaid" class="col-md-6 input_text form-control">
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
                    <a class="nav-link" id="home-tab1" data-toggle="tab" href="#basic_data" role="tab" aria-controls="home"
                    aria-selected="true">{{trans('hr.basic_data')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="home-tab1" data-toggle="tab" href="#vacancies" role="tab" aria-controls="home"
                    aria-selected="true">{{trans('hr.last_vacation_data')}}</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent1">
                <!-- first tab -->
                <div class="tab-pane fade show active in" id="yearly" role="tabpanel" aria-labelledby="home-tab">
                    <div class="row">
                        <div class="col-md-2" style="margin-top:10px;">
                            <div class="col-md-12">
                                <input type="radio" value="1" checked id="first_Inc_Typ" name="Inc_Typ" class="col-md-2 radio-inline">
                                <label class="col-md-10 pl-0 p-0">{{trans('hr.no_bonus')}}</label>
                            </div>
                            <div class="col-md-12">
                                <input type="radio" value="2" name="Inc_Typ" class="col-md-2 radio-inline">
                                <label class="col-md-10 pl-0 p-0">{{trans('hr.fix_bonus')}}</label>
                            </div>
                            <div class="col-md-12">
                                <input type="radio" value="3" name="Inc_Typ" class="col-md-2 radio-inline">
                                <label class="col-md-10 pl-0 p-0">{{trans('hr.ch_bonus')}}</label>
                            </div>
                        </div>
                        <div class="col-md-3" style="margin-top:10px;">
                            <div class="col-md-12">
                                <label class="col-md-7">{{trans('hr.bonus_year')}}</label>
                                <input type="number" min="1" disabled id="Inc_Yer" name="Inc_Yer" class="col-md-5 input_text form-control">
                            </div>
                            <div class="col-md-12">
                                <label class="col-md-7">{{trans('hr.no_days')}}</label>
                                <input type="number" min="1" disabled id="Inc_days" name="Inc_days" class="col-md-5 input_text form-control">
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
                                    <td>
                                    <input type="text">
                                    </td>
                                    <td><input type="text"></td>
                                    <td><input type="text"></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- second tab -->
                <div class="tab-pane fade" id="basic_data" role="tabpanel" aria-labelledby="home-tab">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-12" style="margin-top:5px; padding:0px;">
                                <div class="col-md-6">
                                    <label class="col-md-6" style="padding:0px;">{{trans('hr.vacations_merit_types')}}</label>
                                    <select name="Hld_Ern" id="Hld_Ern" class="col-md-6 input_text form-control" placeholder="{{trans('admin.select')}}">
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
                                    <input type="text" id="Hld_Ern_Prod" name="Hld_Ern_Prod"  class="col-md-6 input_text form-control">
                                </div>
                                <div class="col-md-3">
                                    <label class="col-md-6" style="padding:0px;">{{trans('hr.duration_contract')}}</label>
                                    <input type="text" name="" class="col-md-6 input_text form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12" style="padding:0px;">
                                <div class="col-md-8">
                                    <label class="col-md-8" style="padding:0px;">{{trans('hr.DueDt_Hldy')}}</label>
                                    <input type="text" name="" class="col-md-4 input_text form-control datepicker">
                                </div>
                                <div class="col-md-4">
                                    <label class="col-md-4" style="padding:0px;">{{trans('hr.Cnt_Stdt_Hi')}}</label>
                                    <input type="text" name="" class="col-md-8 input_text form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12" style="padding:0px;">
                                <div class="col-md-8">
                                    <label class="col-md-8" style="padding:0px;">{{trans('hr.DueDt_Tkt')}}</label>
                                    <input type="text" name="" class="col-md-4 input_text form-control datepicker">
                                </div>
                                <div class="col-md-4">
                                    <label class="col-md-4" style="padding:0px;">{{trans('hr.Cnt_Stdt_Hi')}}</label>
                                    <input type="text" name="" class="col-md-8 input_text form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-9">
                                <label class="col-md-7" style="padding:0px;"> {{trans('hr.Start_Paid')}} </label>
                                <input type="text" name="Start_Paid" class="input_text col-md-2 form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-9">
                                <label class="col-md-7" style="padding:0px;"> {{trans('hr.Start_UnPaid')}}  </label>
                                <input type="text" name="Start_UnPaid" class="input_text col-md-2 form-control ">
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
                            {{ Form::select('HldTrnsp_No',\App\Enums\Hr\HrTransType::toSelectArray() ,null,
                            array_merge(['class' => 'col-md-2 input_text form-control', 'placeholder'=>trans('admin.select')])) }}

                            <!-- Tkt_No عدد التذاكر  -->
                            <div class="col-md-2">
                                <input type="number" name="Tkt_No" min="1" class="input_text">
                            </div>
                            <div class="col-md-3">
                                <input name="Tkt_Class" type="text" class="input_text">
                            </div>
                            <div class="col-md-4">
                                <input type="text" name="Tkt_Sector" class="input_text">
                            </div>

                        </div>
                        <div class="row">
                            <label class="col-md-1 p-0">{{trans('hr.husband')}}</label>
                            {{ Form::select('HldTrnsp_No',\App\Enums\Hr\HrTransType::toSelectArray() ,null,
                            array_merge(['class' => 'col-md-2 input_text form-control', 'placeholder'=>trans('admin.select')])) }}

                            <div class="col-md-2">
                                <input type="number" name="Tkt_No1" min="1" class="input_text">
                            </div>
                            <div class="col-md-3">
                                <input type="text" name="Tkt_Class1" class="input_text">
                            </div>
                            <div class="col-md-4">
                                <input type="text" name="Tkt_Sector1" class="input_text">
                            </div>

                        </div>
                        <div class="row">
                            <label class="col-md-1 p-0">{{trans('hr.boys')}}</label>
                            {{ Form::select('HldTrnsp_No',\App\Enums\Hr\HrTransType::toSelectArray() ,null,
                            array_merge(['class' => 'col-md-2 input_text form-control', 'placeholder'=>trans('admin.select')])) }}

                            <div class="col-md-2">
                                <input type="number" name="Tkt_No2" min="1" class="input_text">
                            </div>
                            <div class="col-md-3">
                                <input type="text" name="Tkt_Class2" class="input_text">
                            </div>
                            <div class="col-md-4">
                                <input type="text" name="Tkt_Sector2" class="input_text">
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
                                        <input id="Tkt_Ty1" type="checkbox"  name="Tkt_Ty1" class="Tkt_Ty1 col-md-2 radio-inline">
                                        <label for="Tkt_Ty1" class="col-md-10 p-0">{{ trans('admin.Tkt_Ty1') }}</label>
                                    </div>
                                    <!-- عند الاجازة السنوية -->
                                    <div class="row">
                                        <input id="Tkt_Ty2" type="checkbox" name="Tkt_Ty2" class="Tkt_Ty2 col-md-2 radio-inline">
                                        <label for="Tkt_Ty2" class="col-md-10 p-0 fs-13">{{ trans('admin.Tkt_Ty2') }}</label>
                                    </div>
                                    <!-- عند نهاية العقد -->
                                    <div class="row">
                                        <input id="Tkt_Ty3" type="checkbox" name="Tkt_Ty3" class="Tkt_Ty3 col-md-2 radio-inline">
                                        <label for="Tkt_Ty3" class="Tkt_Ty3 col-md-10 p-0">{{ trans('admin.Tkt_Ty3') }}</label>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="col-md-10">
                                <fieldset id="tableFilter">
                                    <legend>شروط استحقاق التذاكر</legend>
                                    <!-- لا يتم تعويض التذكرة ان لم يكن الضفر فعلى -->
                                    <div class="row">
                                        <input id="Tkt_Ty4" type="checkbox" name="Tkt_Ty4" class="Tkt_Ty4 col-md-2 radio-inline">
                                        <label FOR="Tkt_Ty4" class="col-md-10 p-0">{{trans('hr.Tkt_Ty4')}}</label>
                                    </div>
                                    <!-- نصف تذكرة فى حالة السفر بالبر او البحر -->
                                    <div class="row">
                                        <input id="Tkt_Ty5" type="checkbox" name="Tkt_Ty5" class="Tkt_Ty5 col-md-2 radio-inline">
                                        <label FOR="Tkt_Ty5" class="col-md-10 p-0 fs-13">{{trans('hr.Tkt_Ty5')}}</label>
                                    </div>
                                    <!-- يحق لنا اختيار ارخص الخطوط سواء مباشرة او غير مياشرة -->
                                    <div class="row">
                                        <input id="Tkt_Ty6" type="checkbox" name="Tkt_Ty6" class="Tkt_Ty6 col-md-2 radio-inline">
                                        <label FOR="Tkt_Ty6" class="col-md-10 p-0">{{trans('hr.Tkt_Ty6')}}</label>
                                    </div>
                                    <!-- السفر اتلفعلى لمحرم المتقاعد -->
                                    <div class="row">
                                        <input id="Tkt_Ty7" type="checkbox" name="Tkt_Ty7" class="Tkt_Ty7 col-md-2 radio-inline">
                                        <label FOR="Tkt_Ty7" class="col-md-10 p-0">{{trans('hr.Tkt_Ty7')}}</label>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                    </div> <!-- نهاية استحقاق التذكرة -->
                </div>
                <!-- third tab -->
                <div class="tab-pane fade" id="vacancies" role="tabpanel" aria-labelledby="home-tab">
                    <div class="row">
                        <div class="col-md-2" style="margin-top: 35px;">
                            <label style="padding:0px;">{{trans('hr.hld_year')}}</label>
                            <label style="padding:0px;margin-top: 10px;">{{trans('hr.Hld_No2')}}</label>
                            <label style="padding:0px;margin-top: 10px;">{{trans('hr.hld_emergency')}}</label>
                            <label style="padding:0px;margin-top: 10px;">{{trans('hr.Hld_No3')}}</label>
                            <label style="padding:0px;margin-top: 10px;">{{trans('hr.Hld_No5')}}</label>
                        </div>
                        <div class="col-md-2" style="padding: 2px;">
                            <label>{{trans('hr.star_date')}}</label>
                            <input type="text" name="Hld_Stdt1" class="Hld_Stdt1 input_text form-control datepicker">
                            <input type="text" name="Hld_Stdt2" class="Hld_Stdt2 input_text form-control datepicker">
                            <input type="text" name="Hld_Stdt4" class="Hld_Stdt3 input_text form-control datepicker">
                            <input type="text" name="Hld_Stdt3" class="Hld_Stdt4 input_text form-control datepicker">
                            <input type="text" name="Hld_Stdt5" class="Hld_Stdt5 input_text form-control datepicker">
                        </div>
                        <div class="col-md-2" style="padding: 2px;">
                            <label>{{trans('hr.finishing_d')}}</label>
                            <input type="text" name="Hld_Endt1" class="input_text form-control datepicker">
                            <input type="text" name="Hld_Endt2" class="input_text form-control datepicker">
                            <input type="text" name="Hld_Endt4" class="input_text form-control datepicker">
                            <input type="text" name="Hld_Endt3" class="input_text form-control datepicker">
                            <input type="text" name="Hld_Endt5" class="input_text form-control datepicker">
                        </div>
                        <div class="col-md-2" style="padding: 2px;">
                            <label>{{trans('hr.Hld_Rtdt1')}}</label>
                            <input type="text" name="Hld_Rtdt1" class="Hld_Rtdt1 input_text form-control datepicker">
                            <input type="text" name="Hld_Rtdt2" class="Hld_Rtdt2 input_text form-control datepicker">
                            <input type="text" name="Hld_Rtdt4" class="Hld_Rtdt3 input_text form-control datepicker">
                            <input type="text" name="Hld_Rtdt3" class="Hld_Rtdt4 input_text form-control datepicker">
                            <input type="text" name="Hld_Rtdt5" class="Hld_Rtdt5 input_text form-control datepicker">
                        </div>
                        <div class="col-md-1" style="padding: 2px;">
                            <label>{{trans('hr.Hld_Prod1')}}</label>
                            <input type="text" name="Hld_Prod1" class="Hld_Prod1 input_text form-control">
                            <input type="text" name="Hld_Prod2" class="Hld_Prod2 input_text form-control">
                            <input type="text" name="Hld_Prod4" class="Hld_Prod3 input_text form-control">
                            <input type="text" name="Hld_Prod3" class="Hld_Prod4 input_text form-control">
                            <input type="text" name="Hld_Prod5" class="Hld_Prod5 input_text form-control">
                        </div>
                        <div class="col-md-2" style="padding: 2px;">
                            <label>{{trans('hr.Isu_Bln1')}}</label>
                            <input type="text" name="Isu_Bln1" class="input_text form-control">
                            <input type="text" name="Isu_Bln2" class="input_text form-control">
                            <input type="text" name="Isu_Bln4" class="input_text form-control">
                            <input type="text" name="Isu_Bln3" class="input_text form-control">
                            <input type="text" name="Isu_Bln5" class="input_text form-control">
                        </div>
                        <div class="col-md-1" style="padding: 2px;">
                            <label>{{trans('hr.Hld_No1')}}</label>
                            <input type="text" name="Hld_No1" class="input_text form-control">
                            <input type="text" name="Hld_No2" class="input_text form-control">
                            <input type="text" name="Hld_No4" class="input_text form-control">
                            <input type="text" name="Hld_No3" class="input_text form-control">
                            <input type="text" name="Hld_No5" class="input_text form-control">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
