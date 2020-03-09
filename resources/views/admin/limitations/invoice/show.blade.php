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
                // window.history.back();
                // location.reload();
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
                {{\App\Enums\dataLinks\LimitationsType::getDescription($limitations->limitationReceipts->limitationReceiptsId)}}
            </h2>
            <!-- title row -->
            <input type="hidden" value="{{$limitations->id}}" id="input-id">
            <div class="row">
                <div class="col-xs-12">
                    <h2 class="page-header">
                        <i class="fa fa-globe"></i>  {{trans('admin.Inc')}} @if(session('lang') == 'en') ,  @endif  {{setting()->sitename_ar}} {{ session_lang(\App\Branches::where('id',$limitations->branche_id)->first()->name_en,\App\Branches::where('id',$limitations->branche_id)->first()->name_ar) }} .

                        <small class="date-in-invoices">{{trans('admin.date')}}: {{date('Y-m-d',strtotime($limitations->created_at))}}</small><br>
                        <small><strong>{{trans('admin.limitation_num')}}</strong> {{$limitations->limitationId}}</small>
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
                                <td>@if($d->debtor != 0) {{$d->debtor}} @else 0 @endif</td>
                                <td>@if($d->creditor != 0) {{$d->creditor}} @else 0 @endif</td>
                                <td>{{$d->note}}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="1"><strong>{{trans('admin.total_motion_debtor')}}</strong></td>
                            <td colspan="4">{{$data->sum('debtor')}}</td>
                        </tr>
                        <tr>
                            <td colspan="2"><strong>{{trans('admin.total_motion_creditor')}}</strong></td>
                            <td colspan="3">{{$data->sum('creditor')}}</td>
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

                <li>
                    {!! Form::open(array('url' => 'admin/limitationsData/invoice/print/' . $limitations->id, 'method' => 'POST', 'target' => '_blank')) !!}

                    {{Form::hidden('invoice_id',$limitations->invoice_id)}}

                    {{ Form::submit(trans('admin.Print_PDF'), array('class' => 'btn btn-default', 'style' => 'margin-right: 10px;')) }}

                    {!! Form::close() !!}
                </li>
            </ul>
        </div>
    </div>








@endsection
