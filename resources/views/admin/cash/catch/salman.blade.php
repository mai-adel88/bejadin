<div class="col-md-2">
    <label for="Slm_No_Name">{{trans('admin.sales_officer2')}}</label>
    <input type="text" name="Slm_No_Name" id="Slm_No_Name"
           class="form-control" value='{{$salesman->{'Slm_Nm'.ucfirst(session('lang'))} }}'>
</div>
<div class="col-md-1">
    <label for=""></label>
    <input type="text" name="Slm_No" id="Slm_No" class="form-control" value='{{$salesman->Slm_No}}'>
    <br>
</div>
