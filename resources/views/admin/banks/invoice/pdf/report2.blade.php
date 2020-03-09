<!DOCTYPE html>
<html>
<head>
    <title></title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap-theme.min.css" integrity="sha384-6pzBo3FDv/PJ8r2KRkGHifhEocL+1X2rVCTTkUfGk7/0pbek5mMa1upzvWbrUbOZ" crossorigin="anonymous">
</head>
<style>
    body {
        font-family: 'dejavu sans', sans-serif;
        direction:rtl;
        text-align:right;
        padding:0;
        margin: 0;
    }
    .el-date{
        float: right;
        width: 40%
    }
    .el-date p{
        margin: 0 20px -25px;
        padding: 15px 0;
    }
    .el-no3{
        width:100%;
        display:block;
        margin:0 auto;
        text-align:center;
    }
    .el-no3 span{
        padding: 5px 20px !important;
        font-weight: bold;
        font-size: 12px;
    }
    .clearfix{
        clear:both;
    }
    .table{
        width: 100%;
    }
    .text-center{
        text-align: center;
    }
    #block_chain{
        background: #ccc;
    }
    @page {
        margin: 5px 30px !important;
        padding: 5px!important;
    }
    .hidden{
        display: none;
    }
</style>
<body>

<div style="padding-top:30px">
    <div style="float:right;font-weight:bold;width:50%">{{setting()->sitename_ar}}</div>
    <div style="float:left;font-weight:bold;width:50%;text-align:left">{{setting()->sitename_en}}</div>
</div>
<div style="text-align:center">
    <img src="{{asset('storage/'. setting()->icon)}}" style="max-width:100px;margin:15px 0">
</div>

<div class="el-no3">
    <span>{{\App\Enums\dataLinks\ReceiptType::getDescription($receipts->limitationReceipts->limitationReceiptsId)}}</span>
    <span>{{trans('admin.receipt_num')}} {{$receipts->receiptId}}</span>
</div>

<div class="clearfix"></div>
<div class="el-date">
    <p>{{trans('admin.date')}}:</b>{{date('d-m-Y', strtotime($receipts->date))}}</p>
</div>


<div class="clearfix"></div>

        <br>
        <div class="invoice-col">
            {{trans('admin.we_spent_for_mr')}} :
            <span id="block_chain">
                    @foreach($data as $d)
                    <strong>{{session_lang($d->name_en,$d->name_ar)}}</strong>
                @endforeach
                </span>
        </div>
        <div class="invoice-col">
            {{trans('admin.paid_is')}} :
            <span id="block_chain">
                    <strong>{{trans('admin.just')}} {{makeNumber2Text($receiptsData->creditor)}} {{trans('admin.EGP')}} {{trans('admin.not_else')}}</strong>
                </span>
        </div>
        <div class="invoice-col">
            {{trans('admin.that_for')}} :
            <span id="block_chain">
                    @foreach($data as $d)
                    <strong>{{$d->note}}</strong>
                @endforeach
                </span>
        </div>
        <!-- /.col -->
        <div class="invoice-col">

            @if($receipts->limitationReceipts->limitationReceiptsId == 1)
                <b>{{trans('admin.check_number')}} {{$receiptsData->check}}</b><br>
                <b>{{trans('admin.person_received')}} </b>{{$receiptsData->person}}<br>
                <b>{{trans('admin.person_taken')}} </b>{{$receiptsData->taken}}<br>
            @endif


        </div>

        <br>
        <br>

            <table>
                <tr>
                    <th>{{trans('admin.payments')}} : </th>
                    <td style="padding-right: 5px"> {{makeNumber2Text($receiptsData->creditor)}} {{trans('admin.EGP')}}</td>
                </tr>
                <tr>
                    <th>{{trans('admin.rest')}} : </th>
                    <td style="padding-right: 5px"> {{makeNumber2Text($data->sum('debtor') - $receiptsData->creditor)}} {{trans('admin.EGP')}}</td>
                </tr>
            </table>

        <br>
        <br>

            <table class="text-center" style="width: 100%;">
                <tr>
                    <th style="text-align:center">{{trans('admin.Account')}}</th>
                    <th style="text-align:center">{{trans('admin.account_manager')}}</th>
                    <th style="text-align:center">{{trans('admin.general_manager')}}</th>
                </tr>
                <tr>
                    <td>-------------------------</td>
                    <td>-------------------------</td>
                    <td>-------------------------</td>
                </tr>
            </table>

        <br>
        <div style="border: 2px solid #000;padding:10px">
            <table>
                <tr>
                    <th style="text-align: right">{{trans('admin.branche')}} :</th>
                    <td>{{ session_lang(\App\Branches::where('id',$receipts->branche_id)->first()->name_en,\App\Branches::where('id',$receipts->branche_id)->first()->name_ar) }}</td>
                </tr>
                <tr>
                    <th style="text-align: right">{{trans('admin.sUrl')}} :</th>
                    <td>{{\App\Branches::where('id',$receipts->branche_id)->first()->addriss}}</td>
                </tr>
                <tr>
                    <th style="text-align: right">{{trans('admin.phone')}} :</th>
                    <td>{{setting()->phone}}</td>
                </tr>
                <tr>
                    <th style="text-align: right">{{trans('admin.email')}} :</th>
                    <td>{{setting()->email}}</td>
                </tr>
            </table>
        </div>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
</body>
</html>
