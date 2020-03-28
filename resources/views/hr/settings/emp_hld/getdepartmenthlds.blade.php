@if($departments)
    @foreach($departments as $dep)
        <input type="text" value="{{$dep->department->{'Depm_Nm'.ucfirst(session('lang'))} }}">
    @endforeach
@endif
