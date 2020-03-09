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
        font-family: 'dejavu sans', sans-serif;
        direction:rtl;
        text-align:right;
        padding:0;
        margin: 0;
    }
    .el-no3{
        width:33%;
        display:block;
        text-align:center;
        margin-right: 33%;
        margin-left: 33%;
        margin-bottom:20px;
        padding: 5px 0;
        font-weight: bold;
        font-size: 12px;
        border:2px solid #000;
        background-color:#d4d4d4;
    }
    .clearfix{
        clear:both;
    }
    table{
        width: 100%;
        text-align: center;
        font-size: 10px;
    }
    .table th{
        font-size: 11px;
    }
    table td, table th {
        padding: .5rem;
        text-align: right;
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
    <table class="table table-striped table-hover">
        <tr>
            <th style="text-decoration:underline;line-height:5px">{{trans('admin.account_number')}}</th>
            <th style="text-decoration:underline;line-height:5px;text-align:center">{{trans('admin.account_name')}}</th>
            <th style="text-decoration:underline;line-height:5px;text-align:center">{{trans('admin.first_date_debtor')}}</th>
            <th style="text-decoration:underline;line-height:5px;text-align:center">{{trans('admin.first_date_creditor')}}</th>
        </tr>

@foreach($departments as $merged)
    <tr style="@if(strlen($merged->code) == 1 ) padding: 100px !important; @endif">
        <td>
            {{$merged->code}}
        </td>
        <td style="text-align:center">
            {{session_lang($merged->dep_name_en,$merged->dep_name_ar)}}
        </td>
        <td style="text-align:center">
            {{$merged->debtor}}
        </td>
        <td style="text-align:center">
            {{$merged->creditor}}
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