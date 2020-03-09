@if(count($salesman) > 0)
    @foreach($salesman as $man)
        <option value="{{$man->Slm_No}}" @if($man->Slm_No == $customer->Slm_No) selected @endif>
            {{$man->{'Slm_Nm'.ucfirst(session('lang'))} }}
        </option>
    @endforeach
@else
    <option value="">{{trans('admin.nodata')}}</option>
@endif
