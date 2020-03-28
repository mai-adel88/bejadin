<div class="form-group empAddressData">
    <div class="col-md-6">
        <fieldset id="tableFilter">
            <legend>داخل المملكة</legend>
            <div class="row form-group">
                <label class="col-md-2">اسم المدينة</label>
                <select name="Emp_City" class="col-md-4 form-control">
                <option disabled selected>{{trans('hr.select')}}</option>
                    @foreach($cities as $city)
                        <option {{ old('Emp_City') == $city->id ? "selected" : "" }} value="{{$city->id}}">{{$city->city_name_ar}}</option>
                    @endforeach
                </select>

                <label class="col-md-2">المنطقه</label>
                <select name="Stat_No" class="col-md-3 form-control">
                <option disabled selected>{{trans('hr.select')}}</option>
                    @foreach($cities as $city)
                        <option {{ old('Stat_No') == $city->id ? "selected" : "" }} value="{{$city->id}}">{{$city->city_name_ar}}</option>
                    @endforeach
                </select>
            </div>
            <div class="row form-group">
                <label class="col-md-2">هاتف</label>
                <input type="text" name="Emp_Phon" class="form-control col-md-4">
                <label class="col-md-2">الموبايل</label>
                {{Form::text('Emp_Mobile','',array_merge(['class'=>'form-control col-md-3 br-5']))}}
                
            </div>
            <div class="row form-group">
                <label class="col-md-2 ">العنوان</label>
                {{Form::text('Emp_Street','',array_merge(['class'=>'col-md-9 br-5 form-control']))}}
                
            </div>

            <div class="row form-group">
                <label class="col-md-2">شخص للرجوع اليه</label>
                {{Form::text('RefPerson_Nm','',array_merge(['class'=>'form-control col-md-4']))}}
                <label class="col-md-2">هاتف</label>
                {{Form::text('RefPerson_Mobile','',array_merge(['class'=>'form-control col-md-3 br-5']))}}
                
            </div>
            <div class="row form-group">
                <label class="col-md-2">الايميل</label>
                {{Form::text('E_Email','',array_merge(['id'=>'E_Email','class'=>'col-md-9 br-5 form-control']))}}
            </div>
        </fieldset>
    </div> <!-- end of col-md-6 داخل المملكة-->
    <div class="col-md-6">
        <fieldset id="tableFilter">
            <legend>خارج المملكة</legend>
            <div class="row form-group">
                <label class="col-md-2">الدولة</label>
                    <select name="Cntry_No" class="col-md-4 form-control">
                        <option disabled selected>{{trans('admin.select')}}</option>
                        @foreach($countries as $country)
                            <option {{ old('Cntry_No') == $country->id ? "selected" : "" }} value="{{$country->id}}">{{$country->country_name_ar}}</option>
                        @endforeach
                    </select>
            </div>
            <div class="row form-group">
                <label class="col-md-2">هاتف</label>
                {{Form::text('Phon_Cntry','',array_merge(['class'=>'form-control col-md-4']))}}
                <!-- <input type="text" name="Phon_Cntry" class="form-control col-md-4"> -->
                
            </div>
            <div class="row form-group">
                <label class="col-md-2 ">العنوان</label>
                {{Form::text('Emp_Adrs','',array_merge(['class'=>'col-md-9 br-5 form-control']))}}
                <!-- <input class="col-md-9 br-5 form-control" id="Emp_Adrs" type="text" name="Emp_Adrs" > -->
            </div>
            <div class="row form-group">
                <label class="col-md-2 ">احد الاقارب</label>
                {{Form::text('Name_Nerst','',array_merge(['class'=>'form-control col-md-4 br-5']))}}
                <!-- <input class="col-md-4 br-5 form-control" id="Name_Nerst" type="text" name="Name_Nerst"> -->

                <label class="col-md-2">الهاتف</label>
                {{Form::text('Phon_nerst','',array_merge(['class'=>'col-md-3 br-5 form-control']))}}
                <!-- <input class="col-md-3 br-5 form-control" id="Phon_nerst" type="text" name="Phon_nerst"> -->
            </div>
            <div class="row form-group">
                <label class="col-md-2 ">العنوان</label>
                {{Form::text('Adrs_Nerst','',array_merge(['class'=>'col-md-9 br-5 form-control']))}}
                <!-- <input class="col-md-9 br-5 form-control" id="Adrs_Nerst" type="text" name="Adrs_Nerst"> -->
            </div>


            <div class="row form-group">
                <label class="col-md-2">ملاحظات</label>
                {{Form::text('Notes','',array_merge(['class'=>'col-md-9 br-5 form-control']))}}
                <!-- <input class="col-md-9 br-5 form-control" id="Notes" type="text" name="Notes"> -->
            </div>
        </fieldset>
    </div> <!-- end of col-md-6 خارج المملكة-->
</div>