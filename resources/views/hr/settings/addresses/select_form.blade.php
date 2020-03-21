<div class="col-md-12">
    <div class="col-md-12 well">

        <div class="row form-group">
            <div class="col-md-5">
                <label class="col-md-3">{{trans('hr.company')}}</label>
                <div class="col-md-9 p-0">
                    <select name="Cmp_No" class="select2 Cmp_No form-control">
                        <option disabled selected>{{trans('admin.select')}}</option>
                        @foreach($companies as $mainCompany)
                            <option value="{{$mainCompany->Cmp_No}}">{{$mainCompany->{'Cmp_Nm'.ucfirst(session('lang'))} }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <!-- القسم -->
            <div class="col-md-5 ">
                <label class="col-md-3 ">{{trans('hr.emp')}}</label>
                <div class="col-md-9 p-0">
                    <select name="SubCmp_No" class="select2 SubCmp_No form-control">
                        <option>{{trans('admin.select')}}</option>
                    </select>
                </div>
            </div>

        </div> <!-- end of first row -->
    </div>
</div>