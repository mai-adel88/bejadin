<option disabled selected>{{trans('admin.select')}}</option>
@foreach($employees as $employee)
    <option value="{{$employee->Emp_No}}">{{$employee->{'Emp_Nm'.ucfirst(session('lang'))} }}</option>
@endforeach
