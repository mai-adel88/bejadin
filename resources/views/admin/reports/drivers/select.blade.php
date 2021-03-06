
@if($hasTask)
    <br>

    {{trans('admin.Travel_Count')}} : <div class="badge bg-green">{{$transportcount}}</div>
    <br>
    <br>
    <strong>{{trans('admin.Buses_Details')}}:</strong>
<div class="table-responsive">
    <table class="table table-bordered table-striped table-hover">
        <tr>
            <th>{{trans('admin.date')}}</th>
            <th>{{trans('admin.bus_number')}}</th>
            <th>{{trans('admin.type')}}</th>
            <th>{{trans('admin.seats_number')}}</th>
            <th>{{trans('admin.License_Number')}}</th>
            <th>{{trans('admin.depart')}}</th>
            <th>{{trans('admin.desname')}}</th>
            <th>{{trans('admin.Schedule')}}</th>
        </tr>
        @foreach($transports as $transport)
        <tr>
            <td>{{$transport->date}}</td>
            @if(getbus($transport->bus_id) != null)
            <td>{{getbus($transport->bus_id)->busnumber}}</td>
            <td>{{\App\Enums\WorkType::getDescription(getbus($transport->bus_id)->type)}}</td>
            <td>{{getbus($transport->bus_id)->seats_num}}</td>
            <td>{{getbus($transport->bus_id)->license_num}}</td>
            @endif
            <td>{{session_lang(state($transport->depart_id)->state_name_en,state($transport->depart_id)->state_name_ar)}}</td>
            <td>{{session_lang(state($transport->desname_id)->state_name_en,state($transport->desname_id)->state_name_ar)}}</td>
            <td><div class="badge">{{date('h:i A', strtotime(getschedule($transport->schedule_id)->schedule_time))}}</div>  <div class="badge">{{\App\Enums\ScheduleType::getDescription(getschedule($transport->schedule_id)->type)}}</div> </td>

        </tr>
        @endforeach
    </table>
</div>
<br>
{{--$hasTask else--}}
@else
    <br>
    <div class="alert alert-danger">{{trans('admin.there_is_no_travel_between_this_date')}}</div>
    {{--hascheck endif--}}
@endif

