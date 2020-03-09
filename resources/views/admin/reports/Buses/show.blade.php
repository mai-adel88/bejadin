<div class="container">
    <div class="row">
        <div class="col-md-6">
            <strong>{{trans('admin.bus_number')}}</strong>: {{$bus->busnumber}}
        </div>
        <div class="col-md-6">
            <strong>{{trans('admin.structure_number')}}</strong>: {{$bus->structure_num}}
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-6">
            <strong>{{trans('admin.license_number')}}</strong>: {{$bus->license_num}}
        </div>
        <div class="col-md-6">
            <strong>{{trans('admin.Subscriber_In_Bus')}}</strong>:  <div class="badge">{{$books->count()}}</div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-6">
            <strong>{{trans('admin.driver')}}</strong>: {{session_lang(getdriver($driver)->name_en,getdriver($driver)->name_ar)}}
        </div>
        <div class="col-md-6">
            <strong>{{trans('admin.Driver_Number')}}</strong>: {{getdriver($driver)->phone}}
        </div>
    </div>
</div>
<br>
<table class="table table-bordered table-striped table-hover">
    <tr>
        <th>#{{trans('admin.No')}}</th>
        <th>{{trans('admin.name')}}</th>
        <th>#{{trans('admin.No')}}</th>
        <th>{{trans('admin.name')}}</th>
        <th>#{{trans('admin.No')}}</th>
        <th>{{trans('admin.name')}}</th>
        <th>#{{trans('admin.No')}}</th>
        <th>{{trans('admin.name')}}</th>
    </tr>
    @foreach ($books->chunk(4) as $chunk)
        <div class="hidden">{{$i = 1}}</div>
        <tr>
            @foreach ($chunk as $book)
                @if(getsubscriper($book->subscriper_id) != null)
                <td>{{ $i++ }}</td>
                <td>{{ session_lang(getsubscriper($book->subscriper_id)->name_en,getsubscriper($book->subscriper_id)->name_ar) }}</td>
                @else
                    {{ null }}
                @endif
            @endforeach
        </tr>
    @endforeach
</table>