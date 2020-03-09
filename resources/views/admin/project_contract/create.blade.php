@extends('admin.index')
@section('title',trans('admin.add_project_contract'))
@section('content')
   @push('js')

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
    @endpush






    @hasanyrole('writer|admin')
    @can('create')
        <div class="box">
            @if (Session::has('message'))
                <div class="alert alert-info">{{ Session::get('message') }}</div>
            @endif
            {{-- @include('admin.layouts.message') --}}
            <div class="box-header">
                <h3 class="box-title">{{trans('admin.add_project_contract')}}</h3>
            </div>
            <div class="box-body">
                {!! Form::open(['method'=>'POST','route' => 'project_contract.store']) !!}


                <div class="form-group row">
                    <div class="col-md-4">
                        {{ Form::label('branche', trans('admin.branche'), ['class' => 'control-label']) }}
                        {{ Form::select('branche_id',$Branches, old('branche_id'), array_merge(['class' => 'form-control','placeholder'=>trans('admin.select')])) }}

                        @if ($errors->has('branche_id'))
                            <div class="alert alert-danger" style="margin-top: 10px">{{ $errors->first('branche_id') }}</div>
                        @endif
                    </div>
                    <div class="col-md-4">
                        {{ Form::label('date',trans('admin.date') , ['class' => 'control-label']) }}
                        {{ Form::text('date', old('date'), array_merge(['class' => 'form-control datepicker','id' => 'history_date_project','placeholder'=>trans('admin.date')])) }}
                        @if ($errors->has('date'))
                            <div class="alert alert-danger" style="margin-top: 10px">{{ $errors->first('date') }}</div>
                        @endif
                    </div>
                    <div class="col-md-4">
                        {{ Form::label('date_hijri',trans('admin.date_hijri') , ['class' => 'control-label']) }}
                        {{ Form::hidden('date_hijri', old('date_hijri'), array_merge(['class' => 'form-control higri_date_project','placeholder'=>trans('admin.higri_date')])) }}
                        {{ Form::text('date_hijrii', old('date_hijri'), array_merge(['class' => 'form-control higri_date_project','disabled' => 'disabled','placeholder'=>trans('admin.higri_date')])) }}
                        @if ($errors->has('date_hijri'))
                            <div class="alert alert-danger" style="margin-top: 10px">{{ $errors->first('date_hijri') }}</div>
                        @endif
                    </div>


                </div>
                <div class="form-group row">
                    <div class="col-md-12">
                        {{ Form::label('project_id',trans('admin.project_name') , ['class' => 'control-label']) }}
                        {{ Form::select('project_id',$Projects , old('project_id'), array_merge(['class' => 'form-control selected disbladed','placeholder'=>trans('admin.select')])) }}
                        @if ($errors->has('project_id'))
                            <div class="alert alert-danger" style="margin-top: 10px">{{ $errors->first('project_id') }}</div>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        {{ Form::label('note',trans('admin.notee') , ['class' => 'control-label']) }}
                        {{ Form::textarea('note', old('note'), array_merge(['class' => 'form-control','placeholder'=>trans('admin.note'),'cols' => '-58' ,'rows' => '-9'])) }}
                        @if ($errors->has('email'))
                            <div class="alert alert-danger" style="margin-top: 10px">{{ $errors->first('note') }}</div>
                        @endif
                    </div>
                    <div class="col-md-6">
                        {{ Form::label('note_en',trans('admin.notee_en') , ['class' => 'control-label']) }}
                        {{ Form::textarea('note_en', old('note_en'), array_merge(['class' => 'form-control','placeholder'=>trans('admin.note_en'),'cols' => '-58' ,'rows' => '-9'])) }}
                        @if ($errors->has('note_en'))
                            <div class="alert alert-danger" style="margin-top: 10px">{{ $errors->first('note') }}</div>
                        @endif
                    </div>
                </div>
                <br><br>
                <hr style="border : 1px solid #000">
                <br><br>
                <div class="form-group row">
                    <div class="col-md-3">
                        {{ Form::label('Date_contract',trans('admin.Date_contract') , ['class' => 'control-label']) }}
                        {{ Form::text('Date_contract', old('Date_contract'), array_merge(['class' => 'form-control datepicker'])) }}
                        @if ($errors->has('Date_contract'))
                            <div class="alert alert-danger" style="margin-top: 10px">{{ $errors->first('Date_contract') }}</div>
                        @endif
                    </div>
                    <div class="col-md-3">
                        {{ Form::label('beginning_contract',trans('admin.beginning_contract') , ['class' => 'control-label']) }}
                        {{ Form::text('beginning_contract', old('beginning_contract'), array_merge(['class' => 'form-control datepicker'])) }}
                        @if ($errors->has('beginning_contract'))
                            <div class="alert alert-danger" style="margin-top: 10px">{{ $errors->first('beginning_contract') }}</div>
                        @endif
                    </div>
                    <div class="col-md-3">
                        {{ Form::label('End_contract',trans('admin.End_contract') , ['class' => 'control-label']) }}
                        {{ Form::text('End_contract', old('End_contract'), array_merge(['class' => 'form-control datepicker'])) }}
                        @if ($errors->has('End_contract'))
                            <div class="alert alert-danger" style="margin-top: 10px">{{ $errors->first('End_contract') }}</div>
                        @endif
                    </div>
                    <div class="col-md-3">
                        {{ Form::label('period_contract',trans('admin.period_contract') , ['class' => 'control-label']) }}
                        {{ Form::text('period_contract', old('period_contract'), array_merge(['class' => 'form-control'])) }}
                        @if ($errors->has('period_contract'))
                            <div class="alert alert-danger" style="margin-top: 10px">{{ $errors->first('period_contract') }}</div>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3">
                        {{ Form::label('start_implementation',trans('admin.start_implementation') , ['class' => 'control-label']) }}
                        {{ Form::text('start_implementation', old('start_implementation'), array_merge(['class' => 'form-control datepicker'])) }}
                        @if ($errors->has('Date_contract'))
                            <div class="alert alert-danger" style="margin-top: 10px">{{ $errors->first('start_implementation') }}</div>
                        @endif
                    </div>
                    <div class="col-md-3">
                        {{ Form::label('end_implementation',trans('admin.end_implementation') , ['class' => 'control-label']) }}
                        {{ Form::text('end_implementation', old('end_implementation'), array_merge(['class' => 'form-control datepicker'])) }}
                        @if ($errors->has('end_implementation'))
                            <div class="alert alert-danger" style="margin-top: 10px">{{ $errors->first('end_implementation') }}</div>
                        @endif
                    </div>
                    <div class="col-md-3">
                        {{ Form::label('start_warranty',trans('admin.start_warranty') , ['class' => 'control-label']) }}
                        {{ Form::text('start_warranty', old('start_warranty'), array_merge(['class' => 'form-control datepicker'])) }}
                        @if ($errors->has('start_warranty'))
                            <div class="alert alert-danger" style="margin-top: 10px">{{ $errors->first('start_warranty') }}</div>
                        @endif
                    </div>
                    <div class="col-md-3">
                        {{ Form::label('end_warranty',trans('admin.end_warranty') , ['class' => 'control-label']) }}
                        {{ Form::text('end_warranty', old('end_warranty'), array_merge(['class' => 'form-control datepicker'])) }}
                        @if ($errors->has('end_warranty'))
                            <div class="alert alert-danger" style="margin-top: 10px">{{ $errors->first('end_warranty') }}</div>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-3">
                        {{ Form::label('number_employees',trans('admin.number_employees') , ['class' => 'control-label']) }}
                        {{ Form::text('number_employees', old('number_employees'), array_merge(['class' => 'form-control','placeholder'=>trans('admin.number_employees')])) }}
                        @if ($errors->has('number_employees'))
                            <div class="alert alert-danger" style="margin-top: 10px">{{ $errors->first('number_employees') }}</div>
                        @endif
                    </div>
                    <div class="col-md-3">
                        {{ Form::label('Hour_employee',trans('admin.Hour_employee') , ['class' => 'control-label']) }}
                        {{ Form::text('Hour_employee', old('Hour_employee'), array_merge(['class' => 'form-control','placeholder'=>trans('admin.Hour_employee')])) }}
                        @if ($errors->has('Hour_employee'))
                            <div class="alert alert-danger" style="margin-top: 10px">{{ $errors->first('Hour_employee') }}</div>
                        @endif
                    </div>
                    <div class="col-md-3">
                        {{ Form::label('number_months',trans('admin.number_months') , ['class' => 'control-label']) }}
                        {{ Form::text('number_months', old('number_months'), array_merge(['class' => 'form-control','placeholder'=>trans('admin.number_months')])) }}
                        @if ($errors->has('number_months'))
                            <div class="alert alert-danger" style="margin-top: 10px">{{ $errors->first('number_months') }}</div>
                        @endif
                    </div>
                    <div class="col-md-3">
                        {{ Form::label('monthly_payment',trans('admin.monthly_payment') , ['class' => 'control-label']) }}
                        {{ Form::text('monthly_payment', old('monthly_payment'), array_merge(['class' => 'form-control','placeholder'=>trans('admin.monthly_payment')])) }}
                        @if ($errors->has('monthly_payment'))
                            <div class="alert alert-danger" style="margin-top: 10px">{{ $errors->first('monthly_payment') }}</div>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3">
                        {{ Form::label('revenue_measurement',trans('admin.revenue_measurement') , ['class' => 'control-label']) }}
                        {{ Form::text('revenue_measurement', old('revenue_measurement'), array_merge(['class' => 'form-control','placeholder'=>trans('admin.revenue_measurement')])) }}
                        @if ($errors->has('revenue_measurement'))
                            <div class="alert alert-danger" style="margin-top: 10px">{{ $errors->first('revenue_measurement') }}</div>
                        @endif
                    </div>
                    <div class="col-md-3">
                        {{ Form::label('expenses_measurement',trans('admin.expenses_measurement') , ['class' => 'control-label']) }}
                        {{ Form::text('expenses_measurement', old('Hour_employee'), array_merge(['class' => 'form-control','placeholder'=>trans('admin.expenses_measurement')])) }}
                        @if ($errors->has('expenses_measurement'))
                            <div class="alert alert-danger" style="margin-top: 10px">{{ $errors->first('expenses_measurement') }}</div>
                        @endif
                    </div>
                    <div class="col-md-3">
                        {{ Form::label('cost_limit',trans('admin.cost_limit') , ['class' => 'control-label']) }}
                        {{ Form::text('cost_limit', old('cost_limit'), array_merge(['class' => 'form-control','placeholder'=>trans('admin.cost_limit')])) }}
                        @if ($errors->has('cost_limit'))
                            <div class="alert alert-danger" style="margin-top: 10px">{{ $errors->first('cost_limit') }}</div>
                        @endif
                    </div>
                    <div class="col-md-3">
                        {{ Form::label('actual_cost',trans('admin.actual_cost') , ['class' => 'control-label']) }}
                        {{ Form::text('actual_cost', old('actual_cost'), array_merge(['class' => 'form-control','placeholder'=>trans('admin.actual_cost')])) }}
                        @if ($errors->has('actual_cost'))
                            <div class="alert alert-danger" style="margin-top: 10px">{{ $errors->first('actual_cost') }}</div>
                        @endif
                    </div>
                </div>
                <br><br>
                <hr style="border : 1px solid #000">
                <br><br>

                <div class="form-group row">
                    <div class="col-md-4">
                        {{ Form::label('Estimated_value',trans('admin.Estimated_value') , ['class' => 'control-label']) }}
                        {{ Form::text('Estimated_value', old('Estimated_value'), array_merge(['class' => 'form-control','placeholder'=>trans('admin.Estimated_value')])) }}
                        @if ($errors->has('Estimated_value'))
                            <div class="alert alert-danger" style="margin-top: 10px">{{ $errors->first('Estimated_value') }}</div>
                        @endif
                    </div>
                    <div class="col-md-4">
                        {{ Form::label('contract_value',trans('admin.contract_value') , ['class' => 'control-label']) }}
                        {{ Form::text('contract_value', old('contract_value'), array_merge(['class' => 'form-control','placeholder'=>trans('admin.contract_value')])) }}
                        @if ($errors->has('contract_value'))
                            <div class="alert alert-danger" style="margin-top: 10px">{{ $errors->first('contract_value') }}</div>
                        @endif
                    </div>
                    <div class="col-md-4">
                        {{ Form::label('deviation_value',trans('admin.deviation_value') , ['class' => 'control-label']) }}
                        {{ Form::text('deviation_value', old('deviation_value'), array_merge(['class' => 'form-control','placeholder'=>trans('admin.deviation_value')])) }}
                        @if ($errors->has('deviation_value'))
                            <div class="alert alert-danger" style="margin-top: 10px">{{ $errors->first('deviation_value') }}</div>
                        @endif
                    </div>

                </div>
                <div class="form-group row">
                    <div class="col-md-4">
                        {{ Form::label('Bank_guarantee_number',trans('admin.Bank_guarantee_number') , ['class' => 'control-label']) }}
                        {{ Form::text('Bank_guarantee_number', old('Bank_guarantee_number'), array_merge(['class' => 'form-control','placeholder'=>trans('admin.Bank_guarantee_number')])) }}
                        @if ($errors->has('Bank_guarantee_number'))
                            <div class="alert alert-danger" style="margin-top: 10px">{{ $errors->first('Bank_guarantee_number') }}</div>
                        @endif
                    </div>
                    <div class="col-md-4">
                        {{ Form::label('warranty_history',trans('admin.warranty_history') , ['class' => 'control-label']) }}
                        {{ Form::text('warranty_history', old('warranty_history'), array_merge(['class' => 'form-control datepicker','placeholder'=>trans('admin.warranty_history')])) }}
                        @if ($errors->has('warranty_history'))
                            <div class="alert alert-danger" style="margin-top: 10px">{{ $errors->first('warranty_history') }}</div>
                        @endif
                    </div>
                    <div class="col-md-4">
                        {{ Form::label('amount_guarantee',trans('admin.amount_guarantee') , ['class' => 'control-label']) }}
                        {{ Form::text('amount_guarantee', old('amount_guarantee'), array_merge(['class' => 'form-control','placeholder'=>trans('admin.amount_guarantee')])) }}
                        @if ($errors->has('amount_guarantee'))
                            <div class="alert alert-danger" style="margin-top: 10px">{{ $errors->first('amount_guarantee') }}</div>
                        @endif
                    </div>

                </div>
                <div class="form-group row">
                    <div class="col-md-12">
                        {{ Form::label('warranty_issued',trans('admin.warranty_issued') , ['class' => 'control-label']) }}

                    </div>
                    <div class="col-md-6">
                        {{ Form::text('warranty_issued', old('warranty_issued'), array_merge(['class' => 'form-control','placeholder'=>trans('admin.warranty_issued')])) }}
                        @if ($errors->has('warranty_issued'))
                            <div class="alert alert-danger" style="margin-top: 10px">{{ $errors->first('warranty_issued') }}</div>
                        @endif
                    </div>

                    <div class="col-md-6">

                        {{ Form::text('warranty_issued_en', old('warranty_issued_en'), array_merge(['class' => 'form-control','placeholder'=>trans('admin.warranty_issued_en')])) }}
                        @if ($errors->has('warranty_issued_en'))
                            <div class="alert alert-danger" style="margin-top: 10px">{{ $errors->first('warranty_issued_en') }}</div>
                        @endif
                    </div>

                </div>
                <div class="form-group row">
                    <div class="col-md-3">
                        {{ Form::label('comprehensive_insurance',trans('admin.comprehensive_insurance') , ['class' => 'control-label']) }}
                        {{ Form::text('comprehensive_insurance', old('comprehensive_insurance'), array_merge(['class' => 'form-control','placeholder'=>trans('admin.comprehensive_insurance')])) }}
                        @if ($errors->has('comprehensive_insurance'))
                            <div class="alert alert-danger" style="margin-top: 10px">{{ $errors->first('comprehensive_insurance') }}</div>
                        @endif
                    </div>

                    <div class="col-md-3">
                        {{ Form::label('contractor_insurance',trans('admin.contractor_insurance') , ['class' => 'control-label']) }}
                        {{ Form::text('contractor_insurance', old('contractor_insurance'), array_merge(['class' => 'form-control','placeholder'=>trans('admin.contractor_insurance')])) }}
                        @if ($errors->has('contractor_insurance'))
                            <div class="alert alert-danger" style="margin-top: 10px">{{ $errors->first('contractor_insurance') }}</div>
                        @endif
                    </div>

                    <div class="col-md-3">
                        {{ Form::label('reference_retirement',trans('admin.reference_retirement') , ['class' => 'control-label']) }}
                        {{ Form::text('reference_retirement', old('reference_retirement'), array_merge(['class' => 'form-control','placeholder'=>trans('admin.reference_retirement')])) }}
                        @if ($errors->has('reference_retirement'))
                            <div class="alert alert-danger" style="margin-top: 10px">{{ $errors->first('reference_retirement') }}</div>
                        @endif
                    </div>


                    <div class="col-md-3">
                        {{ Form::label('subscriber_id',trans('admin.customer_name') , ['class' => 'control-label']) }}
                        {{ Form::select('subscriber_id',$subscription,old('subscriber_id'), array_merge(['class' => 'form-control','placeholder'=>trans('admin.select')])) }}
                        @if ($errors->has('subscriber_id'))
                            <div class="alert alert-danger" style="margin-top: 10px">{{ $errors->first('subscriber_id') }}</div>
                        @endif
                    </div>

                </div>

                <div class="form-group row">
                    <div class="col-md-3">
                        <div class="col-md-12">

                        {{ Form::label('management_expenses',trans('admin.management_expenses') , ['class' => 'control-label']) }}
                        </div>
                        <div class="col-md-6">
                        {{ Form::text('management_expenses_percentage', old('management_expenses_percentage'), array_merge(['class' => 'form-control','placeholder'=>trans('admin.management_expenses_percentage')])) }}

                          @if ($errors->has('management_expenses_percentage'))
                            <div class="alert alert-danger" style="margin-top: 10px">{{ $errors->first('management_expenses_percentage') }}</div>
                        @endif
                        </div>
                        <div class="col-md-6">

                            {{ Form::text('management_expenses', old('management_expenses'), array_merge(['class' => 'form-control','placeholder'=>trans('admin.management_expenses')])) }}

                            @if ($errors->has('management_expenses'))
                                <div class="alert alert-danger" style="margin-top: 10px">{{ $errors->first('management_expenses') }}</div>
                            @endif
                        </div>
                    </div>


                    <div class="col-md-3">
                        <div class="col-md-12">
                        {{ Form::label('department_expenses',trans('admin.department_expenses') , ['class' => 'control-label']) }}
                        </div>
                        <div class="col-md-6">
                            {{ Form::text('department_expenses_percentage', old('department_expenses_percentage'), array_merge(['class' => 'form-control','placeholder'=>trans('admin.department_expenses_percentage')])) }}

                            @if ($errors->has('department_expenses_percentage'))
                                <div class="alert alert-danger" style="margin-top: 10px">{{ $errors->first('department_expenses_percentage') }}</div>
                            @endif
                        </div>
                        <div class="col-md-6">

                            {{ Form::text('department_expenses', old('department_expenses'), array_merge(['class' => 'form-control','placeholder'=>trans('admin.department_expenses')])) }}

                            @if ($errors->has('department_expenses'))
                                <div class="alert alert-danger" style="margin-top: 10px">{{ $errors->first('department_expenses') }}</div>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="col-md-12">

                        {{ Form::label('warranty_period',trans('admin.warranty_period') , ['class' => 'control-label']) }}
                        </div>
                        <div class="col-md-6">
                            {{ Form::text('warranty_period_percentage', old('warranty_period_percentage'), array_merge(['class' => 'form-control','placeholder'=>trans('admin.warranty_period_percentage')])) }}

                            @if ($errors->has('warranty_period_percentage'))
                                <div class="alert alert-danger" style="margin-top: 10px">{{ $errors->first('warranty_period_percentage') }}</div>
                            @endif
                        </div>
                        <div class="col-md-6">

                            {{ Form::text('warranty_period', old('warranty_period'), array_merge(['class' => 'form-control','placeholder'=>trans('admin.warranty_period')])) }}

                            @if ($errors->has('warranty_period'))
                                <div class="alert alert-danger" style="margin-top: 10px">{{ $errors->first('warranty_period') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="col-md-12">
                        {{ Form::label('financial_expenses',trans('admin.financial_expenses') , ['class' => 'control-label']) }}
                        </div>
                        <div class="col-md-6">
                            {{ Form::text('financial_expenses_percentage', old('financial_expenses_percentage'), array_merge(['class' => 'form-control','placeholder'=>trans('admin.financial_expenses_percentage')])) }}

                            @if ($errors->has('financial_expenses_percentage'))
                                <div class="alert alert-danger" style="margin-top: 10px">{{ $errors->first('financial_expenses_percentage') }}</div>
                            @endif
                        </div>
                        <div class="col-md-6">

                            {{ Form::text('financial_expenses', old('financial_expenses'), array_merge(['class' => 'form-control','placeholder'=>trans('admin.financial_expenses')])) }}

                            @if ($errors->has('financial_expenses'))
                                <div class="alert alert-danger" style="margin-top: 10px">{{ $errors->first('financial_expenses') }}</div>
                            @endif
                        </div>
                    </div>

               </div>
                <div class="form-group row">
                    <div class="col-md-3">
                        <div class="col-md-12">
                        {{ Form::label('subtotal',trans('admin.subtotal') , ['class' => 'control-label']) }}
                        </div>
                        <div class="col-md-6">
                            {{ Form::text('subtotal_percentage', old('subtotal_percentage'), array_merge(['class' => 'form-control','placeholder'=>trans('admin.subtotal_percentage')])) }}

                            @if ($errors->has('subtotal_percentage'))
                                <div class="alert alert-danger" style="margin-top: 10px">{{ $errors->first('subtotal_percentage') }}</div>
                            @endif
                        </div>
                        <div class="col-md-6">

                            {{ Form::text('subtotal', old('subtotal'), array_merge(['class' => 'form-control','placeholder'=>trans('admin.subtotal')])) }}

                            @if ($errors->has('subtotal'))
                                <div class="alert alert-danger" style="margin-top: 10px">{{ $errors->first('subtotal') }}</div>
                            @endif
                        </div>
                    </div>


                    <div class="col-md-3">
                        <div class="col-md-12">
                        {{ Form::label('net_deviation',trans('admin.net_deviation') , ['class' => 'control-label']) }}
                        </div>
                        <div class="col-md-6">
                            {{ Form::text('net_deviation_percentage', old('net_deviation_percentage'), array_merge(['class' => 'form-control','placeholder'=>trans('admin.net_deviation_percentage')])) }}

                            @if ($errors->has('net_deviation_percentage'))
                                <div class="alert alert-danger" style="margin-top: 10px">{{ $errors->first('net_deviation_percentage') }}</div>
                            @endif
                        </div>
                        <div class="col-md-6">

                            {{ Form::text('net_deviation', old('net_deviation'), array_merge(['class' => 'form-control','placeholder'=>trans('admin.net_deviation')])) }}

                            @if ($errors->has('net_deviation'))
                                <div class="alert alert-danger" style="margin-top: 10px">{{ $errors->first('net_deviation') }}</div>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-3">
                        {{ Form::label('total_collection',trans('admin.total_collection') , ['class' => 'control-label']) }}


                            {{ Form::text('total_collection', old('total_collection'), array_merge(['class' => 'form-control','placeholder'=>trans('admin.total_collection')])) }}

                            @if ($errors->has('total_collection'))
                                <div class="alert alert-danger" style="margin-top: 10px">{{ $errors->first('total_collection') }}</div>
                            @endif

                    </div>
                    <div class="col-md-3">
                        {{ Form::label('current_balance',trans('admin.current_balance') , ['class' => 'control-label']) }}


                        {{ Form::text('current_balance', old('current_balance'), array_merge(['class' => 'form-control','placeholder'=>trans('admin.current_balance')])) }}

                        @if ($errors->has('current_balance'))
                            <div class="alert alert-danger" style="margin-top: 10px">{{ $errors->first('current_balance') }}</div>
                        @endif

                    </div>

                </div>
{{--                <div class="form-group row">--}}
{{--                    <div class="col-md-6">--}}
{{--                        {{ Form::label('customer_id',trans('admin.customer_name'), ['class' => 'control-label']) }}--}}
{{--                        {{ Form::select('customer_id',$employee, old('customer_id'), array_merge(['class' => 'form-control','placeholder'=>trans('admin.select')])) }}--}}
{{--                        @if ($errors->has('customer_id'))--}}
{{--                            <div class="alert alert-danger" style="margin-top: 10px">{{ $errors->first('customer_id') }}</div>--}}
{{--                        @endif--}}
{{--                    </div>--}}

{{--                </div>--}}

                {{Form::submit(trans('admin.add_new_project_contract'),['class'=>'btn btn-primary'])}}
                {!! Form::close() !!}
            </div>
        </div>
    @endcan
    @else
        <div class="alert alert-danger">{{trans('admin.you_cannt_see_invoice_because_you_dont_have_role_to_access')}}</div>

        @endhasanyrole
@endsection