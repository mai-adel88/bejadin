@extends('admin.index')
@section('title', trans('admin.data_projectsite_single') .' '.session_lang($ProjectsSites->name_en,$ProjectsSites->name_ar))
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
                    <img class="profile-user-img img-responsive img-circle" src="@if($ProjectsSites->image != null){{asset('storage/'.$ProjectsSites->image)}}@else {{url('/')}}/adminlte/previewImage.png @endif" alt="User profile picture">

                    <h3 class="profile-username text-center">{{session_lang($ProjectsSites->name_en,$ProjectsSites->name_ar)}}</h3>

                    {{--  <p class="text-muted text-center">{{\App\Enums\StatusType::getDescription($ProjectsSites->status)}}</p>  --}}

                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <b>{{trans('admin.responsible_person')}}</b><br> <a class="pull-right">{{$ProjectsSites->responsible_person}}</a>
                        </li>
                        <li class="list-group-item">
                            <b>{{trans('admin.contract_number')}}</b><br> <a class="pull-right">{{$ProjectsSites->contract_number}}</a>
                        </li>
                        <li class="list-group-item">
                            <b>{{trans('admin.phone_number')}}</b><br> <a class="pull-right">{{$ProjectsSites->phone_number}}</a>
                        </li>
                        <li class="list-group-item">
                            <b>{{trans('admin.email_projectsite')}}</b><br> <a class="pull-right">{{$ProjectsSites->email}}</a>
                        </li>
                        <li class="list-group-item">
                            <b>{{trans('admin.warehouse')}}</b><br> <a class="pull-right">{{$ProjectsSites->warehouse}}</a>
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
                                    {{trans('admin.project_name')}}
                                </strong>
                            </div>
                            <div class="col-md-9">
                                :     {{$ProjectsSites->project->name_ar}}
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-3">
                                <strong>
                                    {{trans('admin.projectsite_name')}}
                                </strong>
                            </div>
                            <div class="col-md-9">
                                :     {{session_lang($ProjectsSites->name_en,$ProjectsSites->name_ar)}}
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-3">
                                <strong>
                                    {{trans('admin.single_cc')}}
                                </strong>
                            </div>
                            <div class="col-md-9">
                                :     {{$ProjectsSites->glcc}}
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
                                :     {{$ProjectsSites->contract_number}}
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
                                :     {{$ProjectsSites->phone_number}}
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-3">
                                <strong>
                                    {{trans('admin.email_projectsite')}}
                                </strong>
                            </div>
                            <div class="col-md-9">
                                :     {{$ProjectsSites->email}}
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
                                :     {{$ProjectsSites->responsible_person}}
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
                                :     {{$ProjectsSites->warehouse}}
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-3">
                                <strong>
                                    {{trans('admin.projectsite_title')}}
                                </strong>
                            </div>
                            <div class="col-md-9">
                                :     {{$ProjectsSites->project_title}}
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