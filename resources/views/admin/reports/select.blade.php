
@if($hasTask)
    <br>

    {{trans('admin.Travel_Count')}} : <div class="badge">{{$bookcount}}</div>
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
            <th>{{trans('admin.driver')}}</th>
            <th>{{trans('admin.Driver_Number')}}</th>
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
            @if(getdriver($transport->driver_id) != null)
            <td>{{session_lang(getdriver($transport->driver_id)->name_en,getdriver($transport->driver_id)->name_ar)}}</td>
            <td>{{getdriver($transport->driver_id)->phone}}</td>
            @endif
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

