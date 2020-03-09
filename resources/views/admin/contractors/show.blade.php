@extends('admin.index')
@section('title', trans('admin.Contractor_data') .' '.session_lang($contractor->name_en,$contractor->name_ar))
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
                    <img class="profile-user-img img-responsive img-circle" src="@if($contractor->image != null){{asset('storage/'.$contract->image)}}@else {{url('/')}}/adminlte/previewImage.png @endif" alt="User profile picture">

                    <h3 class="profile-username text-center">{{session_lang($contractor->name_en,$contractor->name_ar)}}</h3>

                    {{--  <p class="text-muted text-center">{{\App\Enums\StatusType::getDescription($contract->status)}}</p>  --}}

                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <b>{{trans('admin.contract_name')}}</b><br> <a class="pull-right">{{session_lang($contractor->name_en,$contractor->name_ar)}}</a>
                        </li>
                        <li class="list-group-item">
                            <b>{{trans('admin.Type_of_Contractor')}}</b><br> <a class="pull-right">{{$contractor->contractortype->name_ar}}</a>
                        </li>
                        <li class="list-group-item">
                            <b>{{trans('admin.address')}}</b><br> <a class="pull-right">{{$contractor->address}}</a>
                        </li>
                        <li class="list-group-item">
                            <b>{{trans('admin.country')}}</b><br> <a class="pull-right">{{$contractor->country->country_name_ar}}</a>
                        </li>
                        <li class="list-group-item">
                            <b>{{trans('admin.account_number')}}</b><br> <a class="pull-right">{{$contractor->account_number}}</a>
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
                                    {{trans('admin.Name_of_Contractor_in_Arabic')}}
                                </strong>
                            </div>
                            <div class="col-md-9">
                                :     {{session_lang($contractor->name_en,$contractor->name_ar)}}
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-3">
                                <strong>
                                    {{trans('admin.Name_of_Contractor_in_English')}}
                                </strong>
                            </div>
                            <div class="col-md-9">
                                :     {{$contractor->name_en}}
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-3">
                                <strong>
                                    {{trans('admin.Type_of_Contractor')}}
                                </strong>
                            </div>
                            <div class="col-md-9">
                                :     {{$contractor->contractortype->name_ar}}
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-3">
                                <strong>
                                    {{trans('admin.address')}}
                                </strong>
                            </div>
                            <div class="col-md-9">
                                :     {{$contractor->address}}
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-3">
                                <strong>
                                    {{trans('admin.country')}}
                                </strong>
                            </div>
                            <div class="col-md-9">
                                :     {{$contractor->country->country_name_ar}}
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-3">
                                <strong>
                                    {{trans('admin.currency')}}
                                </strong>
                            </div>
                            <div class="col-md-9">
                                :     {{\App\Enums\CurrencyType::getDescription($contractor->currency)}}
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-3">
                                <strong>
                                    {{trans('admin.Credit_limit')}}
                                </strong>
                            </div>
                            <div class="col-md-9">
                                :     {{$contractor->credit_limit}}
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-3">
                                <strong>
                                    {{trans('admin.account_number')}}
                                </strong>
                            </div>
                            <div class="col-md-9">
                                :     {{$contractor->account_number}}
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-3">
                                <strong>
                                    {{trans('admin.debtor')}}
                                </strong>
                            </div>
                            <div class="col-md-9">
                                :     {{$contractor->debtor}}
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-3">
                                <strong>
                                    {{trans('admin.creditor')}}
                                </strong>
                            </div>
                            <div class="col-md-9">
                                :     {{$contractor->creditor}}
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
                        @foreach($responsiblePerson as $Person)
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
                        @endforeach
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