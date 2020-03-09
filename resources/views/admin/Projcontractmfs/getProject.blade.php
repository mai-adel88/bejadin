@if($projects)
<select id="projects" name="Prj_No">
    <option>اختر المشروع</option>
    @foreach($projects as $pro)
        <option class="form-control" value="{{$pro->ID_No}}">{{$pro->Prj_NmAr}}</option>
    @endforeach
</select>
@endif
