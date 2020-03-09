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
    }.el-date{
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
    .table{
        width: 100%;
        text-align: center;
        font-size: 10px;
        margin-top: 20px;
        border:1px solid #000
    }
    .table th{
        text-align: center;
        font-size: 11px;
    }
    .table td{
        text-align: right;
    }
    .table td, .table th {
        padding: .5rem;
        vertical-align: middle;
        border: 1px solid #000000 !important;
    }
    .table .th-empty{
        border: none !important;
        background: none
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
    <div style="float:right;font-weight:bold;width:50%">{{\App\Models\Admin\MainCompany::where('Cmp_No', $gl->Cmp_No)->pluck('Cmp_NmAr')->first()}}</div>
    <div style="float:left;font-weight:bold;width:50%;text-align:left">{{\App\Models\Admin\MainCompany::where('Cmp_No', $gl->Cmp_No)->pluck('Cmp_NmEn')->first()}}</div>
</div>
<div style="text-align:center">
    {{-- {{\App\Models\Admin\MainCompany::where('Cmp_No', $gl->Cmp_No)->pluck('Picture')->first()}} --}}
    <img src="{{asset('public/storage/companies/logo.png')}}" style="max-width:100px;margin:15px 0">
</div>

<div class="el-no3">
    <span>
        @if($gl->Jr_Ty == 2) {{trans('admin.RcpCsh_Voucher')}} @endif
    </span>
    <span>{{trans('admin.receipt_num')}} {{$gl->Tr_No}}</span>
</div>

<div class="clearfix"></div>
<div class="el-date">
    <p>{{trans('admin.date')}}:</b>{{$gl->Entr_Dt}}</p>
</div>


<div class="clearfix"></div>


            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <tr>
                        <th rowspan="2">{{trans('admin.sequence')}}</th>
                        <th colspan="2">{{trans('admin.information_account')}}</th>
                        <th rowspan="2">{{trans('admin.cc')}}</th>
                        <th rowspan="2">{{trans('admin.note_for')}}</th>
                        <th rowspan="2">{{trans('admin.debtor')}}</th>
                        <th rowspan="2">{{trans('admin.creditor')}}</th>
                    </tr>
                    <tr>
                        <th>{{trans('admin.account_number')}}</th>
                        <th>{{trans('admin.account_name')}}</th>
                    </tr>
                    <div class="hidden">
                        {{-- {{ $i = 1 }} --}}
                        {{$balance = 0}}
                        {{$dataDebtor = 0}}
                        {{$dataCredit = 0}}
                    </div>
                    @foreach($gltrns as $trns)
                        <tr>
                            <td>
                                {{$trns->Ln_No}}
                                {{-- {{$i++}} --}}
                            </td>
                            <td>
                                {{$trns->Acc_No}}
                            </td>
                            <td>
                                @if($trns->Sysub_Account != 0)
                                    @if($gl->Cstm_No)
                                        {{\App\Models\Admin\MTsCustomer::where('Cstm_No', $trns->Sysub_Account)->pluck('Cstm_Nm'.ucfirst(session('lang')))->first()}}
                                    @endif
                                    @if($gl->Sup_No)
                                        {{\App\Models\Admin\MtsSuplir::where('Sup_No', $trns->Sysub_Account)->pluck('Sup_Nm'.ucfirst(session('lang')))->first()}}
                                    @endif
                                    @if($gl->Emp_No)
                                        {{\App\Models\Admin\MTsCustomer::where('Cstm_No', $trns->Sysub_Account)->pluck('Cstm_Nm'.ucfirst(session('lang')))->first()}}
                                    @endif
                                    @if($gl->Chrt_No)
                                        {{\App\Models\Admin\MtsChartAc::where('Acc_No', $trns->Sysub_Account)->pluck('Acc_Nm'.ucfirst(session('lang')))->first()}}
                                    @endif
                                @else
                                    {{\App\Models\Admin\MtsChartAc::where('Acc_No', $trns->Acc_No)->pluck('Acc_Nm'.ucfirst(session('lang')))->first()}}
                                @endif
                            </td>
                            <td>
                                @if($trns->Costcntr_No != null) 
                                    {{\App\Models\Admin\MtsCostcntr::where('Costcntr_No', $trns->Costcntr_No)->pluck('Costcntr_Nm'.ucfirst(session('lang')))->first()}}
                                @endif
                            </td>
                            <td>
                                {{$trns->Tr_Ds}}
                            </td>
                            <td>
                               {{$trns->Tr_Db}}
                            </td>
                            <td>
                                {{$trns->Tr_Cr}}
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <td>
                            {{-- {{$i++}} --}}
                        </td>
                        <td>
                            {{$trns->Sysub_Account}}
                        </td>
                        <td>
                            @if($trns->Sysub_Account != 0)
                                <td>
                                    @if($gl->Cstm_No)
                                        {{\App\Models\Admin\MTsCustomer::where('Cstm_No', $trns->Sysub_Account)->pluck('Cstm_Nm'.ucfirst(session('lang')))->first()}}
                                    @endif
                                    @if($gl->Sup_No)
                                        {{\App\Models\Admin\MtsSuplir::where('Sup_No', $trns->Sysub_Account)->pluck('Sup_Nm'.ucfirst(session('lang')))->first()}}
                                    @endif
                                    @if($gl->Emp_No)
                                        {{\App\Models\Admin\MTsCustomer::where('Cstm_No', $trns->Sysub_Account)->pluck('Cstm_Nm'.ucfirst(session('lang')))->first()}}
                                    @endif
                                    @if($gl->Chrt_No)
                                        {{\App\Models\Admin\MtsChartAc::where('Acc_No', $trns->Sysub_Account)->pluck('Acc_Nm'.ucfirst(session('lang')))->first()}}
                                    @endif
                                </td>
                                <td>
                                    {{$trns->Tr_Ds}}
                                </td>
                                <td>
                                    {{$trns->Tr_Db}}
                                </td>
                                <td>
                                    {{$trns->Tr_Cr}}
                                </td>
                            @endif
                        </td>
                        <td>

                        </td>
                        <td>
                            {{$trns->Tr_Ds}}
                        </td>
                        <td>
                            {{$trns->Tr_Db}}
                        </td>
                        <td>
                            {{$trns->Tr_Cr}}
                        </td>
                    </tr>

                    <tr>
                        <th colspan="5" class="th-empty">{{trans('admin.Total_motion')}}</th>
                        <th>{{$gl->Tot_Amunt}}</th>
                        <th>{{$gl->Tot_Amunt}}</th>
                    </tr>
                </table>
            </div>

            <table>
                <tr>
                    <th>{{trans('admin.payments')}} : </th>
                    <td style="padding-right: 5px"> {{trans('admin.just')}} {{makeNumber2Text($trns->Tr_Db)}} {{trans('admin.EGP')}} {{trans('admin.not_else')}}</td>
                </tr>
                <tr>
                    <th>{{trans('admin.rest')}} : </th>
                    {{-- <td style="padding-right: 5px"> {{trans('admin.just')}} {{makeNumber2Text($data->sum('creditor') - $receiptsData->debtor)}} {{trans('admin.EGP')}} {{trans('admin.not_else')}}</td> --}}
                </tr>
            </table>

        <br>
        <div style="position:absolute;bottom:50px;left:0;margin:0 25px;text-align:center">
        <br>
            <div class="table-responsive">
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
            </div>
            <br>
            <div style="border: 2px solid #000;padding:10px">
                <table>
                    <tr>
                        <th style="text-align: right">{{trans('admin.branche')}} :</th>
                        {{\App\Models\Admin\MainBranch::where('Brn_No',$trns->Brn_No)->pluck('Brn_Nm'.ucfirst(session('lang')))->first()}}
                    </tr>
                    <tr>
                        <th style="text-align: right">{{trans('admin.sUrl')}} :</th>
                        <td>{{\App\Models\Admin\MainBranch::where('Brn_No',$trns->Brn_No)->first()->Brn_Adrs}}</td>
                    </tr>
                    <tr>
                        <th style="text-align: right">{{trans('admin.phone')}} :</th>
                        <td>{{\App\Models\Admin\MainBranch::where('Brn_No',$trns->Brn_No)->first()->Brn_Tel}}</td>
                    </tr>
                    <tr>
                        <th style="text-align: right">{{trans('admin.email')}} :</th>
                        <td>{{\App\Models\Admin\MainBranch::where('Brn_No',$trns->Brn_No)->first()->Brn_Email}}</td>
                    </tr>
                </table>
            </div>
        </div>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
</body>
</html>
