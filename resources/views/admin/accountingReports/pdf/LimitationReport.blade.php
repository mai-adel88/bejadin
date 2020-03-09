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
</style>
<body>
<div style="display: none">
    {{ $s = 1 }}
    {{$allCredit = 0}}
    {{$allDebtor = 0}}
</div>
@foreach ($limitationsTypeInvoice as $day => $limitations)
    <div>
        <div style="float:right;font-weight:bold;width:50%">{{setting()->sitename_ar}}</div>
        <div style="float:left;font-weight:bold;width:50%;text-align:left">{{setting()->sitename_en}}</div>
    </div>
    <div style="text-align:center">
        <img src="{{asset('storage/'. setting()->icon)}}" style="max-width:70px;margin:15px 0">
    </div>

    <div class="el-no3">
        <span>{{trans('admin.daily_report')}}</span>
        <span>{{$typeLimitationReceipts->name_ar}}</span>
    </div>

    <div class="clearfix"></div>
    <div class="el-date">
        <p>من : {{$from}}</p>
        <p>الى : {{$to}}</p>
    </div>


    <div class="clearfix"></div>
    <div class="table-responsive">
        <table style="border:none" class="table table-bordered table-striped table-hover" data-serial="{{$s++}}">
            <tr>
                <th colspan="3">بيانات القيد</th>
                <th>بيانات الحساب</th>
                <th rowspan="2">{{trans('admin.single_cc')}}</th>
                <th rowspan="2" style="vertical-align: middle;">{{trans('admin.note_for')}}</th>
                <th colspan="2">المبلغ</th>
            </tr>

            <tr>
                <th>{{trans('admin.number_of_receipt')}}</th>
                <th>{{trans('admin.line')}}</th>
                <th>{{trans('admin.account_number')}}</th>
                <th>{{trans('admin.account_name')}}</th>
                <th>{{trans('admin.debtor')}}</th>
                <th>{{trans('admin.creditor')}}</th>
            </tr>


            <div class="hidden">
                {{ $i = 1 }}
                {{$price = 0}}
                {{$typeCredit = 0}}
                {{$typeDebtor = 0}}
                {{$dataDebtor = 0}}
                {{$dataCredit = 0}}
            </div>
            @foreach($limitations as $limitation)
                @foreach($limitation->limitations_type as $type)

                    <tr>
                        <td>
                            {{$type->limitations->limitationId}}
                        </td>
                        <td>{{$i++}}</td>
                        <td>
                            @if($type->operation_id == 4)
                                {{\App\Department::where('id',$type->relation_id)->first()['code']}}
                            @else
                                {{$type->relation_id}}
                            @endif
                        </td>
                        <td>
                            {{session_lang($type->name_en,$type->name_ar)}}
                        </td>
                        <td>
                            {{$type->glcc ? $type->glcc->name_ar : ''}}
                        </td>
                        <td>
                            {{$type->note}}
                        </td>
                        <td>
                            {{$type->debtor != null ? $type->debtor : 0}}
                            <div class="hidden">{{$typeDebtor += $type->debtor}}</div>
                        </td>
                        <td class="creditor">
                            {{$type->creditor != null ? $type->creditor : 0}}
                            <div class="hidden">{{$typeCredit += $type->creditor}}</div>
                        </td>
                    </tr>
                @endforeach
            @endforeach

            <tr>
                <th colspan="5" class="th-empty"></th>
                <th >{{trans('admin.daily_total')}} <span style="padding-right:15px"> {{$day}} </span></th>
                <th>{{$typeDebtor}} </th>
                <span style="dispaly:none">{{$allDebtor += $typeDebtor}}</span>
                <th>{{$typeCredit}} </th>
                <span style="dispaly:none">{{$allCredit += $typeCredit}}</span>
            </tr>
            <tr style="display:@if($loop->last) table-row @else none @endif">
                <th colspan="5" class="th-empty"></th>
                <th>{{trans('admin.Total_motion')}}</th>
                <th>{{$allDebtor}} </th>
                <th>{{$allCredit}} </th>
            </tr>
        </table>
    </div>
    <pagebreak></pagebreak>
@endforeach
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>

<script>
    $(function () {
        'use strict'

        $(".remove").parent('.table-responsive').prev().remove();
        $(".remove").parent('.table-responsive').remove();
        // if($('.alert-danger').length > 1){
        //     $('.alert-danger').not(':first').remove();
        // }
    });
</script>
</body>
</html>
