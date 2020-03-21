<option disabled selected>{{trans('admin.select')}}</option>
@foreach($employees as $employee)
    <option value="{{$employee->Emp_No}}">{{$employee->Emp_NmAr}}</option>
@endforeach
