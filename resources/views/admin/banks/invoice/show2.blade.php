@extends('admin.index')
@section('title',trans('admin.invoices'))
@section('content')

    @push('js')

        <script>


            function printPageArea(areaID){
                var divElements = document.getElementById('invoice').innerHTML;
                //Get the HTML of whole page
                var oldPage = document.body.innerHTML;

                //Reset the page's HTML with div's HTML only
                document.body.innerHTML =
                    "<html><head><title></title></head><body>" +
                    divElements + "</body>";

                //Print Page
                window.print();
                window.location.reload(true);
                //Restore orignal HTML
                document.body.innerHTML = oldPage;
            }
            $(function () {
                'use strict'
                $('#print').click(function(){
                    $("#primaryButton").click();
                });

            });


        </script>

    @endpush
    @push('css')
        <style>
            @media print{
                body{overflow: hidden}
            }
        </style>

    @endpush
    @include('admin.layouts.message')
    <div id="invoice">
        <section class="invoice">
            <h2 class="title text-center">
                {{\App\Enums\dataLinks\ReceiptType::getDescription($receipts->limitationReceipts->limitationReceiptsId)}}
            </h2>
            <!-- title row -->
            <input type="hidden" value="{{$receipts->id}}" id="input-id">
            <div class="row">
                <div class="col-xs-12">
                    <h2 class="page-header">
                        <i class="fa fa-globe"></i>  {{trans('admin.Inc')}} @if(session('lang') == 'en') ,  @endif  {{setting()->sitename_ar}} {{ session_lang(\App\Branches::where('id',$receipts->branche_id)->first()->name_en,\App\Branches::where('id',$receipts->branche_id)->first()->name_ar) }} .
                        <small class="pull-right date-in-invoices">{{trans('admin.date')}}: {{date('Y-m-d',strtotime($receipts->created_at))}}</small>
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
                            <strong>{{session_lang(\App\Department::where('id',$receiptsData->tree_id)->first()->dep_name_en,\App\Department::where('id',$receiptsData->tree_id)->first()->dep_name_ar)}}</strong><br>
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
                    <br>
                    @if($receipts->limitationReceipts->limitationReceiptsId == 3)
                        <b>{{trans('admin.check_number')}} {{$receiptsData->check}}</b><br>
                        <b>{{trans('admin.person_received')}} </b>{{$receiptsData->person}}<br>
                        <b>{{trans('admin.person_taken')}} </b>{{$receiptsData->taken}}<br>
                    @endif

                    <b>{{trans('admin.Payment_date')}}:</b>{{date('Y-m-d',strtotime($receipts->created_at))}}<br>
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
                                    <td>@if($d->debtor != 0) {{round($d->debtor)}} @else 0 @endif</td>
                                    <td>@if($d->creditor != 0) {{round($d->creditor)}} @else 0 @endif</td>
                                    <td>{{$d->note}}</td>
                                    <td>{{round(($d->debtor + $d->creditor) - $d->tax)}}</td>
                                    <td>@if($d->tax != null) {{round($d->tax)}} @endif</td>
                                    <td>{{round($d->debtor + $d->creditor)}} </td>
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
                                <td>{{round($data->sum('debtor') + $data->sum('creditor'))}}</td>
                            </tr>
                            <tr>
                                <th>{{trans('admin.payment')}}:</th>
                                <td>{{round($receiptsData->creditor)}}</td>
                            </tr>
                            <tr>
                                <th>{{trans('admin.subtract')}}:</th>
                                <td>{{round(($data->sum('debtor') + $data->sum('creditor')) - $receiptsData->creditor)}}</td>
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
                <li>
                    {{--<a href="#" class="btn btn-default" onclick="printPageArea()" id="primaryButton" style="display: none;"><i class="fa fa-print"></i> {{trans('admin.print')}}</a>--}}
                    {{--<a href="#" class="btn btn-default" id="print"><i class="fa fa-print"></i> {{trans('admin.print')}}</a>--}}
                    {!! Form::open(array('url' => 'admin/banks/Receipt/receipts/print/' . $receipts->id, 'method' => 'POST', 'target' => '_blank')) !!}
                    {{Form::hidden('invoice_id',$receipts->invoice_id)}}
                    {{ Form::submit(trans('admin.Print_PDF'), array('class' => 'btn btn-primary', 'style' => 'margin-right: 10px;')) }}

                    {!! Form::close() !!}
                </li>
            </ul>
        </div>
    </div>








@endsection
