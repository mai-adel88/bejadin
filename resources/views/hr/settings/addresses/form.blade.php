<!-- THIRD tap -->
{{--{{dd('dd')}}--}}

{{--<div class="tab-pane fade" id="titles" role="tabpanel" aria-labelledby="home-tab">--}}
    <div class="panel panel-default">
        <div class="panel-body">
            @include('hr.settings.addresses.select_form')

            <div class="row">
                <div class="form-group employee-data">
                    {{-- داخل المملكة--}}
                    <div class="col-md-6">
                        <fieldset id="tableFilter">
                            <legend>داخل المملكة</legend>
                            <div class="row form-group">
                                <label class="col-md-2">اسم المدينة</label>

                                {{--{!!Form::select('Emp_City',$cities,$employee->Emp_City,--}}
                                {{--['placeholder' =>($employee->id) ? null:trans('admin.select')],--}}
                                {{--[--}}
                                {{--'class' => 'form-control col-md-4'--}}
                                 {{--])!!}--}}


                                <select name="Emp_City" class="col-md-4 form-control">
                                    <option disabled selected>{{trans('hr.select')}}</option>
                                    @foreach($cities as $city)
                                        <option value="{{$city->id}}">{{$city->city_name_ar}}</option>
                                    @endforeach
                                </select>

                                <label class="col-md-2">المنطقه</label>
                                <select name="Stat_No" class="col-md-3 form-control">
                                    <option disabled selected>{{trans('hr.select')}}</option>
                                    @foreach($cities as $city)
                                        <option value="{{$city->id}}">{{$city->city_name_ar}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="row form-group">
                                <label class="col-md-2">هاتف</label>
                                <input type="text" name="Emp_Phon" class="form-control col-md-4">
                                {{--{!!Form::text('Emp_Phon',$employee->Emp_Phon,['class'=>'form-control col-md-4'])!!}--}}

                                <label class="col-md-2">الموبايل</label>
                                <input type="text" name="Emp_Mobile" class="form-control col-md-3 br-5">
                            </div>
                            <div class="row form-group">
                                <label class="col-md-2 ">العنوان</label>
                                <input class="col-md-9 br-5 form-control" id="Emp_Street" type="text" name="Emp_Street" >
                            </div>

                            <div class="row form-group">
                                <label class="col-md-2">شخص للرجوع اليه</label>
                                <input type="text" name="RefPerson_Nm" class="form-control col-md-4">
                                <label class="col-md-2">هاتف</label>
                                <input type="text" name="RefPerson_Mobile" class="form-control col-md-3 br-5">
                            </div>
                            <div class="row form-group">
                                <label class="col-md-2">الايميل</label>
                                <input class="col-md-9 br-5 form-control" id="E_Email" type="text" name="E_Email" >
                            </div>
                        </fieldset>
                    </div>
                    <!-- end of col-md-6 داخل المملكة-->

                    {{--خارج المملكة--}}
                    <div class="col-md-6">
                        <fieldset id="tableFilter">
                            <legend>خارج المملكة</legend>
                            <div class="row form-group">
                                <label class="col-md-2">الدولة</label>
                                <select name="Cntry_No" class="col-md-4 form-control">
                                    <option disabled selected>{{trans('admin.select')}}</option>
                                    @foreach($countries as $country)
                                        <option value="{{$country->id}}">{{$country->country_name_ar}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="row form-group">
                                <label class="col-md-2">هاتف</label>
                                <input type="text" name="Phon_Cntry" class="form-control col-md-4">
                                <!-- <label class="col-md-2">نوع الاعادة</label>
                                <input type="text" name="" class="form-control col-md-3 br-5"> -->
                            </div>
                            <div class="row form-group">
                                <label class="col-md-2 ">العنوان</label>
                                <input class="col-md-9 br-5 form-control" id="Emp_Adrs" type="text" name="Emp_Adrs" >
                            </div>
                            <div class="row form-group">
                                <label class="col-md-2 ">احد الاقارب</label>
                                <input class="col-md-4 br-5 form-control" id="Name_Nerst" type="text" name="Name_Nerst">

                                <label class="col-md-2">الهاتف</label>
                                <input class="col-md-3 br-5 form-control" id="Phon_nerst" type="text" name="Phon_nerst">
                            </div>
                            <div class="row form-group">
                                <label class="col-md-2 ">العنوان</label>
                                <input class="col-md-9 br-5 form-control" id="Adrs_Nerst" type="text" name="Adrs_Nerst">
                            </div>


                            <div class="row form-group">
                                <label class="col-md-2">ملاحظات</label>
                                <input class="col-md-9 br-5 form-control" id="Notes" type="text" name="Notes">
                            </div>
                        </fieldset>
                    </div> <!-- end of col-md-6 خارج المملكة-->

                </div>
            </div>


            <div class="form-group">
                <button class="btn btn-primary" type="submit">حفظ</button>
            </div>
        </div>
    </div>
{!! Form::close() !!}

{{--</div>--}}