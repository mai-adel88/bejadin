@if($departments)
    <input type="text" value="{{$departments->{'Depm_Nm'.ucfirst(session('lang'))} }}">
@endif
