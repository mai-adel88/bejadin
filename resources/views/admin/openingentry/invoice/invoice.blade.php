@extends('admin.index')
@section('title',trans('admin.invoices'))
@section('content')

@push('js')

    <script>


        $(function () {
            'use strict'
            $('#print .btn').click(function(){
                $('#save').click();
                $('#save').addClass('clicked');
                $(this).parent('#print').css({display:'none'});
                $('.btn-danger').css({display:'none'});
                $('#save').css({display:'none'});
                $('#saveprint').css({display:'block'});
            });
            $('#save').click(function(){
                $(this).data('clicked', true);
                $('.overlay').css({display:'block'});
            });
            $(document).on('click','#save:not(.clicked)',function () {

                var print = $('#save').data('clicked');
                var id = '{{$limitation->id}}';
                var invoice = '{{$limitation->invoice_id}}';
                if($('#save').data('clicked')) {
                    $.ajax({
                        url: '{{aurl('openingentrydata/invoice/invoice')}}',
                        type:'get',
                        dataType:'html',
                        data:{print : print,id: id,invoice: invoice},
                        success: function (data) {
                            $('.column-form').html(data);
                            location.reload();
                        }
                    });
                }else{
                    $('.column-form').html('');
                }
            });

        });


    </script>

@endpush
@push('css')
    <style>
        @media print{
            body{overflow: hidden}
        }
        .overlay{
            position: absolute;
            z-index: 999;
            width: 100%;
            height: 100vh;
            background: #fff;
            opacity: 0.4;
            display: none;
        }
        .overlay img{
            display: block;
            margin: 0 auto;
            position: absolute;
            top: 50%;
            right: 50%;
            transform: translate(-50%,-50%);
        }
        .overlay span{
            display: block;
            text-align: center;
            position: absolute;
            transform: translate(-50%,-50%);
            top: 60%;
            right: 30%;
            font-size: 20px;
        }
    </style>

    @endpush
    @include('admin.layouts.message')
<div id="invoice">
    <section class="invoice">
        <h2 class="title text-center">
            {{session_lang($limitationReceipts->name_en,$limitationReceipts->name_ar)}}
        </h2>
        <!-- title row -->
        <input type="hidden" value="{{$limitation->id}}" id="input-id">
        <div class="row">
            <div class="col-xs-12">
                <h2 class="page-header">
                    <i class="fa fa-globe"></i>  {{trans('admin.Inc')}} @if(session('lang') == 'en') ,  @endif  {{setting()->sitename_ar}} {{ session_lang(\App\Branches::where('id',$limitation->branche_id)->first()->name_en,\App\Branches::where('id',$limitation->branche_id)->first()->name_ar) }} .

                    <small class="date-in-invoices">{{trans('admin.date')}}: {{$limitation->date}}</small><br>
                    <small><strong>{{trans('admin.limitation_num')}}</strong> {{$limitation->limitationId}}</small>
                    <small><strong>{{trans('admin.invoice')}}</strong> #{{$limitation->invoice_id}}</small><br>
                </h2>
            </div>
            <!-- /.col -->
        </div>
        <!-- info row -->
        <div class="row invoice-info">

            <!-- /.col -->


            <div class="table-responsive">
                <table class="table">

                    <thead>
                    <tr>
                        <th>{{trans('admin.account_name')}}</th>
                        <th>{{trans('admin.motion_debtor')}}</th>
                        <th>{{trans('admin.motion_creditor')}}</th>
                        <th>{{trans('admin.note_for')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $d)
                        <tr>
                            <td>{{session_lang($d->name_en,$d->name_ar)}}</td>
                            <td>@if($d->debtor != 0) {{$d->debtor}} {{trans('admin.EGP')}} @else 0 {{trans('admin.EGP')}} @endif</td>
                            <td>@if($d->creditor != 0) {{$d->creditor}} {{trans('admin.EGP')}} @else 0 {{trans('admin.EGP')}} @endif</td>
                            <td>{{$d->note}}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="1"><strong>{{trans('admin.total_motion_debtor')}}</strong></td>
                        <td>{{$data->sum('debtor')}} {{trans('admin.EGP')}}</td>
                    </tr>
                    <tr>
                        <td colspan="2"><strong>{{trans('admin.total_motion_creditor')}}</strong></td>
                        <td>{{$data->sum('creditor')}} {{trans('admin.EGP')}}</td>
                    </tr>
                    </tbody>

                </table>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- /.row -->
        <br>
        <br>

        <!-- /.row -->
    </section>
</div>

<div class="row no-print" style="margin: 10px 25px">
    <div class="col-xs-12">
        <ul class="list-inline">
            {{--edit by Ibrahim El Monier--}}
            <li class="column-form">
                {{--<button type="button" class="btn btn-success" id="save"><i class="fa fa-check-circle"></i>حفظ الفاتورة </button>--}}
                <a href="#" class="btn btn-success" id="primaryButton" style="display: none;"><i class="fa fa-check-circle"></i>   حفظ القاتورة</a>
                <a href="#" class="btn btn-success" id="save"><i class="fa fa-check-circle"></i> حفظ الفاتورة </a>
            </li>
            {{--end edit by Ibrahim Elmonier--}}
            <li>
                {{--<a href="#" class="btn btn-default" onclick="printPageArea()" id="primaryButton" style="display: none;"><i class="fa fa-print"></i> {{trans('admin.print')}}</a>--}}
                {{--<a href="#" class="btn btn-default" id="print"><i class="fa fa-print"></i> {{trans('admin.print')}}</a>--}}
                {!! Form::open(array('url' => 'admin/openingentrydata/invoice/pdf/' . $limitation->id, 'method' => 'POST', 'target' => '_blank', 'id' => 'print')) !!}

                {{Form::hidden('invoice_id',$limitation->invoice_id)}}

                {{ Form::submit(trans('admin.Print_PDF'), array('class' => 'btn btn-success')) }}

                {!! Form::close() !!}
            </li>
            <li class="column-form">
                <button type="button" class="btn btn-danger"  data-toggle="modal" data-target="#myModal"><i class="fa fa-credit-card"></i> {{trans('admin.Remove_This_Cart')}}</button>
            </li>
            <li>
                {!! Form::open(array('url' => 'admin/openingentrydata/invoice/print/' . $limitation->id, 'method' => 'POST', 'target' => '_blank','style'=>'display:none', 'id' => 'saveprint')) !!}

                {{Form::hidden('invoice_id',$limitation->invoice_id)}}

                {{ Form::submit(trans('admin.Print_PDF'), array('class' => 'btn btn-success')) }}

                {!! Form::close() !!}
            </li>
        </ul>
    </div>
</div>



<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">{{trans('admin.delete')}}</h4>
            </div>
            {!! Form::open(['method' => 'DELETE', 'route' => ['limitations.destroy',$limitation->id],'id'=>'modal-delete']) !!}
            <div class="modal-body">
                <p>Some text in the modal.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('admin.close')}}</button>
                {!! Form::submit(trans('admin.delete'), ['type' => 'submit', 'class' => 'btn btn-danger']) !!}
            </div>
            {!! Form::close() !!}
        </div>

    </div>
</div>




@endsection
<div class="overlay">
    <img src="{{ url('/') }}/images/ajax-loader.gif"/>
    <span>من فضلك أنتظر قليلا جاري حفظ البيانات</span>
</div>