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



        padding:0 !important;
        margin: 0 !important;

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

    .el-data{
        float: left;
        width: 35%
    }
    .el-date p{
        font-size: 12px;
        margin: 0 20px -25px;
        padding: 15px 0;
    }
    .el-data p{
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
    {{$total = 0}}
    {{$allDebtor = 0}}
</div>



    <div>
        <div style="float:right;font-weight:bold;width:50%">{{setting()->sitename_ar}}</div>
        <div style="float:left;font-weight:bold;width:50%;text-align:left">{{setting()->sitename_en}}</div>
    </div>
    <div style="text-align:center">
        <img src="{{asset('storage/'. setting()->icon)}}" style="max-width:70px;margin:15px 0">
    </div>

    <div class="el-no3">
        <span>فاتورة المبيعات </span>

        <p>رقم الفاتورة : {{$invoices->Doc_No }} </p>

    </div>

    <div class="clearfix"></div>
    <div class="el-date">


        <p>الشركة : {{$invoices->company->{ 'Cmp_Nm' .ucfirst(session('lang')) } }} </p>
        <p>الفرع : {{$invoices->branch->{ 'Brn_Nm' .ucfirst(session('lang')) } }}</p>
        <p>العميل : {{$invoices->customer->{ 'Cstm_Nm' .ucfirst(session('lang')) } }}</p>
        <p>المستودع : {{$invoices->store->{ 'Dlv_Nm' .ucfirst(session('lang')) } }}</p>
        <p>مندوب المبيعات : {{
        App\Models\Admin\AstSalesman::
       where('Cmp_No',$invoices->Cmp_No)

            ->where('Slm_No',$invoices->Slm_No)->first()->Slm_NmAr


            }}
        </p>
    </div>
    <div class="el-data">
        <p>تاريخ الفاتورة : {{$invoices->Doc_Dt}}</p>
        <p>تاريخ سداد الفاتورة : {{$invoices->Pym_Dt}}</p>

    </div>


    <div class="clearfix"></div>
    <div class="table-responsive" style="page-break-after:auto;">
        <table style="border:none" class="table table-bordered table-striped table-hover" data-serial="{{$s++}}">
            <tr>

                <th colspan="4">بيانات الصنف</th>
                <th colspan="4" >الاجمالي</th>



            </tr>

            <tr>
                <th>م</th>

                <th>رقم الصنف</th>
                <th>اسم  الصنف</th>
                <th> الكميه</th>
               <th>سعر البيع	</th>
               <th>الاجمالي</th>
                <th>خصم الاصناف</th>

                <th>بعد الخصم</th>
                <th>الضريبة</th>
                <th>بعد الضريبة</th>


            </tr>
            <div style="display: none">{{ $i = 1 }}

            </div>
            @if(count($invoices->details) > 0)
                @foreach($invoices->details as $merged)


                    <tr>
                        <td>
                            {{$i++}}
                        </td>
                        <td>
                            {{$merged->Itm_No}}
                        </td>
                        <td>
                            {{
                            \App\Models\Admin\MtsItmmfs::
                            where('Itm_No',$merged->Itm_No)->first()->Itm_NmAr
                            }}


                        </td>
                        <td>
                            {{$merged->Qty}}
                        </td>
                        <td>
                            {{$merged->Itm_Sal}}

                        </td>
                        <td>
                            {{$merged->Qty * $merged->Itm_Sal}}
                            <div style="display: none">
                                {{$total += $merged->Qty * $merged->Itm_Sal }}
                            </div>
                        </td>
                        <td>
                            {{$merged->Disc1_Val}}
                        </td>


                        <td>
                            {{($merged->Qty * $merged->Itm_Sal) - $merged->Disc1_Val }}

                        </td>
                        <td>

                            {{$merged->Taxv_ExtraDtl}}
                        </td>
                        <td>
                            {{(($merged->Qty * $merged->Itm_Sal) - $merged->Disc1_Val) + $merged->Taxv_ExtraDtl }}
                        </td>

                    </tr>

                @endforeach
                @else
                <tr>
                    <td colspan="10" class="alert alert-warning" style="width: 100%">
                        <div class="text-danger" style="font-size: 16px; width: 500px; margin: auto">{{trans('admin.nodata')}}</div>
                    </td>
                </tr>
            @endif
            <tr>
                <th colspan="2" class="th-empty"></th>
                <th >الاجمالي <span style="padding-right:15px"> </span></th>
                <th> {{$total}}</th>
                <th >الصافي <span style="padding-right:15px"> </span></th>
                <th> {{$invoices->Net}}</th>





            </tr>




        </table>

    </div>
    <pagebreak></pagebreak>


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

