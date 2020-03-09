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
    {{$allDebtor = 0}}
    {{$balance  = 0}}
    {{$dataDebtor   = 0}}
    {{$dataCredit    = 0}}

</div>
<div>
    <div style="float:right;font-weight:bold;width:50%">{{setting()->sitename_ar}}</div>
    <div style="float:left;font-weight:bold;width:50%;text-align:left">{{setting()->sitename_en}}</div>
</div>
<div style="text-align:center">
    <img src="{{asset('storage/'. setting()->icon)}}" style="max-width:70px;margin:15px 0">
</div>

<div class="el-no3">
    <span>{{trans('admin.cust_account_statement')}}</span>
</div>

@if(count($Empty_GLjrnTrs) > 0 && count($data) == 0)
    @foreach($Empty_GLjrnTrs as $key => $one)


        @if($key == 0)

            <div class="el-account">

                <p>رقم الحساب :{{$one->acc_no_chart}}</p>
                <p>اسم الحساب : {{$one->Acc_NmAr}}</p>
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


                    <tr>
                        <td>
                            @if($key == 0)
                                {{date("Y-m-d",strtotime($from))}}
                            @endif
                        </td>
                        <td width="20px">

                        </td>
                        <td>
                            @if($key == 0)
                                {{trans('admin.first_date')}}
                            @endif
                        </td>
                        <td>

                        </td>
                        <td>


                            <div style="display: none;">
                                @if($key  == 0)

                                    {{ $all_Tr_Db=  firstdateraccount($one->Cmp_No,$one->Brn_No,$one->Ac_Ty,$one->acc_no_chart,$from)->sum('Tr_Db')}}


                                @endif


                                @if($key  == 0)
                                    {{ $all_Tr_Cr=  firstdateraccount($one->Cmp_No,$one->Brn_No,$one->Ac_Ty,$one->acc_no_chart,$from)->sum('Tr_Cr')}}
                                @endif

                            </div>


                            @if($all_Tr_Db > $all_Tr_Cr)
                                {{$dataDebtor += $all_Tr_Db - $all_Tr_Cr}}
                            @else
                                {{$dataDebtor = 0}}
                            @endif
                        </td>
                        <td class="creditor">
                            @if($all_Tr_Db < $all_Tr_Cr)


                                @if(($all_Tr_Db - $all_Tr_Cr) < 0)

                                    {{$dataCredit += $all_Tr_Cr - $all_Tr_Db}}
                                @else
                                    {{$dataCredit += $all_Tr_Db - $all_Tr_Cr}}
                                @endif
                            @else
                                {{$dataCredit = 0}}
                            @endif
                        </td>
                        <td>
                            @if($key  == 0)


                                {{$balance += $all_Tr_Db -$all_Tr_Cr }}
                            @endif
                        </td>

                    </tr>


                    <div class="hidden">{{ $i = 1 }}
                        {{$balance = 0}}
                        {{$dataDebtor = 0}}
                        {{$dataCredit = 0}}
                    </div>
                </table>
            </div>
        @endif
    @endforeach

@elseif(count($Empty_GLjrnTrs) == 0 && count($data) == 0)
    <div class="el-account">

        <p>رقم الحساب :{{$GLjrnTrs_name->Acc_No}}</p>
        <p>اسم الحساب : {{$GLjrnTrs_name->Acc_NmAr}}</p>
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


            <tr>
                <td>

                    {{date("Y-m-d",strtotime($from))}}

                </td>
                <td width="20px">

                </td>
                <td>

                    {{trans('admin.first_date')}}

                </td>
                <td>

                </td>
                <td>


                    <div style="display: none;">
                        {{ $all_depter= 0}}



                        {{ $all_creditor=0}}


                    </div>


                    @if($all_depter > $all_creditor)
                        {{$dataDebtor += $all_depter - $all_creditor}}
                    @else
                        {{$dataDebtor = 0}}
                    @endif
                </td>
                <td class="creditor">
                    @if($all_depter < $all_creditor)
                        {{$dataCredit += $all_depter - $all_creditor}}
                        @if(($all_depter - $all_creditor) < 0)

                            {{$dataCredit += $all_creditor - $all_depter}}
                        @else
                            {{$dataCredit += $all_depter - $all_creditor}}
                        @endif
                    @else
                        {{$dataCredit = 0}}
                    @endif
                </td>
                <td>

                    {{$balance += $all_depter -$all_creditor }}




                </td>

            </tr>


            <div class="hidden">{{ $i = 1 }}
                {{$balance = 0}}
                {{$dataDebtor = 0}}
                {{$dataCredit = 0}}
            </div>
        </table>
    </div>

