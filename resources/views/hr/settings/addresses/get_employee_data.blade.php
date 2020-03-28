 <!-- second row -->
 <div class="form-group empAddressData">
    <div class="col-md-6">
        <fieldset id="tableFilter">
            <legend>داخل المملكة</legend>
            <div class="row form-group">
                <label class="col-md-2">اسم المدينة</label>
                <select name="Emp_City" class="col-md-4 form-control">
                <option>{{trans('hr.select')}}</option>
                    @foreach($cities as $city)
                        <option @if($emp_data->Emp_City == $city->id) selected @endif value="{{$city->id}}">{{$city->city_name_ar}}</option>
                    @endforeach
                </select>

                <label class="col-md-2">المنطقه</label>
                <select name="Stat_No" class="col-md-3 form-control">
                <option value="">{{trans('hr.select')}}</option>
                    @foreach($cities as $city)
                        <option @if($emp_data->Stat_No == $city->id) selected @endif value="{{$city->id}}">{{$city->city_name_ar}}</option>
                    @endforeach
                </select>
            </div>
            <div class="row form-group">
                <label class="col-md-2">هاتف</label>
                <input type="text" value="{{$emp_data->Emp_Phon ? $emp_data->Emp_Phon : ''}}" name="Emp_Phon" class="form-control col-md-4">
                <label class="col-md-2">الموبايل</label>
                <input type="text" value="{{$emp_data->Emp_Mobile?$emp_data->Emp_Mobile:''}}" name="Emp_Mobile" class="form-control col-md-3 br-5">
            </div>
            <div class="row form-group">
                <label class="col-md-2 ">العنوان</label>
                <input class="col-md-9 br-5 form-control" value="{{$emp_data->Emp_Street ? $emp_data->Emp_Street:''}}" id="Emp_Street" type="text" name="Emp_Street" >
            </div>

            <div class="row form-group">
                <label class="col-md-2">شخص للرجوع اليه</label>
                <input type="text" value="{{$emp_data->RefPerson_Nm ? $emp_data->RefPerson_Nm:''}}" name="RefPerson_Nm" class="form-control col-md-4">
                <label class="col-md-2">هاتف</label>
                <input type="text" value="{{$emp_data->RefPerson_Nm ? $emp_data->RefPerson_Mobile:''}}" name="RefPerson_Mobile" class="form-control col-md-3 br-5">
            </div>
            <div class="row form-group">
                <label class="col-md-2">الايميل</label>
                <input class="col-md-9 br-5 form-control" value="{{$emp_data->E_Email ? $emp_data->E_Email:''}}" id="E_Email" type="email" name="E_Email" >
            </div>
        </fieldset>
    </div> <!-- end of col-md-6 داخل المملكة-->
    <div class="col-md-6">
        <fieldset id="tableFilter">
            <legend>خارج المملكة</legend>
            <div class="row form-group">
                <label class="col-md-2">الدولة</label>
                    <select name="Cntry_No" class="col-md-4 form-control">
                        <option value="">{{trans('admin.select')}}</option>
                        @foreach($countries as $country)
                            <option @if($emp_data->Cntry_No == $country->id) selected @endif value="{{$country->id}}">{{$country->country_name_ar}}</option>
                        @endforeach
                    </select>
            </div>
            <div class="row form-group">
                <label class="col-md-2">هاتف</label>
                <input type="text" value="{{$emp_data->Phon_Cntry ? $emp_data->Phon_Cntry:''}}" name="Phon_Cntry" class="form-control col-md-4">
            </div>
            <div class="row form-group">
                <label class="col-md-2 ">العنوان</label>
                <input class="col-md-9 br-5 form-control" value="{{$emp_data->Emp_Adrs ? $emp_data->Emp_Adrs:''}}" id="Emp_Adrs" type="text" name="Emp_Adrs" >
            </div>
            <div class="row form-group">
                <label class="col-md-2 ">احد الاقارب</label>
                <input class="col-md-4 br-5 form-control" value="{{$emp_data->Name_Nerst ? $emp_data->Name_Nerst:''}}" id="Name_Nerst" type="text" name="Name_Nerst">

                <label class="col-md-2">الهاتف</label>
                <input class="col-md-3 br-5 form-control" value="{{$emp_data->Phon_nerst ? $emp_data->Phon_nerst:''}}" id="Phon_nerst" type="text" name="Phon_nerst">
            </div>
            <div class="row form-group">
                <label class="col-md-2 ">العنوان</label>
                <input class="col-md-9 br-5 form-control" value="{{$emp_data->Adrs_Nerst ? $emp_data->Adrs_Nerst:''}}" id="Adrs_Nerst" type="text" name="Adrs_Nerst">
            </div>


            <div class="row form-group">
                <label class="col-md-2">ملاحظات</label>
                <input class="col-md-9 br-5 form-control" value="{{$emp_data->Notes ? $emp_data->Notes:''}}" id="Notes" type="text" name="Notes">
            </div>
        </fieldset>
    </div> <!-- end of col-md-6 خارج المملكة-->
 </div>
<!-- end second row -->