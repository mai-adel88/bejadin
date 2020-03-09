@if($status == 1)
    {{trans('admin.active')}}
    @else
    {{trans('admin.deactive')}}
@endif