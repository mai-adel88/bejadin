@if($projects)
    <option>{{trans('admin.select')}}</option>
    @foreach($projects as $project)
        <option value={{$project->Prj_No}}>{{$project->Prj_NmAr}}</option>
    @endforeach
@endif
