{{--{{dd($departments)}}--}}
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
        font-family: Droid Arabic Kufi;

        /*font-family: 'dejavu sans', sans-serif;*/
        direction:rtl;
        text-align:right;
        padding:0;
        margin: 0;
        border: 15px solid #000;
    }
    .el-date{
        float: right;
        width: 80%;
        padding-top: -18px;
        margin-right: 350px;
    }
    .el-date p{
        font-size: 12px;
        margin: 0 260px -20px;
        /*padding: 15px 0;*/
        float: left;
    }
    .active p{
        width: 50px;
        margin-top: -20px;
    }
    .el-no3{
        width:100%;
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
<div>
    <div style="float:right;font-weight:bold;width:50%">{{setting()->sitename_ar}}</div>
    <div style="float:left;font-weight:bold;width:50%;text-align:left">{{setting()->sitename_en}}</div>
</div>


<div style="text-align:center">
    <img src="{{asset('storage/' . setting()->icon)}}" style="max-width:100px;margin:15px 0">
</div>

<div class="el-no3">
    {{trans('admin.Departments_reports')}}
</div>

<div class="clearfix"></div>
<div class="table-responsive">
    <table style="border: none" class="table table-bordered table-striped table-hover text-center">
        <tr>
            <th>{{trans('admin.account_number')}}</th>
            <th >{{trans('admin.account_name')}}</th>
            <th>{{trans('admin.first_date_debtor')}}</th>
            <th>{{trans('admin.first_date_creditor')}}</th>
        </tr>

@foreach($departments as $merged)
    <tr>
        <td>
            {{$merged->Acc_No}}
        </td>
        <td style="text-align:center">
            {{session_lang($merged->Acc_NmAr,$merged->Acc_NmEn)}}
        </td>
        <td style="text-align:center">
            {{$merged->Fbal_DB}}
        </td>
        <td style="text-align:center">
            {{$merged->Fbal_CR}}
        </td>
    </tr>

@endforeach


</table>

</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<!-- Latest compiled and minified JavaScript -->
</body>
</html>
