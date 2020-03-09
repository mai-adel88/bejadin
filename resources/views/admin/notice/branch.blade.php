@if(count($branches) > 0)
    @foreach($branches as $brn)
        <option value="{{$brn->Brn_No}}"
                @if($gl && $gl->Brn_No == $brn->Brn_No)
                selected
                @else
                @if($last_record && $brn->Brn_No == $last_record->Brn_No)
                selected
            @endif
            @endif>
            {{$brn->{'Brn_Nm'.ucfirst(session('lang'))} }}
        </option>
    @endforeach
@else
    <option value="">{{trans('admin.nodata')}}</option>
@endif
