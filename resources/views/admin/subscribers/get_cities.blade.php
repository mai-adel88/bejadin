@if($cities)
    <option>اختر</option>
    @foreach($cities as $city)
        <option value="{{$city->id}}">{{$city->{'city_name_'.session('lang')} }}</option>
     @endforeach
@endif
