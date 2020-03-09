@extends('admin.index')
@section('title',trans('admin.invoices'))
@section('content')

    @push('js')

        <script>



            $(function () {
                'use strict'
                $('#print .btn').click(function(){
                    $(this).parent('#print').css({display:'none'});
                    $('#saveprint').css({display:'block'});
                });
                $('#save').click(function(){
                    $(this).data('clicked', true);
                    $('.overlay').css({display:'block'});
                });
                $(document).on('click','#save',function () {

                    var print = $('#save').data('clicked');
                    var id = '{{$receipts->id}}';
                    console.log(id);
                    if($('#save').data('clicked')) {
                        $.ajax({
                            url: '{{aurl('banks/Receipt/invoice/invoice')}}',
                            type:'get',
                            dataType:'html',
                            data:{print : print,id: id},
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
                {{\App\Enums\dataLinks\ReceiptType::getDescription($receiptsType)}}
            </h2>
            <!-- title row -->
            <input type="hidden" value="{{$receipts->id}}" id="input-id">
            <div class="row">
                <div class="col-xs-12">
                    <h2 class="page-header">
                        <i class="fa fa-globe"></i>  {{trans('admin.Inc')}} @if(session('lang') == 'en') ,  @endif  {{setting()->sitename_ar}} {{setting()->sitename_ar}} {{ session_lang(\App\Branches::where('id',$receipts->branche_id)->first()->name_en,\App\Branches::where('id',$receipts->branche_id)->first()->name_ar) }}.
                        <small class="pull-right date-in-invoices">{{trans('admin.date')}}: {{$receipts->date}}</small>
                    </h2>
                </div>
                <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info">

                <!-- /.col -->

                <div class="col-sm-4 invoice-col">
                    {{trans('admin.From')}}
                    <address>
                        <strong> {{session_lang(\App\Department::where('id',$receiptsData->tree_id)->first()->dep_name_en,\App\Department::where('id',$receiptsData->tree_id)->first()->dep_name_ar)}}</strong><br>
                    </address>
                </div>
                <div class="col-sm-4 invoice-col">
                    {{trans('admin.To')}}
                    <address>
                        @foreach($data as $d)
                            <li><strong>{{session_lang($d->name_en,$d->name_ar)}}</strong></li>
                        @endforeach
                    </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    <b>{{trans('admin.receipt_num')}} {{$receipts->receiptId}}</b><br>
                    <b>{{trans('admin.invoice')}} #{{$receipts->invoice_id}}</b><br>
                    <br>
                    @if($receiptsType == 1 || $receiptsType == 3)
                        <b>{{trans('admin.check_number')}} {{$receiptsData->check}}</b><br>
                        <b>{{trans('admin.person_received')}} </b>{{$receiptsData->person}}<br>
                        <b>{{trans('admin.person_taken')}} </b>{{$receiptsData->taken}}<br>
                    @endif
                    <b>{{trans('admin.Payment_date')}}:</b> {{$receipts->date}}<br>
                    <b>{{trans('admin.assigned_by')}}:</b> {{auth()->guard('admin')->user()->name}}
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- /.row -->
            <br>
            <br>
            <div class="row">
                <!-- accepted payments column -->
                <div class="col-xs-8">
                    <div class="table-responsive">
                        <table class="table">

                            <thead>
                            <tr>
                                <th>{{trans('admin.account_name')}}</th>
                                <th>{{trans('admin.motion_debtor')}}</th>
                                <th>{{trans('admin.motion_creditor')}}</th>
                                <th>{{trans('admin.note_for')}}</th>
                                <th>{{trans('admin.amount')}}</th>
                                <th>{{trans('admin.Add_or_subtract')}}</th>
                                <th>{{trans('admin.Total_motion')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $d)
                                <tr>
                                    <td>{{session_lang($d->name_en,$d->name_ar)}}</td>
                                    <td>@if($d->debtor != 0) {{round($d->debtor)}} {{trans('admin.EGP')}} @else 0 {{trans('admin.EGP')}} @endif</td>
                                    <td>@if($d->creditor != 0) {{round($d->creditor)}} {{trans('admin.EGP')}} @else 0 {{trans('admin.EGP')}} @endif</td>
                                    <td>{{$d->note}}</td>
                                    <td>{{round(($d->debtor + $d->creditor) - $d->tax)}} {{trans('admin.EGP')}}</td>
                                    <td>{{round($d->tax)}} {{trans('admin.EGP')}}</td>
                                    <td>{{round($d->debtor + $d->creditor)}} {{trans('admin.EGP')}} </td>
                                </tr>
                            @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-xs-4">

                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th>{{trans('admin.Total')}}:</th>
                                <td>{{round($data->sum('debtor') + $data->sum('creditor'))}} {{trans('admin.EGP')}}</td>
                            </tr>
                            <tr>
                                <th>{{trans('admin.payment')}}:</th>
                                <td>{{round($receiptsData->creditor)}} {{trans('admin.EGP')}}</td>
                            </tr>
                            <tr>
                                <th>{{trans('admin.subtract')}}:</th>
                                <td>{{round(($data->sum('debtor') + $data->sum('creditor')) - $receiptsData->creditor)}} {{trans('admin.EGP')}}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
    </div>


    <div class="row no-print" style="margin: 10px 25px">
        <div class="col-xs-12">
            <ul class="list-inline">
                {{--edit by Ibrahim El Monier--}}
                <li class="column-form">
                    {{--<button type="button" class="btn btn-success" id="save"><i class="fa fa-check-circle"></i>{{trans('admin.Save_the_invoice')}} </button>--}}
                    <a href="#" class="btn btn-success" id="primaryButton" style="display: none;"><i class="fa fa-check-circle"></i>   {{trans('admin.Save_the_invoice')}}</a>
                    <a href="#" class="btn btn-success" id="save"><i class="fa fa-check-circle"></i> {{trans('admin.Save_the_invoice')}} </a>
                </li>
                {{--end edit by Ibrahim Elmonier--}}
                <li>
                    {{--<a href="#" class="btn btn-default" onclick="printPageArea()" id="primaryButton" style="display: none;"><i class="fa fa-print"></i> {{trans('admin.print')}}</a>--}}
                    {{--<a href="#" class="btn btn-default" id="print"><i class="fa fa-print"></i> {{trans('admin.print')}}</a>--}}
                    {!! Form::open(array('url' => 'admin/banks/Receipt/receipts/pdf/' . $receipts->id, 'method' => 'POST', 'target' => '_blank', 'id' => 'print')) !!}

                    {{Form::hidden('invoice_id',$receipts->invoice_id)}}

                    {{ Form::submit(trans('admin.Print_PDF'), array('class' => 'btn btn-primary', 'style' => 'margin-right: 10px;')) }}

                    {!! Form::close() !!}
                </li>
                <li>
                    {!! Form::open(array('url' => 'admin/banks/Receipt/receipts/print/' . $receipts->id, 'method' => 'POST', 'target' => '_blank','style'=>'display:none', 'id' => 'saveprint')) !!}

                    {{Form::hidden('invoice_id',$receipts->invoice_id)}}

                    {{ Form::submit(trans('admin.Print_PDF'), array('class' => 'btn btn-primary', 'style' => 'margin-right: 10px;')) }}

                    {!! Form::close() !!}
                </li>
                <li class="column-form">
                    <button type="button" class="btn btn-danger"  data-toggle="modal" data-target="#myModal"><i class="fa fa-credit-card"></i> {{trans('admin.Remove_This_Cart')}}</button>
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
                {!! Form::open(['method' => 'DELETE', 'route' => ['receipts.destroy',$receipts->id],'id'=>'modal-delete']) !!}
                <div class="modal-body">
                    <p>Some text in the modal.</p>
                    <input type="hidden" value="{{$receipts->id}}" name="id">
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