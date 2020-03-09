
<script>

    $(document).ready(function() {
        $('#example').DataTable();
    } );

</script>
    <table id="example" class="table table-striped display" style="width:100%">
        <thead>
        <tr>
            <th>{{trans('admin.id')}}</th>
            <th>{{trans('admin.Tr_No')}}</th>
            <th>{{trans('admin.noti_type')}}</th>
            <th>{{trans('admin.noti_date')}}</th>
            <th>{{trans('admin.note_for')}}</th>

            <th>{{trans('admin.View')}}</th>
            <th>{{trans('admin.print')}}</th>
            <th>{{trans('admin.edit')}}</th>
            <th>{{trans('admin.delete')}}</th>
        </tr>
        </thead>
        <tbody>
        @if(count($gls) > 0)
            @foreach($gls as $gl)
                <tr>
                    <td>{{$loop->iteration}}</td>


                    <td>{{$gl->Tr_No}}</td>
                    <td>
                        {{$gl->Jr_Ty}}
                    </td>
                    <td>{{$gl->Entr_Dt}}</td>
                    <td>{{$gl->Acc_Nm}}</td>


                    <td>
                        <a href="{{route('notice.show', $gl->Tr_No)}}" class="btn btn-info"><i class="fa fa-eye"></i></a>
                    </td>
                    <td>
                        <a href="../../receipts/print/{{$gl->Tr_No}}" class="btn btn-info"><i class="fa fa-print"></i></a>
                    </td>
                    <td>
                        <a href="{{route('notice.edit', $gl->Tr_No)}}" class="btn btn-success"><i class="fa fa-edit"></i></a>
                    </td>
                    <td>
                        <form action="{{route('notice.destroy', $gl->Tr_No)}}" method="POST">
                            {{csrf_field()}}
                            {{method_field('DELETE')}}
                            <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