@else
    @foreach ($data as $day => $Gljrntrs)



        <div class="el-account">
            @foreach($Gljrntrs as $key => $one) @if($key == 0) <p>رقم الحساب : {{$one->Acc_No}}</p>
            <p>اسم الحساب : {{$one-> { 'Acc_Nm' . ucfirst(session('lang'))} }}</p>
            @endif  @endforeach
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


                <div class="hidden">
                    {{$balance = 0}}
                    {{$dataDebtor = 0}}
                    {{$dataCredit = 0}}
                </div>

                @foreach($Gljrntrs as $key => $one)


                    @if($key == 0)
                        <tr>
                            <td>
                                @if($key == 0)
                                    {{date("Y-m-d",strtotime($from))}}
                                @endif
                            </td>
                            <td width="20px">
{{----}}
                            </td>
                            <td>
                                @if($key == 0)
                                    {{trans('admin.first_date')}}
                                @endif
                            </td>
                            <td>

{{--                                {{dd(firstdateraccount($one->Cmp_No,$one->Brn_No,$one->Ac_Ty,$from)->sum('Tr_Db'))}}--}}
                            </td>
                            <td>


                                <div style="display: none;">
                                @if($key  == 0)

                                        {{ $all_Tr_Db=  firstdateraccount($one->Cmp_No,$one->Brn_No,$one->Ac_Ty,$one->acc_no_chart,$from)->sum('Tr_Db')}}


                                    @endif


                                @if($key  == 0)
                                        {{ $all_Tr_Cr=  firstdateraccount($one->Cmp_No,$one->Brn_No,$one->Ac_Ty,$one->acc_no_chart,$from)->sum('Tr_Cr')}}
                                    @endif

                                </div>


                                    @if($all_Tr_Db > $all_Tr_Cr)
                                        {{$dataDebtor += $all_Tr_Db - $all_Tr_Cr}}
                                    @else
                                        {{$dataDebtor = 0}}
                                    @endif
                            </td>
                            <td class="creditor">
                                @if($all_Tr_Db < $all_Tr_Cr)


                                    @if(($all_Tr_Db - $all_Tr_Cr) < 0)

                                        {{$dataCredit += $all_Tr_Cr - $all_Tr_Db}}
                                    @else
                                        {{$dataCredit += $all_Tr_Db - $all_Tr_Cr}}
                                    @endif
                                @else
                                    {{$dataCredit = 0}}
                                @endif
                            </td>
                            <td>
                                @if($key  == 0)


                                    {{$balance += $all_Tr_Db -$all_Tr_Cr }}
                                @endif
                            </td>
                        </tr>
                    @endif
                    <tr>
                        <td>

                                {{date("Y-m-d",strtotime($one->Tr_Dt))}}


                        </td>
                        <td>
                            {{$one->Tr_No}}

                        </td>
                        <td>


                            {{\App\Enums\dataLinks\ReceiptType::getDescription($one->Jr_Ty)}}

                        </td>

                        <td>
                            {{$one->Tr_Ds}}
                        </td>
                        <td class="Tr_Db">


                            {{$one->Tr_Db != null ? $one->Tr_Db : 0}}
                            <div class="hidden">{{$dataDebtor +=$one->Tr_Db}}</div>
                        </td>
                        <td class="Tr_Cr">

                            {{$one->Tr_Cr != null ? $one->Tr_Cr: 0}}
                            <div class="hidden">{{$dataCredit +=$one->Tr_Cr}}</div>

                        </td>
                        <td>
                            {{$balance += ($one->Tr_Db - $one->Tr_Cr)}}
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
@endif


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rLQihCFPSNPkwLNBTbVZHUAnYc5iRYaWz9em+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTLT1Kqob5UDEML61gCyjnAcfMXgkdP3wGcg45XN0VxHd" crossorigin="anonymous"></script>
</body>
</html>
