<div class="empData">
    <div class="panel panel-default">
        <div class="panel-body" style="background-color: #fff;color: #4d6672;">
            <div class="row" style="margin-top: 15px;">
                <div class="col-md-4">
                    <div class="col-md-12">
                        <label class="col-md-5" style="padding:0px;">{{trans('hr.vacations_merit_types')}}</label>
                        {{ Form::select('Hld_Ern',\App\Enums\Hr\AstcHldyEarn::toSelectArray() ,null,
                            array_merge(['class' => 'col-md-6 input_text form-control', 'placeholder'=>trans('admin.select')])) }}
                    </div>
                    <div class="col-md-12">
                        <label class="col-md-5" style="padding:0px;">{{trans('hr.Hld_Ern_Prod')}}</label>
                        <input type="text" name="Hld_Ern_Prod" class="col-md-6 input_text form-control">
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
                    <a class="nav-link" id="home-tab1" data-toggle="tab" href="#vacancies" role="tab" aria-controls="home"
                    aria-selected="true">{{trans('hr.last_vacation_data')}}</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent1">
                <!-- first tab -->
                <div class="tab-pane fade show active in" id="yearly" role="tabpanel" aria-labelledby="home-tab">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="col-md-12">
                                <input type="radio" value="1" name="Inc_Typ" class="col-md-2 radio-inline">
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
                        <div class="col-md-3">
                            <div class="col-md-12">
                                <label class="col-md-7">{{trans('hr.bonus_year')}}</label>
                                <input type="number" min="0" name="Inc_Yer" class="col-md-5 input_text form-control">
                            </div>
                            <div class="col-md-12">
                                <label class="col-md-7">{{trans('hr.no_days')}}</label>
                                <input type="number" min="0" name="Inc_days" class="col-md-5 input_text form-control">
                            </div>
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
                        </div>
                        <div class="col-md-2" style="padding: 2px;">
                            <label>{{trans('hr.star_date')}}</label>
                            <input type="text" name="Hld_Stdt1" class="input_text form-control datepicker">
                            <input type="text" name="Hld_Stdt2" class="input_text form-control datepicker">
                            <input type="text" name="Hld_Stdt4" class="input_text form-control datepicker">
                            <input type="text" name="Hld_Stdt3" class="input_text form-control datepicker">
                            <input type="text" name="Hld_Stdt5" class="input_text form-control datepicker">
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
                            <input type="text" name="Hld_Rtdt1" class="input_text form-control datepicker">
                            <input type="text" name="Hld_Rtdt2" class="input_text form-control datepicker">
                            <input type="text" name="Hld_Rtdt4" class="input_text form-control datepicker">
                            <input type="text" name="Hld_Rtdt3" class="input_text form-control datepicker">
                            <input type="text" name="Hld_Rtdt5" class="input_text form-control datepicker">
                        </div>
                        <div class="col-md-1" style="padding: 2px;">
                            <label>{{trans('hr.Hld_Prod1')}}</label>
                            <input type="text" name="Hld_Prod1" class="input_text form-control">
                            <input type="text" name="Hld_Prod2" class="input_text form-control">
                            <input type="text" name="Hld_Prod4" class="input_text form-control">
                            <input type="text" name="Hld_Prod3" class="input_text form-control">
                            <input type="text" name="Hld_Prod5" class="input_text form-control">
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
