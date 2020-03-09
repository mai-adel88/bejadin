@extends('admin.index')
@section('title',trans('admin.edit_project_contract'))
@section('content')
    {{-- @push('js')

        <script>
            $('.datepicker').datepicker({
                format: 'yyyy-mm-dd',
                rtl: true,
                language: '{{session('lang')}}',
                inline:true,
                minDate: 0,
                autoclose:true,
                minDateTime: dateToday

            });
        </script>
    @endpush --}}
    @hasanyrole('writer|admin')
    @can('create')
        <div class="box">
            @include('admin.layouts.message')
            <div class="box-header">
                <h3 class="box-title">{{trans('admin.edit_project_contract')}}</h3>
            </div>
            <div class="box-body">
                {!! Form::model($projectcontract,['method'=>'PUT','route' => ['project_contract.update',$projectcontract->id]]) !!}
                <div class="form-group row">
                    <div class="col-md-6">
                        {{ Form::label('branche_id', trans('admin.branche'), ['class' => 'control-label']) }}
                        {{ Form::select('branche_id',$Branches, $projectcontract->branch_id, array_merge(['class' => 'form-control','placeholder'=>trans('admin.select')])) }}
                    </div>
                    <div class="col-md-6">
                        {{ Form::label('project_id', trans('admin.project_name'), ['class' => 'control-label']) }}
                        {{ Form::select('project_id',$Projects, $projectcontract->project_id, array_merge(['class' => 'form-control','placeholder'=>trans('admin.select')])) }}
                    </div>
                </div>


                <div class="form-group row">
                    <div class="col-md-6">
                        {{ Form::label('date',trans('admin.date') , ['class' => 'control-label']) }}
                        {{ Form::text('date', $projectcontract->date, array_merge(['class' => 'form-control datepicker','id' => 'history_date_project','placeholder'=>trans('admin.date')])) }}
                    </div>
                    <div class="col-md-6">
                        {{ Form::label('date_hijri',trans('admin.date_hijri') , ['class' => 'control-label']) }}
                        {{ Form::hidden('date_hijri', $projectcontract->date_hijri, array_merge(['class' => 'form-control higri_date_project','placeholder'=>trans('admin.higri_date')])) }}
                        {{ Form::text('date_hijrii', $projectcontract->date_hijri, array_merge(['class' => 'form-control higri_date_project','disabled' => 'disabled','placeholder'=>trans('admin.higri_date')])) }}
                    </div>


                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        {{ Form::label('note',trans('admin.notee') , ['class' => 'control-label']) }}
                        {{ Form::textarea('note', $projectcontract->note, array_merge(['class' => 'form-control','placeholder'=>trans('admin.notee'),'cols' => '-58' ,'rows' => '-9'])) }}
                    </div>
                    <div class="col-md-6">
                        {{ Form::label('note_en',trans('admin.notee_en') , ['class' => 'control-label']) }}
                        {{ Form::textarea('note_en', $projectcontract->note_en, array_merge(['class' => 'form-control','placeholder'=>trans('admin.note_en'),'cols' => '-58' ,'rows' => '-9'])) }}
                    </div>
                </div>
                <hr>
                <br>
                <div class="form-group row">
                    <div class="col-md-3">
                        {{ Form::label('Date_contract',trans('admin.Date_contract') , ['class' => 'control-label']) }}
                        {{ Form::date('Date_contract', $projectcontract->Date_contract, array_merge(['class' => 'form-control','placeholder'=>trans('admin.Date_contract')])) }}
                    </div>
                    <div class="col-md-3">
                        {{ Form::label('beginning_contract',trans('admin.beginning_contract') , ['class' => 'control-label']) }}
                        {{ Form::date('beginning_contract', $projectcontract->beginning_contract, array_merge(['class' => 'form-control','placeholder'=>trans('admin.beginning_contract')])) }}
                    </div>
                    <div class="col-md-3">
                        {{ Form::label('End_contract',trans('admin.End_contract') , ['class' => 'control-label']) }}
                        {{ Form::date('End_contract', $projectcontract->expenses, array_merge(['class' => 'form-control','placeholder'=>trans('admin.End_contract')])) }}
                    </div>
                    <div class="col-md-3">
                        {{ Form::label('period_contract',trans('admin.period_contract') , ['class' => 'control-label']) }}
                        {{ Form::text('period_contract', $projectcontract->period_contract, array_merge(['class' => 'form-control','placeholder'=>trans('admin.period_contract')])) }}
                    </div>
                </div>


                <br>
                <div class="form-group row">
                    <div class="col-md-3">
                        {{ Form::label('start_implementation',trans('admin.start_implementation') , ['class' => 'control-label']) }}
                        {{ Form::date('start_implementation', $projectcontract->start_implementation, array_merge(['class' => 'form-control','placeholder'=>trans('admin.start_implementation')])) }}
                    </div>
                    <div class="col-md-3">
                        {{ Form::label('end_implementation',trans('admin.end_implementation') , ['class' => 'control-label']) }}
                        {{ Form::date('end_implementation', $projectcontract->end_implementation, array_merge(['class' => 'form-control','placeholder'=>trans('admin.end_implementation')])) }}
                    </div>
                    <div class="col-md-3">
                        {{ Form::label('start_warranty',trans('admin.start_warranty') , ['class' => 'control-label']) }}
                        {{ Form::date('start_warranty', $projectcontract->start_warranty, array_merge(['class' => 'form-control','placeholder'=>trans('admin.start_warranty')])) }}
                    </div>
                    <div class="col-md-3">
                        {{ Form::label('end_warranty',trans('admin.end_warranty') , ['class' => 'control-label']) }}
                        {{ Form::date('end_warranty', $projectcontract->end_warranty, array_merge(['class' => 'form-control','placeholder'=>trans('admin.end_warranty')])) }}
                    </div>
                </div>





                <br>
                <div class="form-group row">
                    <div class="col-md-3">
                        {{ Form::label('number_employees',trans('admin.number_employees') , ['class' => 'control-label']) }}
                        {{ Form::text('number_employees', $projectcontract->number_employees, array_merge(['class' => 'form-control','placeholder'=>trans('admin.number_employees')])) }}
                    </div>
                    <div class="col-md-3">
                        {{ Form::label('Hour_employee',trans('admin.Hour_employee') , ['class' => 'control-label']) }}
                        {{ Form::text('Hour_employee', $projectcontract->Hour_employee, array_merge(['class' => 'form-control','placeholder'=>trans('admin.Hour_employee')])) }}
                    </div>
                    <div class="col-md-3">
                        {{ Form::label('number_months',trans('admin.number_months') , ['class' => 'control-label']) }}
                        {{ Form::text('number_months', $projectcontract->number_months, array_merge(['class' => 'form-control','placeholder'=>trans('admin.number_months')])) }}
                    </div>
                    <div class="col-md-3">
                        {{ Form::label('monthly_payment',trans('admin.monthly_payment') , ['class' => 'control-label']) }}
                        {{ Form::text('monthly_payment', $projectcontract->monthly_payment, array_merge(['class' => 'form-control','placeholder'=>trans('admin.monthly_payment')])) }}
                    </div>
                </div>


                <br>
                <div class="form-group row">
                    <div class="col-md-3">
                        {{ Form::label('revenue_measurement',trans('admin.revenue_measurement') , ['class' => 'control-label']) }}
                        {{ Form::text('revenue_measurement', $projectcontract->revenue_measurement, array_merge(['class' => 'form-control','placeholder'=>trans('admin.revenue_measurement')])) }}
                    </div>
                    <div class="col-md-3">
                        {{ Form::label('expenses_measurement',trans('admin.expenses_measurement') , ['class' => 'control-label']) }}
                        {{ Form::text('expenses_measurement', $projectcontract->expenses_measurement, array_merge(['class' => 'form-control','placeholder'=>trans('admin.expenses_measurement')])) }}
                    </div>
                    <div class="col-md-3">
                        {{ Form::label('cost_limit',trans('admin.cost_limit') , ['class' => 'control-label']) }}
                        {{ Form::text('cost_limit', $projectcontract->cost_limit, array_merge(['class' => 'form-control','placeholder'=>trans('admin.cost_limit')])) }}
                    </div>
                    <div class="col-md-3">
                        {{ Form::label('actual_cost',trans('admin.actual_cost') , ['class' => 'control-label']) }}
                        {{ Form::text('actual_cost', $projectcontract->actual_cost, array_merge(['class' => 'form-control','placeholder'=>trans('admin.actual_cost')])) }}
                    </div>
                </div>


                <hr>
                <br>
                <div class="form-group row">
                    <div class="col-md-3">
                        {{ Form::label('Estimated_value',trans('admin.Estimated_value') , ['class' => 'control-label']) }}
                        {{ Form::text('Estimated_value', $projectcontract->Estimated_value, array_merge(['class' => 'form-control','placeholder'=>trans('admin.Estimated_value')])) }}
                    </div>
                    <div class="col-md-3">
                        {{ Form::label('contract_value',trans('admin.contract_value') , ['class' => 'control-label']) }}
                        {{ Form::text('contract_value', $projectcontract->contract_value, array_merge(['class' => 'form-control','placeholder'=>trans('admin.contract_value')])) }}
                    </div>
                    <div class="col-md-3">
                        {{ Form::label('Bank_guarantee_number',trans('admin.Bank_guarantee_number') , ['class' => 'control-label']) }}
                        {{ Form::text('Bank_guarantee_number', $projectcontract->Bank_guarantee_number, array_merge(['class' => 'form-control','placeholder'=>trans('admin.Bank_guarantee_number')])) }}
                    </div>
                    <div class="col-md-3">
                        {{ Form::label('warranty_history',trans('admin.warranty_history') , ['class' => 'control-label']) }}
                        {{ Form::text('warranty_history', $projectcontract->warranty_history, array_merge(['class' => 'form-control','placeholder'=>trans('admin.warranty_history')])) }}
                    </div>
                </div>
                <br>
                <div class="form-group row">
                    <div class="col-md-6">
                        {{ Form::label('amount_guarantee',trans('admin.amount_guarantee') , ['class' => 'control-label']) }}
                        {{ Form::text('amount_guarantee', $projectcontract->amount_guarantee, array_merge(['class' => 'form-control','placeholder'=>trans('admin.amount_guarantee')])) }}
                    </div>
                    <div class="col-md-6">
                        {{ Form::label('deviation_value',trans('admin.deviation_value') , ['class' => 'control-label']) }}
                        {{ Form::text('deviation_value', $projectcontract->deviation_value, array_merge(['class' => 'form-control','placeholder'=>trans('admin.deviation_value')])) }}
                    </div>

                </div>
                <br>
                <div class="form-group row">

                    <div class="col-md-6">
                        {{ Form::label('warranty_issued',trans('admin.warranty_issued') , ['class' => 'control-label']) }}

                        {{ Form::textarea('warranty_issued', $projectcontract->warranty_issued, array_merge(['class' => 'form-control','placeholder'=>trans('admin.warranty_issued'),'cols' => '-58' ,'rows' => '-9'])) }}
                    </div>
                    <div class="col-md-6">
                        {{ Form::label('warranty_issued_en',trans('admin.warranty_issued_en') , ['class' => 'control-label']) }}

                        {{ Form::textarea('warranty_issued_en', $projectcontract->warranty_issued_en, array_merge(['class' => 'form-control','placeholder'=>trans('admin.warranty_issued_en'),'cols' => '-58' ,'rows' => '-9'])) }}
                    </div>

                </div>
                <br>
                <div class="form-group row">

                    <div class="col-md-3">
                        {{ Form::label('comprehensive_insurance',trans('admin.comprehensive_insurance') , ['class' => 'control-label']) }}

                        {{ Form::text('comprehensive_insurance', $projectcontract->comprehensive_insurance, array_merge(['class' => 'form-control','placeholder'=>trans('admin.comprehensive_insurance')])) }}
                    </div>
                    <div class="col-md-3">
                        {{ Form::label('contractor_insurance',trans('admin.contractor_insurance') , ['class' => 'control-label']) }}

                        {{ Form::text('contractor_insurance', $projectcontract->contractor_insurance, array_merge(['class' => 'form-control','placeholder'=>trans('admin.contractor_insurance')])) }}
                    </div>
                    <div class="col-md-3">
                        {{ Form::label('reference_retirement',trans('admin.reference_retirement') , ['class' => 'control-label']) }}

                        {{ Form::text('reference_retirement', $projectcontract->reference_retirement, array_merge(['class' => 'form-control','placeholder'=>trans('admin.reference_retirement')])) }}
                    </div>
                    <div class="col-md-3">
                        {{ Form::label('subscriber_id',trans('admin.customer_name') , ['class' => 'control-label']) }}

                        {{ Form::select('subscriber_id',$subscription , $projectcontract->subscriber_id, array_merge(['class' => 'form-control','placeholder'=>trans('admin.customer_name')])) }}
                    </div>


                </div>
                <br>
                <div class="form-group row">

                    <div class="col-md-3">
                        <div class="row">
                            <div class="col-md-12">

                                {{ Form::label('management_expenses',trans('admin.management_expenses') , ['class' => 'control-label']) }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                {{ Form::text('management_expenses_percentage', $projectcontract->management_expenses_percentage, array_merge(['class' => 'form-control','placeholder'=>trans('admin.management_expenses_percentage')])) }}
                            </div>
                            <div class="col-md-6">
                        {{ Form::text('management_expenses', $projectcontract->management_expenses, array_merge(['class' => 'form-control','placeholder'=>trans('admin.management_expenses')])) }}
                            </div>
                    </div>


                    </div>

                    <div class="col-md-3">
                        <div class="row">
                            <div class="col-md-12">

                                {{ Form::label('department_expenses',trans('admin.department_expenses') , ['class' => 'control-label']) }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                {{ Form::text('department_expenses_percentage', $projectcontract->department_expenses_percentage, array_merge(['class' => 'form-control','placeholder'=>trans('admin.department_expenses_percentage')])) }}
                            </div>
                            <div class="col-md-6">
                                {{ Form::text('department_expenses', $projectcontract->department_expenses, array_merge(['class' => 'form-control','placeholder'=>trans('admin.department_expenses')])) }}
                            </div>
                        </div>


                    </div>


                    <div class="col-md-3">
                        <div class="row">
                            <div class="col-md-12">

                                {{ Form::label('warranty_period',trans('admin.warranty_period') , ['class' => 'control-label']) }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                {{ Form::text('warranty_period_percentage', $projectcontract->warranty_period_percentage, array_merge(['class' => 'form-control','placeholder'=>trans('admin.warranty_period_percentage')])) }}
                            </div>
                            <div class="col-md-6">
                                {{ Form::text('warranty_period', $projectcontract->warranty_period, array_merge(['class' => 'form-control','placeholder'=>trans('admin.warranty_period')])) }}
                            </div>
                        </div>


                    </div>




                    <div class="col-md-3">
                        <div class="row">
                            <div class="col-md-12">

                                {{ Form::label('financial_expenses_percentage',trans('admin.financial_expenses') , ['class' => 'control-label']) }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                {{ Form::text('financial_expenses_percentage', $projectcontract->financial_expenses_percentage, array_merge(['class' => 'form-control','placeholder'=>trans('admin.financial_expenses_percentage')])) }}
                            </div>
                            <div class="col-md-6">
                                {{ Form::text('financial_expenses', $projectcontract->financial_expenses, array_merge(['class' => 'form-control','placeholder'=>trans('admin.financial_expenses')])) }}
                            </div>
                        </div>


                    </div>
                </div>




                <br>
                <div class="form-group row">

                    <div class="col-md-3">
                        <div class="row">
                            <div class="col-md-12">

                                {{ Form::label('subtotal',trans('admin.subtotal') , ['class' => 'control-label']) }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                {{ Form::text('subtotal_percentage', $projectcontract->subtotal_percentage, array_merge(['class' => 'form-control','placeholder'=>trans('admin.subtotal_percentage')])) }}
                            </div>
                            <div class="col-md-6">
                                {{ Form::text('subtotal', $projectcontract->subtotal, array_merge(['class' => 'form-control','placeholder'=>trans('admin.subtotal')])) }}
                            </div>
                        </div>


                    </div>
                    <div class="col-md-3">
                        <div class="row">
                            <div class="col-md-12">

                                {{ Form::label('net_deviation',trans('admin.net_deviation') , ['class' => 'control-label']) }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                {{ Form::text('net_deviation_percentage', $projectcontract->net_deviation_percentage, array_merge(['class' => 'form-control','placeholder'=>trans('admin.net_deviation_percentage')])) }}
                            </div>
                            <div class="col-md-6">
                                {{ Form::text('net_deviation', $projectcontract->net_deviation, array_merge(['class' => 'form-control','placeholder'=>trans('admin.net_deviation')])) }}
                            </div>
                        </div>


                    </div>
                    <div class="col-md-3">
                        {{ Form::label('total_collection',trans('admin.total_collection') , ['class' => 'control-label']) }}

                        {{ Form::text('total_collection', $projectcontract->total_collection, array_merge(['class' => 'form-control','placeholder'=>trans('admin.total_collection')])) }}
                    </div>
                    <div class="col-md-3">
                        {{ Form::label('current_balance',trans('admin.current_balance') , ['class' => 'control-label']) }}
                        {{ Form::text('current_balance', $projectcontract->current_balance, array_merge(['class' => 'form-control','placeholder'=>trans('admin.current_balance')])) }}

                    </div>


                </div>






                {{Form::submit('تعديل',['class'=>'btn btn-primary'])}}
                {!! Form::close() !!}
            </div>
        </div>
    @endcan
    @else
        <div class="alert alert-danger">{{trans('admin.you_cannt_see_invoice_because_you_dont_have_role_to_access')}}</div>

        @endhasanyrole







@endsection

