@if(count($branches) > 0)
    <select name="Dlv_Stor" id="Dlv_Stor" class="form-control">
        <option value="">{{trans('admin.select')}}</option>
        @foreach($branches as $brn)
            <option value="{{$brn->Brn_No}}" @if($gl && $gl->Brn_No == $brn->Brn_No) selected @endif>
                {{$brn->{'Brn_Nm'.ucfirst(session('lang'))} }}
            </option>
        @endforeach
    </select>
@else
    <select name="Dlv_Stor" id="Dlv_Stor" class="form-control">
        <option value="">{{trans('admin.nodata')}}</option>
    </select>
@endif