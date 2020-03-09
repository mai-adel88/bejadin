

        <strong>{{trans('admin.bus_number')}}</strong>: {{$bus->busnumber}}
        <br>
        <strong>{{trans('admin.structure_number')}}</strong>: {{$bus->structure_num}}

        <br>

        <strong>{{trans('admin.license_number')}}</strong>: {{$bus->license_num}}
        <br>
        <strong>{{trans('admin.Subscriber_In_Bus')}}</strong>:  <div class="badge">{{$books->count()}}</div>

        <br>
        @if(getdriver($driver) != null)
            <strong>{{trans('admin.driver')}}</strong>: {{session_lang(getdriver($driver)->name_en,getdriver($driver)->name_ar)}}

            <br>
            <strong>{{trans('admin.Driver_Number')}}</strong>: {{getdriver($driver)->phone}}

            <br>
        @endif
        <table class="table table-bordered table-striped table-hover">
            <tr>
                <th>#{{trans('admin.No')}}</th>
                <th>{{trans('admin.name')}}</th>
            </tr>
            <div class="hidden">{{$i = 1}}</div>
            @foreach ($books as $book)
                @if(getsubscriper($book->subscriper_id) != null)
                    <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ session_lang(getsubscriper($book->subscriper_id)->name_en,getsubscriper($book->subscriper_id)->name_ar) }}</td>
                    </tr>
                    @else
                    {{ null }}
                @endif
            @endforeach
        </table>
