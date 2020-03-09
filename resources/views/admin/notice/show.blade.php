@extends('admin.index')
@section('title',trans('admin.notics'))
@section('content')
    @push('js')
    @endpush
    <h5>
        <i class="fa fa-globe"></i>
        {{trans('admin.Inc')}} {{ $cmp->{'Cmp_Nm'.ucfirst(session('lang'))} }}
        {{trans('admin.No_of_license')}} {{$cmp->License_No}} {{ $brn->{'Brn_Nm'.ucfirst(session('lang'))} }}
    </h5>
    {{--<div class="row" style="text-align:center">--}}
    {{--    <h2>{{trans('admin.Pymt_Flg')}}</h2>--}}
    {{--</div>--}}
    @push('css')
        <style>
            .panel-H{
                border-color: #26333a !important;
            }
            .panel-A {
                background-color: #26333a !important;
                border-color: #26333a !important;
            }

            fieldset.scheduler-border {
                border: 1px groove #ddd !important;
                padding: 0 1.4em 1.4em 1.4em !important;
                margin: 0 0 1.5em 0 !important;
                -webkit-box-shadow:  0px 0px 0px 0px #000;
                box-shadow:  0px 0px 0px 0px #000;
            }

            legend.scheduler-border {
                font-size: 1.2em !important;
                font-weight: bold !important;
                text-align: left !important;
            }
        </style>

    @endpush

    <div class="content-header">
        <div class="box">
            <div class="content">
                <div class="box-body table-responsive">






                    <form action="" method="POST" id="create_cache">

                        <div class="panel panel-primary panel-H">
                            <div class="panel-heading panel-A">
                                <div class="panel-title">
                                    {{trans('admin.data_notics')}}
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    {{-- الشركه --}}
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="Cmp_No">{{trans('admin.company')}}</label>
                                            <input class="form-control" type="text" value="{{$cmp->Cmp_NmAr}}">
                                        </div>
                                    </div>
                                    {{-- نهاية الشركه --}}
                                    {{-- الفرع --}}
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="Dlv_Stor">{{trans('admin.section')}}</label>
                                            <input class="form-control" type="text" value="{{$brn->Brn_NmAr}}">
                                        </div>
                                    </div>
                                    {{-- نهاية الفرع --}}

                                    {{-- تاريخ القيد --}}
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="Tr_Dt">{{trans('admin.noti_date')}}</label>
                                            <input type="text" name="Tr_Dt" id="Tr_Dt" class="form-control" value="{{$gl->Tr_Dt}}">
                                        </div>
                                    </div>
                                    {{-- نهاية تاريخ القيد --}}

                                    {{-- مندوب المبيعات --}}
                                    <div id="sales_man_content">
                                        <div class="col-md-2">
                                            <label for="Salman_No_Name">{{trans('admin.sales_officer2')}}</label>
                                            <input type="text" name="Salman_No_Name" id="Salman_No_Name"  value="{{$gl->Pymt_To}}" class="form-control" disabled>
                                        </div>
                                    </div>
                                    {{-- نهاية مندوب المبيعات --}}
                                </div>
                            </div>
                        </div>



                        <div class="row">
                            <div class="col-md-12" id="table_view">
                                <table class="table" id="table">
                                    <thead>
                                    <th>{{trans('admin.Ln_No')}}</th>
                                    <th>{{trans('admin.account_number')}}</th>
                                    <th>{{trans('admin.account_name')}}</th>
                                    <th>{{trans('admin.motion_debtor')}}</th>
                                    <th>{{trans('admin.motion_creditor')}}</th>
                                    <th>{{trans('admin.note_ar')}}</th>
                                    <th>{{trans('admin.receipt_number')}}</th>
                                    <th>{{trans('admin.with_cc')}}</th>
                                    </thead>

                                    <tbody>
                                    <tr>
                                    @if(count($gltrns) > 0)
                                        @foreach($gltrns as $trns)
                                            <tr>
                                                @if($trns->Sysub_Account == 0)
                                                    <td>{{$trns->Ln_No}}</td>
                                                    <td>{{$trns->Acc_No}}</td>
                                                    <td>
                                                        {{\App\Models\Admin\MtsChartAc::where('Acc_No', $trns->Acc_No)->pluck('Acc_Nm'.ucfirst(session('lang')))->first()}}
                                                    </td>
                                                    <td>{{$trns->Tr_Db}}</td>
                                                    <td>{{$trns->Tr_Cr}}</td>
                                                    <td>{{$trns->Tr_Ds}}</td>
                                                    <td>{{$trns->Dc_No}}</td>
                                                    <td>
                                                        {{\App\Models\Admin\MtsCostcntr::where('Costcntr_No', $trns->Costcntr_No)->pluck('Costcntr_Nm'.session('lang'))->first()}}
                                                    </td>
                                                @else
                                                    <td>{{$trns->Ln_No}}</td>
                                                    <td>{{$trns->Sysub_Account}}</td>
                                                    <td>
                                                        @if($trns->Ac_Ty == 1)
                                                            {{\App\Models\Admin\MtsChartAc::where('Acc_No', $trns->Sysub_Account)->pluck('Acc_Nm'.ucfirst(session('lang')))->first()}}
                                                        @endif
                                                        @if($trns->Ac_Ty == 2)
                                                            {{\App\Models\Admin\MTsCustomer::where('Cstm_No', $trns->Sysub_Account)->pluck('Cstm_Nm'.ucfirst(session('lang')))->first()}}
                                                        @endif
                                                        @if($trns->Ac_Ty == 3)
                                                            {{\App\Models\Admin\MtsSuplir::where('Sup_No', $trns->Sysub_Account)->pluck('Sup_Nm'.ucfirst(session('lang')))->first()}}
                                                        @endif
                                                        @if($trns->Ac_Ty == 4)
                                                            Employees
                                                        @endif
                                                    </td>
                                                    <td>{{$trns->Tr_Db}}</td>
                                                    <td>{{$trns->Tr_Cr}}</td>
                                                    <td>{{$trns->Tr_Ds}}</td>
                                                    <td>{{$trns->Dc_No}}</td>
                                                    <td>
                                                        {{\App\Models\Admin\MtsCostcntr::where('Costcntr_No', $trns->Costcntr_No)->pluck('Costcntr_Nm'.session('lang'))->first()}}
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            {{$gl->Tot_Amunt}}
                                        </td>
                                        <td>
                                            {{$gl->Tr_Db}}
                                        </td>
                                        <td></td>
                                        @endif
                                        </tr>
                                    </tbody>

                                </table>

                                <div style="float:left;" class="col-md-3">
                                    <fieldset class="scheduler-border">
                                        <legend  class="w-auto">إجمالى سند الصرف</legend>
                                        <div class="control-group">
                                            <div class="controls bootstrap-timepicker">
                                                <label class="control-label input-label" for="">مدين :</label>
                                                {{$gl->Tr_Db}}
                                            </div>

                                            <div class="controls bootstrap-timepicker">
                                                <label class="control-label input-label" for="">دائن :</label>
                                                {{$gl->Tr_Cr}}
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                        </div>
                    </form>




















                    <div class="row" style="text-align:center;">
                        <a href="{{route('printCatchRecpt',$gl->Tr_No)}}" class="btn btn-primary" style="width:90px; height:60px;">
                            <i class="fa fa-print" style="font-size:40px;"></i>
                        </a>
                    </div>



                </div>
            </div>
        </div>



@endsection
