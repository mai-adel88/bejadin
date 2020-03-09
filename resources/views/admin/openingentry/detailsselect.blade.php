
<script>

    $(function () {
        'use strict'
        $('.creditor').val($('.totel_credit').val());
    });

</script>
<script>

    $(function () {
        'use strict'
        $('.e2').select2({
            placeholder: "{{trans('admin.select')}}",
            dir: '{{direction()}}'
        });
    });
    $(function () {
        'use strict'


            $('#add_data').on('click', function() {

            event.preventDefault();
            var add = $('#add_data').data('clicked');
            var invoice = $('.invoice').val();
            var note_debtor = $('.note_debtor').val();
            var tree = $(".tree :selected").val();
            var type = $('.type').val();
            var dbt = $(".dbt").val();
            var crd = $(".crd").val();
            var month_for = $(".month_for").val();
            var operation = '{{$operation->id}}';
            var limitations = '{{$limitations}}';
                $.ajax({
                    url: '{{aurl('openingentrydata/create')}}',
                    type:'post',
                    dataType:'html',
                    data:{_token: "{{ csrf_token() }}",type: type,add : add,invoice:invoice,note_debtor: note_debtor,operation: operation,tree: tree,limitations: limitations,dbt: dbt,crd: crd,month_for: month_for},
                    success: function (data) {
                        $('.data-table').html(data);
                    }
                });
            return false;
        });
    });

        function calculatePrice() {
            var percentage = $('input[name=\'percentage\']').val(),
                price = $('input[name=\'price\']').val(),
                calcPrice = ( (price/100) * percentage ),
                discountPrice = calcPrice.toFixed(2);
            if (percentage == null){
                $('.tot-qty').text(price);
                $('.total-value').val(price);
            }else{
                var sum = parseInt(price) + parseInt(discountPrice);
                $('.tot-qty').text(sum);
                $('.total-value').val(sum);
            }

        }
        function calculatedept() {
            var creditor = $('input[name=\'creditor\']').val(),
                debtor = $('input[name=\'debtor\']').val(),
                minus = debtor - creditor;
                $('#subtract').text(minus);
        }
    $(function () {
        'use strict'
        $('.note_credit').keyup(function () {
            $('.note_debt').val($('.note_credit').val());
        });
    });
</script>
<div class="form-group">
    {{ Form::label('tree', session_lang($operation->name_en,$operation->name_ar), ['class' => 'control-label']) }}
    {{ Form::select('tree',$tree,null, array_merge(['class' => 'form-control e2 tree','placeholder'=> trans('admin.select') ])) }}
</div>
<div class="form-group row">
    <div class="col-md-3">
        {{ Form::label('debtor', trans('admin.debtor'), ['class' => 'control-label']) }}
        <input type="text" name="dbt" class="form-control dbt" value="0" required>
    </div>
    <div class="col-md-3">
        {{ Form::label('creditor', trans('admin.creditor'), ['class' => 'control-label']) }}
        <input type="text" name="crd" class="form-control crd" value="0" required>
    </div>
    <div class="col-md-3">
        {{ Form::label('month_for', trans('admin.month_for'), ['class' => 'control-label']) }}
        {{ Form::select('month_for',\App\Enums\dataLinks\MonthType::toSelectArray(),null, array_merge(['class' => 'form-control month_for','placeholder'=> trans('admin.select')])) }}
    </div>
</div>
<div class="form-group">
    {{ Form::label('note_debtor', trans('admin.note_for'), ['class' => 'control-label']) }}
    {{ Form::text('note_debtor',null, array_merge(['class' => 'form-control note_debtor' ])) }}
</div>
{{--add in here table--}}
<table class="table table-bordered table-striped table-hover data-table">
    <thead>
    <tr>
        <th>{{trans('admin.account_name')}}</th>
        <th>{{trans('admin.motion_debtor')}}</th>
        <th>{{trans('admin.motion_creditor')}}</th>
        <th>{{trans('admin.note_for')}}</th>
        <th>{{trans('admin.month_for')}}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $d)
        <tr>
            <td>{{session_lang($d->name_en,$d->name_ar)}}</td>
            <td>{{$d->debtor}}</td>
            <td>{{$d->creditor}} {{trans('admin.EGP')}}</td>
            <td>{{$d->note}}</td>
            <td>{{\App\Enums\dataLinks\MonthType::getDescription($d->month_for)}}</td>
        </tr>
    @endforeach
    <tr>
        <td colspan="2"><strong>{{trans('admin.total_motion_creditor')}}</strong></td>
        <td colspan="3"><strong>{{$data->sum('creditor')}} {{trans('admin.EGP')}}</strong></td>
        <input type="hidden" value="{{$data->sum('creditor')}}" class="totel_credit">
    </tr>
    <tr>
        <td colspan="1"><strong>{{trans('admin.total_motion_debtor')}}</strong></td>
        <td colspan="4"><strong>{{$data->sum('debtor')}} {{trans('admin.EGP')}}</strong></td>
        <input type="hidden" value="{{$data->sum('debtor')}}" class="totel_debtor">
    </tr>
    </tbody>
</table>
<a href="javascript:void(0);" class="btn btn-primary" id="add_data"><i class="fa fa-plus" onclick="showNews()"></i> {{trans('admin.add')}}</a>
<br>
<br>
<div class="form-group row">
    <div class="col-md-4">
        {{ Form::label('debtor', trans('admin.debtor'), ['class' => 'control-label debtor']) }}
        <input type="text" onkeyup="calculatedept()" class="form-control debtor" disabled="disabled" value="{{$data->sum('debtor')}}">
        <input type="hidden" name="debtor" onkeyup="calculatedept()" class="form-control debtor" required value="{{$data->sum('debtor')}}">
    </div>
    <div class="col-md-4">
        {{ Form::label('creditor', trans('admin.creditor'), ['class' => 'control-label']) }}
        <input type="text" onkeyup="calculatedept()" class="form-control creditor" disabled="disabled" value="{{$data->sum('creditor')}}">
        <input type="hidden" name="creditor" onkeyup="calculatedept()" class="form-control creditor" required value="{{$data->sum('creditor')}}">
    </div>
    <div class="col-md-4">
        {{ Form::label('subtract', trans('admin.subtract'), ['class' => 'control-label']) }}
        <input type="hidden" class="price" name="price" value="0">
        <div id="subtract">0</div> {{trans('admin.EGP')}}
    </div>
</div>