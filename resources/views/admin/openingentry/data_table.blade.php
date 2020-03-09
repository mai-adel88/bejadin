
<thead>
    <tr>
        <th>{{trans('admin.account_name')}}</th>
        <th>{{trans('admin.motion_debtor')}}</th>
        <th>{{trans('admin.motion_creditor')}}</th>
        <th>{{trans('admin.note_for')}}</th>
        <th>{{trans('admin.month_for')}}</th>
        <th>{{trans('admin.delete')}}</th>
    </tr>
</thead>
<tbody>
@foreach($data as $d)
    <tr>
        <td>{{session_lang($d->name_en,$d->name_ar)}}</td>
        <td>@if($d->debtor != 0) {{$d->debtor}} {{trans('admin.EGP')}} @else 0 {{trans('admin.EGP')}} @endif</td>
        <td>@if($d->creditor != 0) {{$d->creditor}} {{trans('admin.EGP')}} @else 0 {{trans('admin.EGP')}} @endif</td>
        <td>{{$d->note}}</td>
        <td>{{\App\Enums\dataLinks\MonthType::getDescription($d->month_for)}}</td>
        <td><a class="btn btn-danger waves-effect waves-light remove-record" data-toggle="modal" data-id="{{$d->id}}"><i class="fa fa-trash"></i> {{trans('admin.delete')}}</a>
        </td>
    </tr>
@endforeach
    <tr>
        <td colspan="2"><strong>{{trans('admin.total_motion_creditor')}}</strong></td>
        <td colspan="4"><strong>{{$data->sum('creditor')}} {{trans('admin.EGP')}}</strong></td>
        <input type="hidden" value="{{$data->sum('creditor')}}" class="totel_credit">
    </tr>
    <tr>
        <td colspan="1"><strong>{{trans('admin.total_motion_debtor')}}</strong></td>
        <td colspan="5"><strong>{{$data->sum('debtor')}} {{trans('admin.EGP')}}</strong></td>
        <input type="hidden" value="{{$data->sum('debtor')}}" class="totel_debtor">
    </tr>
</tbody>
<script>

    $(function () {
        'use strict'
            $('.creditor').val($('.totel_credit').val());
            $('.debtor').val($('.totel_debtor').val());
            $('#subtract').text($('.totel_credit').val() - $('.totel_debtor').val());
    });

</script>
<script>
    $(function () {
        'use strict'

        $(".remove-record").click(function(){
            var id = $(this).attr('data-id');
            var invoice = $('.invoice').val();
            console.log(id);
            $.ajax({
                url: '{{aurl('limitationsData/softdelete')}}',
                type:'post',
                dataType:'html',
                data:{_token: "{{ csrf_token() }}",id : id,invoice: invoice},
                success: function (data) {
                    $('.data-table').html(data);

                }
            });
            return false;
        });
    });
</script>
