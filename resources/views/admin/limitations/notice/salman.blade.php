<div class="col-md-2">
    <label for="Salman_No_Name">{{trans('admin.sales_officer2')}}</label>
    <input type="text" name="Salman_No_Name" id="Salman_No_Name"
         class="form-control" value='{{$salesman->{'Slm_Nm'.ucfirst(session('lang'))} }}'>
</div>
<div class="col-md-1">
    <label for=""></label>
    <input type="text" name="Salman_No" id="Salman_No" class="form-control" value='{{$salesman->Slm_No}}'>
    <br>
</div>