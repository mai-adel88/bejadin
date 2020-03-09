
    <select class="form-control e2 MainBranch col-md-9">
        <option  value="-1"> {{trans('admin.select')}}</option>
        @foreach($MainBranch as $one)

            <option value="{{$one->Brn_No}}">{{$one->{'Brn_Nm'.ucfirst(session('lang'))} }}
            </option>
        @endforeach

    </select>



