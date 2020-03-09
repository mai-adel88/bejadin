@extends('admin.index')
@section('title',trans('admin.Add_a_contract'))
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
        {{--  @include('admin.layouts.message')  --}}
        <div class="box-header">
            <h3 class="box-title">{{trans('admin.Add_a_contract')}}</h3>
        </div>
        <div class="box-body">
            {!! Form::open(['method'=>'POST','route' => 'contracts.store']) !!}
            <div class="form-group row">
                <div class="col-md-3">
                    {{ Form::label('section_id', trans('admin.section'), ['class' => 'control-label']) }}
                    {{ Form::select('section_id',$branches, old('section_id'), array_merge(['class' => 'form-control','placeholder'=>trans('admin.select')])) }}
                    @if ($errors->has('section_id'))
                        <div class="alert alert-danger" style="margin-top: 10px">{{ $errors->first('section_id') }}</div>
                    @endif
                </div>
                <div class="col-md-3">
                    {{ Form::label('date',trans('admin.date') , ['class' => 'control-label']) }}
                    {{ Form::text('date', old('date'), array_merge(['class' => 'form-control datepicker','id' => 'history_date','placeholder'=>trans('admin.date')])) }}
                    @if ($errors->has('date'))
                        <div class="alert alert-danger" style="margin-top: 10px">{{ $errors->first('date') }}</div>
                    @endif
                </div>
                <div class="col-md-3">
                    {{ Form::label('higri_date',trans('admin.higri_date') , ['class' => 'control-label']) }}
                    {{ Form::hidden('higri_date', old('higri_date'), array_merge(['class' => 'form-control higri_date','placeholder'=>trans('admin.higri_date')])) }}
                    {{ Form::text('higri_datee', old('higri_date'), array_merge(['class' => 'form-control higri_date','disabled' => 'disabled','placeholder'=>trans('admin.higri_date')])) }}
                    @if ($errors->has('higri_date'))
                        <div class="alert alert-danger" style="margin-top: 10px">{{ $errors->first('higri_date') }}</div>
                    @endif
                </div>
                <div class="col-md-3">
                    {{ Form::label('project_id', trans('admin.project_name'), ['class' => 'control-label']) }}
                    {{ Form::select('project_id',$project, old('project_id'), array_merge(['class' => 'form-control','placeholder'=>trans('admin.select')])) }}
                    @if ($errors->has('project_id'))
                        <div class="alert alert-danger" style="margin-top: 10px">{{ $errors->first('project_id') }}</div>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-3">
                    {{ Form::label('contractor_id', trans('admin.contractor_name'), ['class' => 'control-label']) }}
                    {{ Form::select('contractor_id',$contractors, old('contractor_id'), array_merge(['class' => 'form-control','placeholder'=>trans('admin.select')])) }}
                    @if ($errors->has('contractor_id'))
                        <div class="alert alert-danger" style="margin-top: 10px">{{ $errors->first('contractor_id') }}</div>
                    @endif
                </div>
                <div class="col-md-3">
                    {{ Form::label('Contract_reference',trans('admin.Reference_for_contracting') , ['class' => 'control-label']) }}
                    {{ Form::number('Contract_reference', old('Contract_reference'), array_merge(['class' => 'form-control','placeholder'=>trans('admin.Reference_for_contracting')])) }}
                    @if ($errors->has('Contract_reference'))
                        <div class="alert alert-danger" style="margin-top: 10px">{{ $errors->first('Contract_reference') }}</div>
                    @endif
                </div>
                <div class="col-md-3">
                    {{ Form::label('contract_number',trans('admin.contract_number') , ['class' => 'control-label']) }}
                    {{ Form::number('contract_number', old('contract_number'), array_merge(['class' => 'form-control','placeholder'=>trans('admin.contract_number')])) }}
                    @if ($errors->has('contract_number'))
                        <div class="alert alert-danger" style="margin-top: 10px">{{ $errors->first('contract_number') }}</div>
                    @endif
                </div>
                <div class="col-md-3">
                    {{ Form::label('subscriber_id', trans('admin.Subscribers'), ['class' => 'control-label']) }}
                    {{ Form::select('subscriber_id',$subscription, old('subscriber_id'), array_merge(['class' => 'form-control','placeholder'=>trans('admin.select')])) }}
                    @if ($errors->has('subscriber_id'))
                        <div class="alert alert-danger" style="margin-top: 10px">{{ $errors->first('subscriber_id') }}</div>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-6">
                    {{ Form::label('statement_ar', trans('admin.Statement_ar'), ['class' => 'control-label']) }}
                    {{ Form::text('statement_ar', old('statement_ar'), array_merge(['class' => 'form-control','placeholder'=>trans('admin.Statement_ar')])) }}
                    @if ($errors->has('statement_ar'))
                        <div class="alert alert-danger" style="margin-top: 10px">{{ $errors->first('statement_ar') }}</div>
                    @endif
                </div>
                <div class="col-md-6">
                    {{ Form::label('statement_en', trans('admin.Statement_en'), ['class' => 'control-label']) }}
                    {{ Form::text('statement_en', old('statement_en'), array_merge(['class' => 'form-control','placeholder'=>trans('admin.Statement_en')])) }}
                    @if ($errors->has('statement_en'))
                        <div class="alert alert-danger" style="margin-top: 10px">{{ $errors->first('statement_en') }}</div>
                    @endif
                </div>
            </div>
            <hr>
            <div class="form-group row">
                <div class="col-md-3">
                    {{ Form::label('contract_date',trans('admin.Date_of_contract') , ['class' => 'control-label']) }}
                    {{ Form::text('contract_date', old('contract_date'), array_merge(['class' => 'form-control datepicker','placeholder'=>trans('admin.Date_of_contract')])) }}
                    @if ($errors->has('contract_date'))
                        <div class="alert alert-danger" style="margin-top: 10px">{{ $errors->first('contract_date') }}</div>
                    @endif
                </div>
                <div class="col-md-3">
                    {{ Form::label('contract_start',trans('admin.The_beginning_of_the_contract') , ['class' => 'control-label']) }}
                    {{ Form::text('contract_start', old('contract_start'), array_merge(['class' => 'form-control datepicker','id' => 'contract_start','placeholder'=>trans('admin.The_beginning_of_the_contract')])) }}
                    @if ($errors->has('contract_start'))
                        <div class="alert alert-danger" style="margin-top: 10px">{{ $errors->first('contract_start') }}</div>
                    @endif
                </div>
                <div class="col-md-3">
                    {{ Form::label('contract_end',trans('admin.End_of_contract') , ['class' => 'control-label']) }}
                    {{ Form::text('contract_end', old('contract_end'), array_merge(['class' => 'form-control datepicker','placeholder'=>trans('admin.End_of_contract')])) }}
                    @if ($errors->has('contract_end'))
                        <div class="alert alert-danger" style="margin-top: 10px">{{ $errors->first('contract_end') }}</div>
                    @endif
                </div>
                <div class="col-md-3">
                    {{ Form::label('contract_period',trans('admin.Contract_Period') , ['class' => 'control-label']) }}
                    {{ Form::text('contract_period', old('contract_period'), array_merge(['class' => 'form-control','id' => 'contract_period','placeholder'=>trans('admin.Contract_Period')])) }}
                    @if ($errors->has('contract_period'))
                        <div class="alert alert-danger" style="margin-top: 10px">{{ $errors->first('contract_period') }}</div>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-3">
                    {{ Form::label('implementation_start',trans('admin.Start_of_implementation') , ['class' => 'control-label']) }}
                    {{ Form::text('implementation_start', old('implementation_start'), array_merge(['class' => 'form-control datepicker','placeholder'=>trans('admin.Start_of_implementation')])) }}
                    @if ($errors->has('implementation_start'))
                        <div class="alert alert-danger" style="margin-top: 10px">{{ $errors->first('implementation_start') }}</div>
                    @endif
                </div>
                <div class="col-md-3">
                    {{ Form::label('implementation_end',trans('admin.End_of_implementation') , ['class' => 'control-label']) }}
                    {{ Form::text('implementation_end', old('implementation_end'), array_merge(['class' => 'form-control datepicker','placeholder'=>trans('admin.End_of_implementation')])) }}
                    @if ($errors->has('implementation_end'))
                        <div class="alert alert-danger" style="margin-top: 10px">{{ $errors->first('implementation_end') }}</div>
                    @endif
                </div>
                <div class="col-md-3">
                    {{ Form::label('warranty_start',trans('admin.The_beginning_of_the_warranty') , ['class' => 'control-label']) }}
                    {{ Form::text('warranty_start', old('warranty_start'), array_merge(['class' => 'form-control datepicker','placeholder'=>trans('admin.The_beginning_of_the_warranty')])) }}
                    @if ($errors->has('warranty_start'))
                        <div class="alert alert-danger" style="margin-top: 10px">{{ $errors->first('warranty_start') }}</div>
                    @endif
                </div>
                <div class="col-md-3">
                    {{ Form::label('warranty_end',trans('admin.End_of_warranty') , ['class' => 'control-label']) }}
                    {{ Form::text('warranty_end', old('warranty_end'), array_merge(['class' => 'form-control datepicker','placeholder'=>trans('admin.End_of_warranty')])) }}
                    @if ($errors->has('warranty_end'))
                        <div class="alert alert-danger" style="margin-top: 10px">{{ $errors->first('warranty_end') }}</div>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-3">
                    {{ Form::label('employees_number',trans('admin.Number_of_Employees') , ['class' => 'control-label']) }}
                    {{ Form::number('employees_number', '0', array_merge(['class' => 'form-control','placeholder'=>trans('admin.Number_of_Employees')])) }}
                    @if ($errors->has('employees_number'))
                        <div class="alert alert-danger" style="margin-top: 10px">{{ $errors->first('employees_number') }}</div>
                    @endif
                </div>
                <div class="col-md-3">
                    {{ Form::label('employee_hour_work',trans('admin.Working_hours_of_the_employee') , ['class' => 'control-label']) }}
                    {{ Form::number('employee_hour_work', '0', array_merge(['class' => 'form-control','placeholder'=>trans('admin.Working_hours_of_the_employee')])) }}
                    @if ($errors->has('employee_hour_work'))
                        <div class="alert alert-danger" style="margin-top: 10px">{{ $errors->first('employee_hour_work') }}</div>
                    @endif
                </div>
                <div class="col-md-3">
                    {{ Form::label('months_number',trans('admin.Number_of_months') , ['class' => 'control-label']) }}
                    {{ Form::number('months_number', '0', array_merge(['class' => 'form-control','placeholder'=>trans('admin.Number_of_months')])) }}
                    @if ($errors->has('months_number'))
                        <div class="alert alert-danger" style="margin-top: 10px">{{ $errors->first('months_number') }}</div>
                    @endif
                </div>
                <div class="col-md-3">
                    {{ Form::label('monthly_payment',trans('admin.Monthly_payment') , ['class' => 'control-label']) }}
                    {{ Form::number('monthly_payment', '0', array_merge(['class' => 'form-control','placeholder'=>trans('admin.Monthly_payment')])) }}
                    @if ($errors->has('monthly_payment'))
                        <div class="alert alert-danger" style="margin-top: 10px">{{ $errors->first('monthly_payment') }}</div>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-4">
                    {{ Form::label('contract_value',trans('admin.Contract_Value') , ['class' => 'control-label']) }}
                    {{ Form::number('contract_value', '0', array_merge(['class' => 'form-control','placeholder'=>trans('admin.Contract_Value')])) }}
                    @if ($errors->has('contract_value'))
                        <div class="alert alert-danger" style="margin-top: 10px">{{ $errors->first('contract_value') }}</div>
                    @endif
                </div>
                <div class="col-md-4">
                    {{ Form::label('estimated_value',trans('admin.Estimated_Value') , ['class' => 'control-label']) }}
                    {{ Form::number('estimated_value', '0', array_merge(['class' => 'form-control','placeholder'=>trans('admin.Estimated_Value')])) }}
                    @if ($errors->has('estimated_value'))
                        <div class="alert alert-danger" style="margin-top: 10px">{{ $errors->first('estimated_value') }}</div>
                    @endif
                </div>
                <div class="col-md-4">
                    {{ Form::label('deviation_value',trans('admin.Deviation_value') , ['class' => 'control-label']) }}
                    {{ Form::number('deviation_value', '0', array_merge(['class' => 'form-control','placeholder'=>trans('admin.Deviation_value')])) }}
                    @if ($errors->has('deviation_value'))
                        <div class="alert alert-danger" style="margin-top: 10px">{{ $errors->first('deviation_value') }}</div>
                    @endif
                </div>
                {{--  <div class="col-md-3">
                    {{ Form::label('deviation_value_pc',trans('admin.Percentage_deviation_value') , ['class' => 'control-label']) }}
                    {{ Form::number('deviation_value_pc', '0', array_merge(['class' => 'form-control','placeholder'=>trans('admin.Percentage_deviation_value')])) }}
                    @if ($errors->has('deviation_value_pc'))
                        <div class="alert alert-danger" style="margin-top: 10px">{{ $errors->first('deviation_value_pc') }}</div>
                    @endif
                </div>  --}}
            </div>
            <hr>
            <div class="form-group row">
                <div class="col-md-4">
                    {{ Form::label('downpayment',trans('admin.Downpayment') , ['class' => 'control-label']) }}
                    {{ Form::number('downpayment', '0', array_merge(['class' => 'form-control','placeholder'=>trans('admin.Downpayment')])) }}
                    @if ($errors->has('downpayment'))
                        <div class="alert alert-danger" style="margin-top: 10px">{{ $errors->first('downpayment') }}</div>
                    @endif
                </div>
                <div class="col-md-4">
                    {{ Form::label('warranty_expenses',trans('admin.Warranty_expenses') , ['class' => 'control-label']) }}
                    {{ Form::number('warranty_expenses', '0', array_merge(['class' => 'form-control','placeholder'=>trans('admin.Warranty_expenses')])) }}
                    @if ($errors->has('warranty_expenses'))
                        <div class="alert alert-danger" style="margin-top: 10px">{{ $errors->first('warranty_expenses') }}</div>
                    @endif
                </div>
                <div class="col-md-4">
                    {{ Form::label('insurance_value',trans('admin.insurance_value') , ['class' => 'control-label']) }}
                    {{ Form::number('insurance_value', '0', array_merge(['class' => 'form-control','placeholder'=>trans('admin.insurance_value')])) }}
                    @if ($errors->has('insurance_value'))
                        <div class="alert alert-danger" style="margin-top: 10px">{{ $errors->first('insurance_value') }}</div>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-3">
                    {{ Form::label('contract_value_customer',trans('admin.The_contract_value_of_the_customer') , ['class' => 'control-label']) }}
                    {{ Form::number('contract_value_customer', '0', array_merge(['class' => 'form-control','placeholder'=>trans('admin.The_contract_value_of_the_customer')])) }}
                    @if ($errors->has('contract_value_customer'))
                        <div class="alert alert-danger" style="margin-top: 10px">{{ $errors->first('contract_value_customer') }}</div>
                    @endif
                </div>
                <div class="col-md-3">
                    {{ Form::label('subcontracts_value',trans('admin.Value_of_Subcontracts') , ['class' => 'control-label']) }}
                    {{ Form::number('subcontracts_value', '0', array_merge(['class' => 'form-control','placeholder'=>trans('admin.Value_of_Subcontracts')])) }}
                    @if ($errors->has('subcontracts_value'))
                        <div class="alert alert-danger" style="margin-top: 10px">{{ $errors->first('subcontracts_value') }}</div>
                    @endif
                </div>
                <div class="col-md-3">
                    {{ Form::label('total_payments',trans('admin.Total_Payments') , ['class' => 'control-label']) }}
                    {{ Form::number('total_payments', '0', array_merge(['class' => 'form-control','placeholder'=>trans('admin.Total_Payments')])) }}
                    @if ($errors->has('total_payments'))
                        <div class="alert alert-danger" style="margin-top: 10px">{{ $errors->first('total_payments') }}</div>
                    @endif
                </div>
                <div class="col-md-3">
                    {{ Form::label('current_balance',trans('admin.current_balance') , ['class' => 'control-label']) }}
                    {{ Form::number('current_balance', '0', array_merge(['class' => 'form-control','placeholder'=>trans('admin.current_balance')])) }}
                    @if ($errors->has('current_balance'))
                        <div class="alert alert-danger" style="margin-top: 10px">{{ $errors->first('current_balance') }}</div>
                    @endif
                </div>
            </div>
            {{Form::submit(trans('admin.Add_a_contract'),['class'=>'btn btn-primary'])}}
            {!! Form::close() !!}
        </div>
    </div>

    @endcan
@else
    <div class="alert alert-danger">{{trans('admin.you_cannt_see_invoice_because_you_dont_have_role_to_access')}}</div>

@endhasanyrole







@endsection
