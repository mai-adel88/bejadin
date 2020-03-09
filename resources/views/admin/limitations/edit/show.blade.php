@extends('admin.index')
@section('title',trans('admin.create_limitations'))
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
<script>
    $(function () {
        'use strict'
        $(".type").on("change",function(){
            event.preventDefault();
            var type = $(this).last().val();
            var limitations = '{{$limitations->id}}';
            var invoice = '{{$limitations->invoice_id}}';

            $.ajax({
                    url: '{{aurl('limitationsData/select')}}',
                    type:'post',
                    dataType:'html',
                    data:{_token: "{{ csrf_token() }}",type : type,limitations: limitations,invoice: invoice},
                    success: function (data) {
                        $('.column-account-date').html(data);
                    }
                });

            return false;
        });
    });
</script>

<script>
    $(function () {
        'use strict'


        $('#add_data').on('click', function() {

            event.preventDefault();
            var add = $('#add_data').data('clicked');
            var invoice = '{{$limitations->invoice_id}}';
            var note_debtor = $('.note_debtor').val();
            var tree = $(".tree :selected").val();
            var type = $('.type').val();
            var dbt = $(".dbt").val();
            var crd = $(".crd").val();
            var cc = $('.cc :selected').val();
            var month_for = $(".month_for").val();
            var limitations = '{{$limitations->limitationsType}}';
            $.ajax({
                url: '{{aurl('limitationsData/editdatatable')}}',
                type:'post',
                dataType:'html',
                cache: false,
                data:{_token: "{{ csrf_token() }}",cc: cc,type: type,add : add,invoice:invoice,note_debtor: note_debtor,tree: tree,limitations: limitations,dbt: dbt,crd: crd,month_for: month_for},
                success: function (data) {
                    $('.data-table').html(data);


                },
                complete: function (data) {
                    var creditor = $('.totel_credit').val();
                    var debtor = $('.totel_debtor').val();
                    if ((debtor - creditor) == 0){
                        $('.primaryButton').removeAttr("disabled");
                    }else{
                        $('.primaryButton').attr("disabled","disabled");
                    }

                }
            });
            return false;
        });
    });
</script>
<script>
    var creditor = $('.totel_credit').val();
    var debtor = $('.totel_debtor').val();
    if ((debtor - creditor) == 0){
        $('.primaryButton').removeAttr("disabled");
    }else{
        $('.primaryButton').attr("disabled","disabled");
    }
    $(function () {
        'use strict'

        $(".remove-record").on('click',function(){
            var id = $(this).attr('data-id');
            var invoice = $('.invoice').val();
            $.ajax({
                url: '{{aurl('limitationsData/delete')}}',
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
@endpush

<div class="box">
    @include('admin.layouts.message')
    <div class="box-header">
        <h3 class="box-title">{{$title}}</h3>
        <label style="float: left ;font-size:20px">رقم القيد {{$limitations->limitationId}}</label>
    </div>
    <div class="box-body">
{{--        {!! Form::model($limitations,['method'=>'put','route' => ['limitations.update',$limitations->id],'class'=>'loginForm']) !!}--}}
{{--        --}}{{--<div class="hidden">--}}
{{--        {{ Form::hidden('invoice', $limitations->invoice_id,['class'=>'invoice']) }}--}}
        <div class="row text-center">
            <div class="col-md-3">
                <strong>{{trans('admin.branche')}} </strong>: {{session_lang(App\Branches::where('id',$limitations->branche_id)->first()->name_en,App\Branches::where('id',$limitations->branche_id)->first()->name_ar)}}
            </div>
            <div class="col-md-3">
                <strong>{{trans('admin.date')}} </strong>: {{date('Y-m-d',strtotime($limitations->created_at))}}
            </div>
            <div class="col-md-3">
                <strong>{{trans('admin.date_hijri')}} </strong>: {{date('Y-m-d',strtotime($limitations->date))}}
            </div>
            <div class="col-md-3">
                <strong>{{trans('admin.limitation')}} </strong>: {{\App\Enums\dataLinks\LimitationsType::getDescription($limitations->limitationReceipts->limitationReceiptsId)}}
            </div>
        </div>
        <br>
        <limitations-editcomponent :invoice="{{$limitations->invoice_id}}" :id="{{$limitations->id}}" :branchesid="{{$limitations->branche_id}}" created_at="{!! date('Y-m-d',strtotime($limitations->created_at)) !!}" date="{{date('Y-m-d',strtotime($limitations->date))}}" :limitationsnumber="{{$limitations->limitationId}}"></limitations-editcomponent>

        <br>


    </div>
</div>
@endsection
