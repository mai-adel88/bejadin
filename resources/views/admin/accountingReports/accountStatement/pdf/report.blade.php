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
    .el-account{
        float: right;
        width: 50%;
    }
    .el-date{
        float: left;
        width: 25%
    }
    .el-date p,.el-account p{
        font-size: 12px;
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
    table{
        width: 100%;
        text-align: center;
        font-size: 10px;
        margin-top: 20px;
    }
    .table th{
        background-color: #f3f3f3;
        text-align: center;
        font-size: 11px;
    }
    .table td{
        text-align: right;
    }
    table td, table th {
        padding: .5rem;
        vertical-align: middle;
        border: 1px solid #000000 !important;
    }
    table .th-empty{
        border: none !important;
        background: none
    }
    .text-center{
        text-align: center;
    }
</style>
<body>
<div style="display: none">{{ $s = 1 }}
    {{$allCredit = 0}}
    {{$allDebtor = 0}}</div>
@foreach ($data as $day => $receipts)
    <div>
        <div style="float:right;font-weight:bold;width:50%">{{setting()->sitename_ar}}</div>
        <div style="float:left;font-weight:bold;width:50%;text-align:left">{{setting()->sitename_en}}</div>
    </div>
    <div style="text-align:center">
        <img src="{{asset('storage/'. setting()->icon)}}" style="max-width:70px;margin:15px 0">
    </div>

    <div class="el-no3">
        <span>{{trans('admin.account_statement')}}</span>
        <span>{{$operation['name_ar']}}</span>
    </div>

    <div class="el-account">
        @foreach($receipts as $key => $receipt) @if($key == 0) <p>رقم الحساب : {{$receipt->id}}</p> @endif  @endforeach
        <p>اسم الحساب : {{$day}}</p>
    </div>
    <div class="el-date">
        <p>من تاريخ : {{$from}}</p>
        <p>الى تاريخ : {{$to}}</p>
    </div>


    <div class="clearfix"></div>
    <div class="table-responsive">
        <table style="border:none" class="table table-bordered table-striped table-hover">
            <tr>
                <th>{{trans('admin.date')}}</th>
                <th>{{trans('admin.number_of_limitation')}}</th>
                <th>{{trans('admin.limitation_kind')}}</th>
                <th style="vertical-align: middle;">{{trans('admin.note_for')}}</th>
                <th>{{trans('admin.debtor')}}</th>
                <th>{{trans('admin.creditor')}}</th>
                <th>{{trans('admin.Balance')}}</th>
            </tr>
            <div class="hidden">{{ $i = 1 }}
                {{$balance = 0}}
                {{$dataDebtor = 0}}
                {{$dataCredit = 0}}
            </div>
            @foreach($receipts as $key => $receipt)
                <tr>
                    <td>
                        @if($key == 0)
                            {{date("Y-m-d",strtotime($receipt->created_at))}}
                            @else
                            @if($receipt->receipts)
                            {{date("Y-m-d",strtotime($receipt->receipts['created_at']))}}
                            @elseif($receipt->limitations)
                                {{date("Y-m-d",strtotime($receipt->limitations['created_at']))}}
                            @endif
                        @endif
                    </td>
                    <td width="20px">
                        {{$receipt->receipts['receiptId']}}
                        {{$receipt->limitations['limitationId']}}
                    </td>
                    <td>
                        {{\App\Enums\dataLinks\ReceiptType::getDescription(limitationReceiptsid($receipt->receipts['receiptsType_id']))}}
                        @if($receipt->limitations['limitationsType_id'] == 12)
                            {{\App\Enums\dataLinks\BondRestrictionsType::getDescription($receipt->limitations['limitationsType_id'])}}
                        @else
                            {{\App\Enums\dataLinks\LimitationsType::getDescription(limitationReceiptsid($receipt->limitations['limitationsType_id']))}}
                        @endif
                        @if((!$receipt->limitations && !$receipt->receipts) && $receipt->email == null || $receipt->email != null) {{trans('admin.first_date')}} @endif
                    </td>
                    <td>
                        {{$receipt->note}}
                    </td>
                    <td style="text-align: center">
                        @if($key  == 0)
                            {{(firstdatelaccount($from,$receipt->id,$receipt->operation_id)->sum('debtor') + firstdateraccount($from,$receipt->id,$receipt->operation_id)->sum('debtor')) + $receipt->debtor }}
                            <div class="hidden">{{$dataDebtor += firstdatelaccount($from,$receipt->id,$receipt->operation_id)->sum('debtor') + firstdateraccount($from,$receipt->id,$receipt->operation_id)->sum('debtor') + $receipt->debtor }}</div>
                        @else
                            {{$receipt->debtor != null ? $receipt->debtor : 0 }}
                            <div class="hidden">{{$dataDebtor += $receipt->debtor}}</div>
                        @endif
                    </td>
                    <td style="text-align: center" class="creditor">
                        @if($key  == 0)
                            {{firstdatelaccount($from,$receipt->id,$receipt->operation_id)->sum('creditor') + firstdateraccount($from,$receipt->id,$receipt->operation_id)->sum('creditor') + $receipt->creditor }}
                            <div class="hidden">{{$dataCredit += firstdatelaccount($from,$receipt->id,$receipt->operation_id)->sum('creditor') + firstdateraccount($from,$receipt->id,$receipt->operation_id)->sum('creditor') + $receipt->creditor }}</div>
                        @else
                            {{$receipt->creditor != null ? $receipt->creditor : 0 }}
                            <div class="hidden">{{$dataCredit += $receipt->creditor}}</div>
                        @endif
                    </td>
                    <td style="text-align: center">
                        @if($key  == 0)
                            {{$balance += ((firstdatelaccount($from,$receipt->id,$receipt->operation_id)->sum('debtor') + firstdateraccount($from,$receipt->id,$receipt->operation_id)->sum('debtor') + $receipt->debtor) - (firstdatelaccount($from,$receipt->id,$receipt->operation_id)->sum('creditor') + firstdateraccount($from,$receipt->id,$receipt->operation_id)->sum('creditor') + $receipt->creditor))}}
                        @else
                            {{$balance += ($receipt->debtor - $receipt->creditor)}}
                        @endif
                    </td>
                </tr>
            @endforeach

            <tr>
                <th colspan="3" class="th-empty"></th>
                <th>{{trans('admin.Total_motion')}}</th>
                <th style="text-align: center">{{$dataDebtor}} </th>
                <th style="text-align: center">{{$dataCredit}} </th>
                <th style="text-align: center">{{$balance}} </th>
            </tr>
            <div style="display: none">
                <tr style="display:@if($loop->last) table-row @else none @endif">
                    <th colspan="3" class="th-empty"></th>
                    <th>{{trans('admin.Total_motion')}}</th>
                    <th style="text-align: center">{{$allDebtor}}</th>
                    <th style="text-align: center">{{$allCredit}}</th>
                </tr>
            </div>
        </table>
    </div>


    <pagebreak></pagebreak>
@endforeach

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
</body>
</html>
