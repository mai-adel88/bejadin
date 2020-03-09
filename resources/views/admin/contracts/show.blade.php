@extends('admin.index')
@section('title', trans('admin.Contract_data') .' '.session_lang($contractors[0]->name_en,$contractors[0]->name_ar))
@section('content')
    @push('css')
        <style>
            .list-group-item {
                padding: 30px 15px !important;
            }
        </style>

    @endpush


    <div class="row">
        <div class="col-md-3">

            <!-- Profile Image -->
            <div class="box box-primary">
                <div class="box-body box-profile">
                    <img class="profile-user-img img-responsive img-circle" src="@if($contract->image != null){{asset('storage/'.$contract->image)}}@else {{url('/')}}/adminlte/previewImage.png @endif" alt="User profile picture">

                    <h3 class="profile-username text-center">{{session_lang($branches->name_en,$branches->name_ar)}}</h3>

                    {{--  <p class="text-muted text-center">{{\App\Enums\StatusType::getDescription($contract->status)}}</p>  --}}

                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <b>{{trans('admin.contractor_name')}}</b><br> <a class="pull-right">{{session_lang($contractors[0]->name_en,$contractors[0]->name_ar)}}</a>
                        </li>
                        <li class="list-group-item">
                            <b>{{trans('admin.project_name')}}</b><br> <a class="pull-right">{{$contract->project[0]->name_ar}}</a>
                        </li>
                        <li class="list-group-item">
                            <b>{{trans('admin.Subscribers')}}</b><br> <a class="pull-right">{{session_lang($subscription[0]->name_en,$subscription[0]->name_ar)}}</a>
                        </li>
                        <li class="list-group-item">
                            <b>{{trans('admin.date')}}</b><br> <a class="pull-right">{{$contract->date}}</a>
                        </li>
                        <li class="list-group-item">
                            <b>{{trans('admin.Date_of_contract')}}</b><br> <a class="pull-right">{{$contract->contract_date}}</a>
                        </li>
                    </ul>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#activity" data-toggle="tab">{{trans('admin.activity')}}</a></li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="activity">
                        <div class="row">
                            <div class="col-md-3">
                                <strong>
                                    {{trans('admin.section')}}
                                </strong>
                            </div>
                            <div class="col-md-9">
                                :     {{session_lang($branches->name_en,$branches->name_ar)}}
                                {{-- :     {{$branches}} --}}
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-3">
                                <strong>
                                    {{trans('admin.date')}}
                                </strong>
                            </div>
                            <div class="col-md-9">
                                :     {{$contract->date}}
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-3">
                                <strong>
                                    {{trans('admin.higri_date')}}
                                </strong>
                            </div>
                            <div class="col-md-9">
                                :     {{$contract->higri_date}}
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-3">
                                <strong>
                                    {{trans('admin.contractor_name')}}
                                </strong>
                            </div>
                            <div class="col-md-9">
                                :     {{session_lang($contractors[0]->name_en,$contractors[0]->name_ar)}}
                                {{-- :     {{$contract->contractors}} --}}
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-3">
                                <strong>
                                    {{trans('admin.project_name')}}
                                </strong>
                            </div>
                            <div class="col-md-9">
                                :     {{$contract->project[0]->name_ar}}
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-3">
                                <strong>
                                    {{trans('admin.Reference_for_contracting')}}
                                </strong>
                            </div>
                            <div class="col-md-9">
                                :     {{$contract->Contract_reference}}
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-3">
                                <strong>
                                    {{trans('admin.Subscribers')}}
                                </strong>
                            </div>
                            <div class="col-md-9">
                                :     {{session_lang($subscription[0]->name_en,$subscription[0]->name_ar)}}
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-3">
                                <strong>
                                    {{trans('admin.contract_number')}}
                                </strong>
                            </div>
                            <div class="col-md-9">
                                :     {{$contract->contract_number}}
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-3">
                                <strong>
                                    {{trans('admin.Statement_ar')}}
                                </strong>
                            </div>
                            <div class="col-md-9">
                                :     {{$contract->statement_ar}}
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-3">
                                <strong>
                                    {{trans('admin.Statement_en')}}
                                </strong>
                            </div>
                            <div class="col-md-9">
                                :     {{$contract->statement_en}}
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-3">
                                <strong>
                                    {{trans('admin.Date_of_contract')}}
                                </strong>
                            </div>
                            <div class="col-md-9">
                                :     {{$contract->contract_date}}
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-3">
                                <strong>
                                    {{trans('admin.The_beginning_of_the_contract')}}
                                </strong>
                            </div>
                            <div class="col-md-9">
                                :     {{$contract->contract_start}}
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-3">
                                <strong>
                                    {{trans('admin.End_of_contract')}}
                                </strong>
                            </div>
                            <div class="col-md-9">
                                :     {{$contract->contract_end}}
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-3">
                                <strong>
                                    {{trans('admin.Contract_Period')}}
                                </strong>
                            </div>
                            <div class="col-md-9">
                                :     {{$contract->contract_period}}
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-3">
                                <strong>
                                    {{trans('admin.Start_of_implementation')}}
                                </strong>
                            </div>
                            <div class="col-md-9">
                                :     {{$contract->implementation_start}}
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-3">
                                <strong>
                                    {{trans('admin.End_of_implementation')}}
                                </strong>
                            </div>
                            <div class="col-md-9">
                                :     {{$contract->implementation_end}}
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-3">
                                <strong>
                                    {{trans('admin.The_beginning_of_the_warranty')}}
                                </strong>
                            </div>
                            <div class="col-md-9">
                                :     {{$contract->warranty_start}}
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-3">
                                <strong>
                                    {{trans('admin.End_of_warranty')}}
                                </strong>
                            </div>
                            <div class="col-md-9">
                                :     {{$contract->warranty_end}}
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-3">
                                <strong>
                                    {{trans('admin.Number_of_Employees')}}
                                </strong>
                            </div>
                            <div class="col-md-9">
                                :     {{$contract->employees_number}}
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-3">
                                <strong>
                                    {{trans('admin.Working_hours_of_the_employee')}}
                                </strong>
                            </div>
                            <div class="col-md-9">
                                :     {{$contract->employee_hour_work}}
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-3">
                                <strong>
                                    {{trans('admin.Number_of_months')}}
                                </strong>
                            </div>
                            <div class="col-md-9">
                                :     {{$contract->months_number}}
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-3">
                                <strong>
                                    {{trans('admin.Monthly_payment')}}
                                </strong>
                            </div>
                            <div class="col-md-9">
                                :     {{$contract->monthly_payment}}
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-3">
                                <strong>
                                    {{trans('admin.Contract_Value')}}
                                </strong>
                            </div>
                            <div class="col-md-9">
                                :     {{$contract->contract_value}}
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-3">
                                <strong>
                                    {{trans('admin.Estimated_Value')}}
                                </strong>
                            </div>
                            <div class="col-md-9">
                                :     {{$contract->estimated_value}}
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-3">
                                <strong>
                                    {{trans('admin.Deviation_value')}}
                                </strong>
                            </div>
                            <div class="col-md-9">
                                :     {{$contract->deviation_value}}
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-3">
                                <strong>
                                    {{trans('admin.Downpayment')}}
                                </strong>
                            </div>
                            <div class="col-md-9">
                                :     {{$contract->downpayment}}
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-3">
                                <strong>
                                    {{trans('admin.Warranty_expenses')}}
                                </strong>
                            </div>
                            <div class="col-md-9">
                                :     {{$contract->warranty_expenses}}
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-3">
                                <strong>
                                    {{trans('admin.insurance_value')}}
                                </strong>
                            </div>
                            <div class="col-md-9">
                                :     {{$contract->insurance_value}}
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-3">
                                <strong>
                                    {{trans('admin.The_contract_value_of_the_customer')}}
                                </strong>
                            </div>
                            <div class="col-md-9">
                                :     {{$contract->contract_value_customer}}
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-3">
                                <strong>
                                    {{trans('admin.Value_of_Subcontracts')}}
                                </strong>
                            </div>
                            <div class="col-md-9">
                                :     {{$contract->subcontracts_value}}
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-3">
                                <strong>
                                    {{trans('admin.Total_Payments')}}
                                </strong>
                            </div>
                            <div class="col-md-9">
                                :     {{$contract->total_payments}}
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-3">
                                <strong>
                                    {{trans('admin.current_balance')}}
                                </strong>
                            </div>
                            <div class="col-md-9">
                                :     {{$contract->current_balance}}
                            </div>
                        </div>
                        <br>
                        {{--  <div class="row">
                            <div class="col-md-3">
                                <strong>
                                    {{trans('admin.customer_name')}}
                                </strong>
                            </div>
                            <div class="col-md-9">
                                :     {{$contract->customer[0]->name_ar}}
                            </div>
                        </div>
                        <br>  --}}
                        {{-- @foreach($responsiblePerson as $Person)
                        <hr>
                        <div class="row">
                            <div class="col-md-6" style="margin-bottom: 15px;">
                                <div class="col-md-5">
                                    <strong>
                                        {{trans('admin.responsible_people')}}
                                    </strong>
                                </div>
                                <div class="col-md-7">
                                    :     {{$Person->responsible_people}}
                                </div>
                            </div>
                            <div class="col-md-6" style="margin-bottom: 15px;">
                                <div class="col-md-5">
                                    <strong>
                                        {{trans('admin.email')}}
                                    </strong>
                                </div>
                                <div class="col-md-7">
                                    :     {{$Person->email}}
                                </div>
                            </div>
                            <div class="col-md-4" style="margin-bottom: 15px;">
                                <div class="col-md-6">
                                    <strong>
                                        {{trans('admin.phone1')}}
                                    </strong>
                                </div>
                                <div class="col-md-6">
                                    :     {{$Person->phone1}}
                                </div>
                            </div>
                            <div class="col-md-4" style="margin-bottom: 15px;">
                                <div class="col-md-6">
                                    <strong>
                                        {{trans('admin.phone2')}}
                                    </strong>
                                </div>
                                <div class="col-md-6">
                                    :     {{$Person->phone2}}
                                </div>
                            </div>
                            <div class="col-md-4" style="margin-bottom: 15px;">
                                <div class="col-md-5">
                                    <strong>
                                        {{trans('admin.mobile')}}
                                    </strong>
                                </div>
                                <div class="col-md-7">
                                    :     {{$Person->mobile}}
                                </div>
                            </div>
                        </div>
                        @endforeach --}}
                        <!-- /.post -->
                    </div>
                    <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
            </div>
            <!-- /.nav-tabs-custom -->
        </div>
    </div>
@endsection
