@if($project_child)
    <option>{{trans('admin.select')}}</option>
    @foreach($project_child as $child)
        <option value={{$child->Prj_No}}>{{$child->Prj_NmAr}}</option>
    @endforeach
@endif
