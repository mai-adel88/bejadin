@extends('admin.index')
{{-- @section('title', trans('admin.data_project_single') .' '.session_lang($project->name_en,$project->name_ar)) --}}
@section('content')
    @push('css')
        <style>
            .list-group-item {
                padding: 30px 15px !important;
            }
        </style>

    @endpush


    <div class="row">


            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#activity" data-toggle="tab">{{trans('admin.project_contract')}}</a></li>
                </ul>
                <div class="tab-content">


{{--                    <div class="active tab-pane" id="activity">--}}
                        <div class="row">
                          <div class="col-md-4">

                                  <div class="col-md-6">
                                      <strong>
                                          {{trans('admin.name_branch')}}
                                      </strong>
                                  </div>
                                  <div class="col-md-6">
                                      :     {{session_lang($branches->name_en,$branches->name_ar)}}
                                  </div>


                          </div>

                            <div class="col-md-4">
                                <div class="col-md-6">
                                    <strong>
                                        {{trans('admin.date')}}
                                    </strong>
                                </div>
                                <div class="col-md-6">
                                    :     {{$projectcontract->date}}

                                </div>
                            </div>

                            <div class="col-md-4">
                            <div class="col-md-6">
                                <strong>
                                    {{trans('admin.date_hijri')}}
                                </strong>
                            </div>
                            <div class="col-md-6">
                                :     {{$projectcontract->date_hijri}}
                            </div>
                        </div>
                        </div>
                    <br>
                    <div class='row'>
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <strong>
                                    {{trans('admin.project_name')}}:
                                </strong>
                            </div>
                            <div class="col-md-6">
                                    {{$projectcontract->project[0]->name_ar}}
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class='row'>
                        <div class="col-md-12">
{{--                        @if(app()->getLocale() === 'ar')--}}
{{--                      --}}
                        <div class="col-md-3">
                            <strong>
                                   {{trans('admin.notee')}}

                           </strong>
                         </div>
                            <div class="col-md-3">
                                :     {{$projectcontract->note}}
                            </div>
                            <div class="col-md-3">

                                    <strong>
                                        {{trans('admin.notee_en')}}
                                    </strong>
                            </div>
                                    <div class="col-md-3">
                                        :     {{$projectcontract->note_en}}
                                    </div>
                                </div>

                        </div>
                    </div>
                            <br>
                <hr>

                            <div class="row">
                                    <div class="col-md-12">
                                               <div class="col-md-3">
                                                        <div class="col-md-5">
                                                        <strong>
                                                            {{trans('admin.Date_contract')}}
                                                        </strong>
                                                        </div>
                                                    <div class="col-md-7">
                                                        :     {{$projectcontract->Date_contract}}
                                                    </div>
                                            </div>
                                        <div class="col-md-3">
                                                                <div class="col-md-5">
                                                                    <strong>
                                                                        {{trans('admin.beginning_contract')}}
                                                                    </strong>
                                                                </div>
                                                                <div class="col-md-7">
                                                                    :     {{$projectcontract->beginning_contract	}}
                                                                </div>
                                        </div>
                                        <div class="col-md-3">

                                            <div class="col-md-5">
                                                <strong>
                                                    {{trans('admin.End_contract')}}
                                                </strong>
                                            </div>
                                            <div class="col-md-7">
                                                :     {{$projectcontract->End_contract	}}
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="col-md-6">
                                            <strong>
                                                {{trans('admin.period_contract')}}
                                            </strong>
                                        </div>
                                        <div class="col-md-6">
                                            :     {{$projectcontract->period_contract}}
                                        </div>
                                        </div>

                                    </div>
                            </div>
                            <br>
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-3">
                            <div class="col-md-5">
                                    <strong>
                                        {{trans('admin.start_implementation')}}
                                    </strong>
                                </div>
                                <div class="col-md-7">
                                    :     {{$projectcontract->start_implementation}}
                                </div>
                        </div>
                        <div class="col-md-3">
                            <div class="col-md-5">

                                <strong>
                                    {{trans('admin.end_implementation')}}
                                </strong>
                            </div>
                            <div class="col-md-7">
                   :     {{$projectcontract->end_implementation}}
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="col-md-5">
                                            <strong>
                                                {{trans('admin.start_warranty')}}
                                            </strong>
                                        </div>
                                        <div class="col-md-7">
                                            :     {{$projectcontract->start_warranty}}
                                        </div>
                        </div>
                        <div class="col-md-3">
                            <div class="col-md-5">
                                <strong>
                                    {{trans('admin.end_warranty')}}
                                </strong>
                            </div>
                            <div class="col-md-7">
                                :     {{$projectcontract->end_warranty}}
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-3">
                            <div class="col-md-8">
                                <strong>
                                    {{trans('admin.number_employees')}}
                                </strong>
                            </div>
                            <div class="col-md-4">
                                :     {{$projectcontract->number_employees	}}
                            </div>
                                </div>
                        <div class="col-md-3">
                            <div class="col-md-8">
                                <strong>
                                    {{trans('admin.Hour_employee')}}
                                </strong>
                            </div>
                            <div class="col-md-4">
                                :     {{$projectcontract->Hour_employee	}}
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="col-md-8">
                                    <strong>
                                        {{trans('admin.number_months')}}
                                    </strong>
                                </div>
                                <div class="col-md-4">
                                    :     {{$projectcontract->number_months	}}
                                </div>
                        </div>
                        <div class="col-md-3">
                            <div class="col-md-9">
                                    <strong>
                                        {{trans('admin.monthly_payment')}}
                                    </strong>
                                </div>
                                <div class="col-md-3">
                                    :     {{$projectcontract->monthly_payment	}}
                                </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12">
                            <div class="col-md-3">
                                <div class="col-md-8">
                                    <strong>
                                        {{trans('admin.revenue_measurement')}}
                                    </strong>
                                </div>
                                <div class="col-md-4">
                                    :     {{$projectcontract->revenue_measurement	}}
                                </div>
                            </div>
                        <div class="col-md-3">
                            <div class="col-md-9">
                                    <strong>
                                        {{trans('admin.expenses_measurement')}}
                                    </strong>
                                </div>
                                <div class="col-md-3">
                                    :     {{$projectcontract->expenses_measurement	}}
                                </div>
                        </div>
                        <div class="col-md-3">
                            <div class="col-md-6">
                                    <strong>
                                        {{trans('admin.cost_limit')}}
                                    </strong>
                                </div>
                                <div class="col-md-6">
                                    :     {{$projectcontract->cost_limit	}}
                                </div>
                        </div>
                        <div class="col-md-3">
                            <div class="col-md-8">
                                            <strong>
                                                {{trans('admin.actual_cost')}}
                                            </strong>
                                        </div>
                                <div class="col-md-4">
                                    :     {{$projectcontract->actual_cost	}}
                                </div>
                        </div>

                    </div>
                </div>
                <br>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-4">
                            <div class="col-md-9">
                                    <strong>
                                        {{trans('admin.Estimated_value')}}
                                    </strong>
                                </div>
                                <div class="col-md-3">
                                    :     {{$projectcontract->Estimated_value		}}
                                </div>
                        </div>
                        <div class="col-md-4">
                            <div class="col-md-6">
                            <strong>
                                {{trans('admin.contract_value')}}
                            </strong>
                                </div>
                                <div class="col-md-6">
                                    :     {{$projectcontract->contract_value	}}
                                </div>
                        </div>
                        <div class="col-md-4">
                            <div class="col-md-7">
                                            <strong>
                                                {{trans('admin.Bank_guarantee_number')}}
                                            </strong>
                                </div>
                                        <div class="col-md-5">
                                            :     {{$projectcontract->Bank_guarantee_number	}}
                                        </div>
                            </div>
                        </div>

                </div>

        <br>
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-4">
                    <div class="col-md-6">
                        <strong>
                            {{trans('admin.deviation_value')}}
                        </strong>
                    </div>
                                <div class="col-md-6">
                                    :     {{$projectcontract->deviation_value	}}
                                </div>
                </div>
                <div class="col-md-4">
                    <div class="col-md-6">

                                        <strong>
                                            {{trans('admin.amount_guarantee')}}
                                        </strong>
                                    </div>
                                    <div class="col-md-6">
                                        :     {{$projectcontract->amount_guarantee	}}
                                    </div>
                </div>
                <div class="col-md-4">
                    <div class="col-md-6">

                        <strong>
                            {{trans('admin.warranty_history')}}

                        </strong>
                    </div>
                    <div class="col-md-6">
                        :     {{$projectcontract->warranty_history	}}

                    </div>
                </div>



        </div>

        </div>
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <div class="col-md-6">
                            <strong>
                                {{trans('admin.warranty_issued')}}
                            </strong>
                            </div>
                            <div class="col-md-6">


                            :     {{$projectcontract->warranty_issued	}}
                        </div>
                        </div>
                            <div class="col-md-6">
                                <div class="col-md-6">
                            <strong>
                                {{trans('admin.warranty_issued_en')}}
                            </strong>
                                </div>
                                <div class="col-md-6">


                                :     {{$projectcontract->warranty_issued_en	}}





                    </div>
                            </div>


                    </div>

                </div>
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-3">
                            <div class="col-md-8">
                            <strong>
                                            {{trans('admin.comprehensive_insurance')}}
                            </strong>
                            </div>
                            <div class="col-md-4">
                    :     {{$projectcontract->comprehensive_insurance	}}
                            </div>
                        </div>


                        <div class="col-md-3">
                            <div class="col-md-8">
                                <strong>
                                            {{trans('admin.contractor_insurance')}}
                                </strong>
                            </div>
                            <div class="col-md-4">
                                :     {{$projectcontract->contractor_insurance	}}
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="col-md-8">
                                <strong>
                                    {{trans('admin.reference_retirement')}}
                                </strong>
                            </div>
                            <div class="col-md-4">
                                :     {{$projectcontract->reference_retirement	}}
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="col-md-8">
                                <strong>
                                    {{trans('admin.customer_name')}}
                                </strong>
                            </div>
                            <div class="col-md-4">
                                :     {{session_lang($subscription[0]->name_en,$subscription[0]->name_ar)}}
                            </div>
                        </div>



                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-3">
                            <div class="col-md-6">
                                <strong>
                                    {{trans('admin.management_expenses')}}
                                </strong>
                            </div>
                            <div class="col-md-3">
                             {{$projectcontract->management_expenses_percentage	}} %
                            </div>
                            <div class="col-md-3">
                               {{$projectcontract->management_expenses	}}
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="col-md-6">
                                <strong>
                                    {{trans('admin.department_expenses')}}
                                </strong>
                            </div>
                            <div class="col-md-3">
                                {{$projectcontract->department_expenses_percentage	}} %
                            </div>
                            <div class="col-md-3">
                                {{$projectcontract->department_expenses	}}
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="col-md-6">
                                <strong>
                                    {{trans('admin.warranty_period')}}
                                </strong>
                            </div>
                            <div class="col-md-3">
                                {{$projectcontract->warranty_period_percentage	}} %
                            </div>
                            <div class="col-md-3">
                                {{$projectcontract->warranty_period	}}
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="col-md-6">
                                <strong>
                                    {{trans('admin.financial_expenses')}}
                                </strong>
                            </div>
                            <div class="col-md-3">
                                {{$projectcontract->financial_expenses_percentage	}} %
                            </div>
                            <div class="col-md-3">
                                {{$projectcontract->financial_expenses	}}
                            </div>
                        </div>



                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-3">
                            <div class="col-md-6">
                                <strong>
                                    {{trans('admin.subtotal')}}
                                </strong>
                            </div>
                            <div class="col-md-3">
                                {{$projectcontract->subtotal_percentage	}} %
                            </div>
                            <div class="col-md-3">
                                {{$projectcontract->subtotal	}}
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="col-md-6">
                                <strong>
                                    {{trans('admin.net_deviation')}}
                                </strong>
                            </div>
                            <div class="col-md-3">
                                {{$projectcontract->net_deviation_percentage	}} %
                            </div>
                            <div class="col-md-3">
                                {{$projectcontract->net_deviation	}}
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="col-md-6">
                                <strong>
                                    {{trans('admin.total_collection')}}
                                </strong>
                            </div>
                            <div class="col-md-3">
                                {{$projectcontract->total_collection	}}
                            </div>

                        </div>
                        <div class="col-md-3">
                            <div class="col-md-6">
                                <strong>
                                    {{trans('admin.current_balance')}}
                                </strong>
                            </div>
                            <div class="col-md-3">
                                {{$projectcontract->current_balance	}}
                            </div>

                        </div>
                    </div>
                </div>



@endsection