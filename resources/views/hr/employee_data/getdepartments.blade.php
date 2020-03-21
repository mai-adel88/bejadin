<option disabled selected>{{trans('admin.select')}}</option>
@foreach($departments as $department)
    <option value="{{$department->Depm_Main}}">{{$department->{'Depm_Nm'.ucfirst(session('lang'))} }}</option>
@endforeach



{{$department->{'Depm_Nm'.ucfirst(session('lang'))} }}