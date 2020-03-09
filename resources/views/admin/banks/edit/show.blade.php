@extends('admin.index')
@section('title',trans('admin.edit_receipts'))
@section('content')
@push('css')
<style>
    @if(session('lang') == 'ar')
        .datepicker{
        direction: rtl;
    }
    @endif
</style>
@endpush
@push('js')
<script>

    $(function () {
        'use strict'
        $('.creditor').val($('.totel_credit').val());
    });

</script>
<script>
    function validatePassword() {
        var validator = $(".loginForm").validate({
            rules: {
                debtor: "required",
                creditor: {
                    equalTo: ".debtor"
                }
            },
            messages: {
                debtor: " أدخل حركة مدين",
                creditor: " أدخل حركة دائن"
            }
        });
    }



</script>
<script>
    $(function () {
        'use strict'

        $(".remove-record").click(function(){
            var id = $(this).attr('data-id');
            var invoice = $('.invoice').val();
            var type = '{{$receipts->receiptsType}}';
            console.log(id);
            $.ajax({
                url: '{{aurl('receiptsData/delete')}}',
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
<script>
    $(function () {
        'use strict'

        $(".type").on("change",function(){
            event.preventDefault();
            var type = $(this).last().val();
            var receipts_id = '{{$receipts->id}}';
            var invoice = $('.invoice').val();
            if (this){
                $.ajax({
                    url: '{{aurl('receiptsData/select')}}',
                    type:'post',
                    dataType:'html',
                    data:{_token: "{{ csrf_token() }}",type : type,invoice: invoice,receipts_id: receipts_id},
                    success: function (data) {
                        $('.column-account-date').html(data);

                    }
                });
            }else{
                $('.column-account-date').html('');
            }
        });


    });
</script>

<script>

    $(function () {
        'use strict'
        $('#add_data').click(function(){
            $(this).data('clicked', true);
        });
        $('#add_data').on('click',function () {

            var add = $('#add_data').data('clicked');
            var invoice = $('.invoice').val();
            var note_credit = $('.note_credit').val();
            var type = $('.type').val();
            var percentage = $('.tax').val();
            var tree = $(".tree :selected").val();
            var cc = $('.cc :selected').val();
            var total = $('.tot-qty').text();
            var receipts = '{{$receipts->receiptsType_id}}';
            $.ajax({
                url: '{{aurl('receiptsData/editdatatable')}}',
                type:'post',
                dataType:'html',
                data:{_token: "{{ csrf_token() }}",cc: cc,percentage: percentage,type: type,add : add,invoice:invoice,note_credit: note_credit,total: total,tree: tree,receipts: receipts},
                success: function (data) {
                    $('.data-table').html(data);
                    $('.primaryButton').removeAttr("disabled");
                }
            });
        });
    });
</script>
<script>
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
@endpush

<div class="box">
    @include('admin.layouts.message')
    <div class="box-header">
        <h3 class="box-title">{{$title}}</h3>
        <label style="float: left ;font-size:20px">رقم السند {{$receipts->receiptId}}</label>
    </div>
    <div class="box-body">
        <div class="row text-center">
            <div class="col-md-3">
                <strong>{{trans('admin.branche')}} </strong>: {{session_lang(App\Branches::where('id',$receipts->branche_id)->first()->name_en,App\Branches::where('id',$receipts->branche_id)->first()->name_ar)}}
            </div>
            <div class="col-md-3">
                <strong>{{trans('admin.date')}} </strong>: {{date('Y-m-d',strtotime($receipts->created_at))}}
            </div>
            <div class="col-md-3">
                <strong>{{trans('admin.date_hijri')}} </strong>: {{date('Y-m-d',strtotime($receipts->date))}}
            </div>
            <div class="col-md-3">
                <strong>{{trans('admin.receipt')}} </strong>: {{session_lang($receipts->limitationReceipts->name_en,$receipts->limitationReceipts->name_ar)}}
            </div>
        </div>
        <br>
        <receipts-editcomponent :receiptstype="{{$receipts->limitationReceipts->id}}" :invoice="{{$receipts->invoice_id}}" :id="{{$receipts->id}}" :branchesid="{{$receipts->branche_id}}" created_at="{!! date('Y-m-d',strtotime($receipts->created_at)) !!}" date="{{date('Y-m-d',strtotime($receipts->date))}}" :limitationsnumber="{{$receipts->receiptId}}"></receipts-editcomponent>
    </div>
</div>
@endsection