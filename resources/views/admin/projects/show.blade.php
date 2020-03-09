@extends('admin.index')
@section('title', trans('admin.data_project_single') .' '.session_lang($project->name_en,$project->name_ar))
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
                    <img class="profile-user-img img-responsive img-circle" src="@if($project->image != null){{asset('storage/'.$project->image)}}@else {{url('/')}}/adminlte/previewImage.png @endif" alt="User profile picture">

                    <h3 class="profile-username text-center">{{session_lang($project->name_en,$project->name_ar)}}</h3>

                    <p class="text-muted text-center">{{\App\Enums\StatusType::getDescription($project->status)}}</p>

                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <b>{{trans('admin.customer_name')}}</b><br> <a class="pull-right">{{$project->responsible_person}}</a>
                        </li>
                        <li class="list-group-item">
                            <b>{{trans('admin.contract_number')}}</b><br> <a class="pull-right">{{$project->contract_number}}</a>
                        </li>
                        <li class="list-group-item">
                            <b>{{trans('admin.phone_number')}}</b><br> <a class="pull-right">{{$project->phone_number}}</a>
                        </li>
                        <li class="list-group-item">
                            <b>{{trans('admin.email_project')}}</b><br> <a class="pull-right">{{$project->email}}</a>
                        </li>
                        <li class="list-group-item">
                            <b>{{trans('admin.warehouse')}}</b><br> <a class="pull-right">{{$project->warehouse}}</a>
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
                                    {{trans('admin.name_project_ar')}}
                                </strong>
                            </div>
                            <div class="col-md-9">
                                :     {{session_lang($project->name_en,$project->name_ar)}}
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-3">
                                <strong>
                                    {{trans('admin.name_project_en')}}
                                </strong>
                            </div>
                            <div class="col-md-9">
                                :     {{$project->name_en}}
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
                                :     {{$project->contract_number}}
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-3">
                                <strong>
                                    {{trans('admin.phone_number')}}
                                </strong>
                            </div>
                            <div class="col-md-9">
                                :     {{$project->phone_number}}
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-3">
                                <strong>
                                    {{trans('admin.fax_number')}}
                                </strong>
                            </div>
                            <div class="col-md-9">
                                :     {{$project->fax_number}}
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-3">
                                <strong>
                                    {{trans('admin.email_project')}}
                                </strong>
                            </div>
                            <div class="col-md-9">
                                :     {{$project->email}}
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-3">
                                <strong>
                                    {{trans('admin.responsible_person')}}
                                </strong>
                            </div>
                            <div class="col-md-9">
                                :     {{$project->responsible_person}}
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-3">
                                <strong>
                                    {{trans('admin.warehouse')}}
                                </strong>
                            </div>
                            <div class="col-md-9">
                                :     {{$project->warehouse}}
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-3">
                                <strong>
                                    {{trans('admin.revenue')}}
                                </strong>
                            </div>
                            <div class="col-md-9">
                                :     {{$project->revenue}}
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-3">
                                <strong>
                                    {{trans('admin.expenses')}}
                                </strong>
                            </div>
                            <div class="col-md-9">
                                :     {{$project->expenses}}
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-3">
                                <strong>
                                    {{trans('admin.customer_name')}}
                                </strong>
                            </div>
                            <div class="col-md-9">
                               :     {{$project->subscribers['name_ar']}}
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-3">
                                <strong>
                                    {{trans('admin.project_title')}}
                                </strong>
                            </div>
                            <div class="col-md-9">
                                :     {{$project->project_title}}
                            </div>
                        </div>
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
