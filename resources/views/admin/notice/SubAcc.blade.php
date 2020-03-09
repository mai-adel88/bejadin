<option value="{{null}}">{{trans('admin.select')}}</option>
@if(count($subAccs) > 0)
    @foreach($subAccs as $sub)
        <option value="{{$sub->no}}">{{$sub->name}}</option>
    @endforeach
@else
    <option value="{{null}}">{{trans('admin.nodata')}}</option>
@endif
