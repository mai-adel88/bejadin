
<script>

    $(function () {
        'use strict';
        $('.creditor').val($('.totel_credit').val());
    });

</script>
<script>
    $(function () {
        'use strict';
        $('.e2').select2({
            placeholder: "{{trans('admin.select')}}",
            dir: '{{direction()}}'
        });
    });
    $(function () {
        'use strict';
        $('#add_data').click(function(){
            $(this).data('clicked', true);
        });
        $('#add_data').on('click',function () {
            $("#loadingmessage-3").css("display","block");
            $(".data-table").css("display","none");
            var add = $('#add_data').data('clicked');
            var invoice = $('.invoice').val();
            var note_credit = $('.note_credit').val();
            var type = $('.type').val();
            var percentage = $('.tax').val();
            var discount = $('.discount').val();
            var tree = $(".tree :selected").val();
            var total = $('.tot-qty').text();
            var cc = $('.cc :selected').val();
            var operation = '{{$operation->id}}';
            var receipts = '{{$receipts}}';
                $.ajax({
                    url: '{{aurl('receiptsData/create')}}',
                    type:'get',
                    dataType:'html',
                    data:{cc: cc,percentage: percentage,discount: discount,type: type,add : add,invoice:invoice,note_credit: note_credit,total: total,operation: operation,tree: tree,receipts: receipts},
                    success: function (data) {
                        $("#loadingmessage-3").css("display","none");
                        $('.data-table').css("display","table").html(data);
                        $('.primaryButton').removeAttr("disabled");
                    }
                });
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
        function discountPrice() {
            var percentage = $('input[name=\'discount\']').val(),
                price = $('input[name=\'price\']').val(),
                calcPrice = (price - ( (price/100) * percentage )),
                discountPrice = calcPrice.toFixed(2);
            if (percentage == null){
                $('.tot-qty').text(price);
                $('.total-value').val(price);
            }else{
                var discount = parseInt(discountPrice);
                $('.tot-qty').text(discount);
                $('.total-value').val(discount);
            }

        }
    $('input[name=\'discount\']').keyup(function(){
        if($('input[name=\'discount\']').val().length != 0){
            $('input[name=\'percentage\']').attr('disabled','disabled');
        }else{
            $('input[name=\'percentage\']').removeAttr('disabled');
        }
    });
    $('input[name=\'percentage\']').keyup(function(){
        if($('input[name=\'percentage\']').val().length != 0){
            $('input[name=\'discount\']').attr('disabled','disabled');
        }else{
            $('input[name=\'discount\']').removeAttr('disabled');
        }
    });

        function calculatedept() {
            var creditor = $('input[name=\'creditor\']').val(),
                debtor = $('input[name=\'debtor\']').val(),
                minus = debtor - creditor;
                $('#subtract').text(minus);

        }
    $(function () {
        'use strict';
        $('.note_credit').keyup(function () {
            $('.note_debt').val($('.note_credit').val());
        });
    });
    $(function () {
        'use strict'

        $(".tree").on("change",function(){
            event.preventDefault();
            var tree = $('.tree :selected').val();
            var type = $('.type :selected').val();
            if (type == 4) {
                if (this) {
                    $.ajax({
                        url: '{{aurl('banks/Receipt/cc')}}',
                        type: 'get',
                        dataType: 'html',
                        data: {tree: tree},
                        success: function (data) {
                            $('.column-account-cc').html(data);

                        }
                    });
                } else {
                    $('.column-account-cc').html('');
                }
            }
        });


    });
</script>
<div class="form-group row">
<div class="col-md-12">
    {{ Form::label('tree', session_lang($operation->name_en,$operation->name_ar), ['class' => 'control-label']) }}
    {{ Form::select('tree',$tree,null, array_merge(['class' => 'form-control e2 tree','placeholder'=> trans('admin.select') ])) }}
</div>
<div class="column-account-cc">

</div>
</div>
<div class="form-group row">
    <div class="col-md-3">
        {{ Form::label('price', trans('admin.amount'), ['class' => 'control-label']) }}
        <input type="text" name="price" onkeyup="calculatePrice()" class="form-control price" required="required">
    </div>
    <div class="col-md-3">
        {{ Form::label('tax', trans('admin.tax_added'), ['class' => 'control-label']) }}
        <input type="text" name="percentage" onkeyup="calculatePrice()" class="form-control tax">
    </div>
    <div class="col-md-3">
        {{ Form::label('tax', trans('admin.tax_deductible'), ['class' => 'control-label']) }}
        <input type="text" name="discount" onkeyup="discountPrice()" class="form-control discount">
    </div>
    <div class="col-md-3">
        {{ Form::label('payment', trans('admin.Total'), ['class' => 'control-label']) }}
        <div class="tot-qty">0</div> {{trans('admin.EGP')}}
    </div>
</div>
<div class="form-group">
    {{ Form::label('note_credit', trans('admin.note_for'), ['class' => 'control-label']) }}
    {{ Form::text('note_credit',null, array_merge(['class' => 'form-control note_credit' ])) }}
</div>
{{--loader spinner--}}
<div id='loadingmessage-3' style='display:none; margin-top: 20px' class="text-center">
    <img src="{{ url('/') }}/images/ajax-loader.gif"/>
</div>

{{--add in here table--}}
<table class="table table-bordered table-striped table-hover data-table">
    <thead>
    <tr>
        <th>{{trans('admin.account_name')}}</th>
        <th>{{trans('admin.motion_debtor')}}</th>
        <th>{{trans('admin.motion_creditor')}}</th>
        <th>{{trans('admin.note_for')}}</th>
        <th>{{trans('admin.single_cc')}}</th>
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
            <td>@if($d->glcc){{session_lang($d->glcc->name_en,$d->glcc->name_ar)}}@endif</td>
        </tr>
    @endforeach
    @if($receipts == 0 || $receipts == 1)
        <tr>
            <td colspan="2"><strong>{{trans('admin.total_motion_creditor')}}</strong></td>
            <td colspan="4"><strong>{{$data->sum('creditor')}} {{trans('admin.EGP')}}</strong></td>
            <input type="hidden" value="{{$data->sum('creditor')}}" class="totel_credit" name="total">
        </tr>
    @else
        <tr>
            <td colspan="1"><strong>{{trans('admin.total_motion_debtor')}}</strong></td>
            <td colspan="5"><strong>{{$data->sum('debtor')}} {{trans('admin.EGP')}}</strong></td>
            <input type="hidden" value="{{$data->sum('debtor')}}" class="totel_credit" name="total">
        </tr>
        @endif
        </tbody>
</table>
<a href="javascript:void(0);" class="btn btn-primary" id="add_data"><i class="fa fa-plus"></i> {{trans('admin.add')}}</a>
<br>
<br>
<div class="form-group">
    {{ Form::label('fundsBanks', trans('admin.dept_account'), ['class' => 'control-label']) }}
    <select name="fundsBanks" class="form-control e2" placeholder="{{trans('admin.select')}}">
        <option></option>
        @foreach ($fundsBanks as $fundsBank)
            <option value="{{$fundsBank->id}}">{{session_lang($fundsBank->dep_name_en,$fundsBank->dep_name_ar)}} ({{session_lang($fundsBank->operations->name_en,$fundsBank->operations->name_ar)}})</option>
        @endforeach
    </select>
</div>
<div class="form-group row">
    <div class="col-md-4">
        {{ Form::label('debtor', trans('admin.debtor'), ['class' => 'control-label debtor']) }}
        <input type="text" name="debtor" onkeyup="calculatedept()" class="form-control creditor" value="{{$data->sum('creditor')}}">
    </div>
    <div class="col-md-4">
        {{ Form::label('creditor', trans('admin.creditor'), ['class' => 'control-label']) }}
        <input type="text" name="creditor" onkeyup="calculatedept()" class="form-control creditor" disabled="disabled" value="{{$data->sum('debtor')}}">
    </div>
    <div class="col-md-4">
        {{ Form::label('subtract', trans('admin.subtract'), ['class' => 'control-label']) }}
        <div id="subtract">0</div> {{trans('admin.EGP')}}
    </div>
</div>
<div class="form-group">
    {{ Form::label('note_debtor', trans('admin.note_for'), ['class' => 'control-label']) }}
    {{ Form::text('note_debtor',null, array_merge(['class' => 'form-control note_debt' ])) }}
</div>