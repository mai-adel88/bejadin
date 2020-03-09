<table class="table table-striped" style=" display: block;  overflow-x: auto; white-space: nowrap;">
    <thead>
        <tr>
            <th>{{trans('admin.id')}}</th>
            <th>{{trans('admin.account_number')}}</th>
            <th>{{trans('admin.account_name')}}</th>
            <th>{{trans('admin.amount_debtor')}}</th>
            <th>{{trans('admin.amount_creditor')}}</th>
            <th>{{trans('admin.note_ar')}}</th>
            <th>{{trans('admin.single_cc')}}</th>
            <th>{{trans('admin.Tr_Ds1')}}</th>
            <th>{{trans('admin.amount_paied_from_start')}}</th>
            <th>{{trans('admin.revision_cost')}}</th>
            <th>{{trans('admin.currency_debt')}}</th>
            <th>{{trans('admin.currency_credit')}}</th>
            <th>{{trans('admin.currency_cost')}}</th>
            <th>{{trans('admin.currency')}}</th>
            <th>{{trans('admin.cheq_status')}}</th>
            <th>{{trans('admin.check_number')}}</th>
            <th>{{trans('admin.Payment_date')}}</th>
            <th>{{trans('admin.Bnk_Nm')}}</th>
            <th>{{trans('admin.first_analysis')}}</th>
            <th>{{trans('admin.second_analysis')}}</th>
            <th>{{trans('admin.View')}}</th>
            <th>{{trans('admin.print')}}</th>
            <th>{{trans('admin.edit')}}</th>
            <th>{{trans('admin.delete')}}</th>
        </tr>
    </thead>
    <tbody>
        @if(count($gls) > 0)
            @foreach($gls as $gl)
                <tr>
                    <td>{{$gl->Tr_No}}</td>
                    <td>
                        @if($gl->Cstm_No) {{$gl->Cstm_No}} @endif
                        @if($gl->Sup_No) {{$gl->Sup_No}} @endif
                        @if($gl->Emp_No) {{$gl->Emp_No}} @endif
                        @if($gl->Chrt_No) {{$gl->Chrt_No}} @endif
                    </td>
                    <td>
                        @if($gl->Cstm_No)
                            {{\App\Models\Admin\MTsCustomer::where('Cstm_No', $gl->Cstm_No)->pluck('Cstm_Nm'.ucfirst(session('lang')))->first()}}
                        @endif
                        @if($gl->Sup_No)
                            {{\App\Models\Admin\MtsSuplir::where('Sup_No', $gl->Sup_No)->pluck('Sup_Nm'.ucfirst(session('lang')))->first()}}
                        @endif
                        @if($gl->Emp_No)
                            {{\App\Models\Admin\MTsCustomer::where('Cstm_No', $gl->Cstm_No)->pluck('Cstm_Nm'.ucfirst(session('lang')))->first()}}
                        @endif
                        @if($gl->Chrt_No)
                            {{\App\Models\Admin\MtsChartAc::where('Acc_No', $gl->Acc_No)->pluck('Acc_Nm'.ucfirst(session('lang')))->first()}}
                        @endif
                    </td>
                    <td>{{$gl->Tr_Db}}</td>
                    <td>{{$gl->Tr_Cr}}</td>
                    <td>{{$gl->Tr_Ds}}</td>
                    <td>{{\App\Models\Admin\GLjrnTrs::where('Tr_No', $gl->Tr_No)->pluck('Costcntr_No')->first()}}</td>
                    <td>{{$gl->Tr_Ds1}}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>{{$gl->Curncy_Rate}}</td>
                    <td>{{$gl->Curncy_No}}</td>
                    <td></td>
                    <td>{{$gl->Chq_no}}</td>
                    <td>{{$gl->Issue_Dt}}</td>
                    <td>{{$gl->Bnk_Nm}}</td>
                    <td></td>
                    <td></td>
                    <td>
                        <a href="{{route('rcatchs.show', $gl->Tr_No)}}" class="btn btn-info"><i class="fa fa-eye"></i></a>
                    </td>
                    <td>
                        <a href="../../receipts/print/{{$gl->Tr_No}}" class="btn btn-success"><i class="fa fa-print"></i></a>
                    </td>
                    <td>
                        <a href="{{route('rcatchs.edit', $gl->Tr_No)}}" class="btn btn-info"><i class="fa fa-edit"></i></a>
                    </td>
                    <td>
                        <form action="{{route('rcatchs.destroy', $gl->Tr_No)}}" method="POST">
                            {{csrf_field()}}
                            {{method_field('DELETE')}}
                            <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>