@if($credits)
    <option>{{trans('admin.select')}}</option>
    @foreach($credits as $credit)
        <option value="{{$credit->Acc_No}}">{{$credit->{'Acc_Nm'.ucfirst(session('lang'))} }}</option>
    @endforeach
@endif
