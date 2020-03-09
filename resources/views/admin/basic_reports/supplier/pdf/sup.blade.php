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
<div style="display: none">
    {{$allCredit = 0}}
    {{$allDebtor = 0}}</div>
<div>
    <div style="float:right;font-weight:bold;width:50%">{{setting()->sitename_ar}}</div>
    <div style="float:left;font-weight:bold;width:50%;text-align:left">{{setting()->sitename_en}}</div>
</div>
<div style="text-align:center">
    <img src="{{asset('storage/'. setting()->icon)}}" style="max-width:70px;margin:15px 0">
</div>

<div class="el-no3">
    <span>تقارير الموردين</span>
</div>

<div class="clearfix"></div>
<div class="el-date">
{{--    <p>من تاريخ : {{}}</p>--}}
{{--    <p>الى تاريخ : {{}}</p>--}}
</div>


<div class="clearfix"></div>
<div class="table-responsive">
    <table style="border: none" class="table table-bordered table-striped table-hover text-center">
        <tr>
            <th style="border: none;background-color: #fff" colspan="4"> </th>
            <th style="border: none;background-color: #fff" colspan="3"> </th>
            <th colspan="2">حد الائتمان</th>
            <th colspan="2">اول المدة</th>
        </tr>
        <tr>
            <th>م </th>
            <th>رقم المورد</th>
            <th>اسم المورد</th>
            <th>العمله</th>
            <th>رقم التلفون</th>
            <th>رقم موبايل</th>
            <th>العنوان</th>
            <th>مدة</th>
            <th>مبلغ</th>
            <th>مدين</th>
            <th>دائن</th>

        </tr>

        @foreach ($MtsSuplir as $merged){
        <tr>
            <td>{{$merged->ID_No}}</td>
            <td>{{$merged->Sup_No}}</td>
            <td>{{session_lang($merged->Sup_NmEn,$merged->Sup_NmAr)}}</td>

            <td>
                @if($merged->currency)
                    {{$merged->currency->{'Curncy_Nm'.ucfirst(session('lang'))} }}
                @endif
            </td>
            <td>{{$merged->Sup_Tel1}}</td>
            <td>{{$merged->Mobile}}</td>
            <td>{{$merged->Sup_Adr}}</td>
            <td>{{$merged->Credit_Days}}</td>
            <td>{{$merged->Credit_Value}}</td>
            <td>{{$merged->Fbal_Db}}</td>
            <td>{{$merged->Fbal_CR}}</td>
        </tr>
        @endforeach


    </table>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
</body>
</html>
