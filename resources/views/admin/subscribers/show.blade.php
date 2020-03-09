@extends('admin.index')
@section('title',trans('admin.show_profile_to') .session_lang($subscriber->Cstm_NmEr,$subscriber->Cstm_NmAr))
@section('content')
@push('css')
    <style>
        .list-group-item {
            padding: 30px 15px !important;
        }
        .arabic{
            direction: ltr;
        }
    </style>

    @endpush


        <div class="row">
            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        @if($subscriber->image != null)
                            <img class="profile-user-img img-responsive img-circle" src="{{asset('storage/'.$subscriber->image)}}" alt="{{trans('admin.User_profile_picture')}}">
                        @else
                            <img src="{{asset('/')}}adminlte/previewImage.png" class="profile-user-img img-responsive img-circle" alt="User Image">
                        @endif

                        <h3 class="profile-username text-center">{{session_lang($subscriber->Cstm_NmEr,$subscriber->Cstm_NmAr)}}</h3>

                        <p class="text-muted text-center">{{$subscriber->per_status}}</p>

                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b>{{trans('admin.email')}}</b> <br> <a class="pull-right">{{$subscriber->email}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>{{trans('admin.status')}}</b> <br> <a class="pull-right">@if($subscriber->status == 1)<div class="badge">{{trans('admin.active')}}</div>@else <div class="badge">{{trans('admin.deactive')}}</div> @endif</a>
                            </li>
                        </ul>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->

                <!-- About Me Box -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{trans('admin.About_Subscriber')}}</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">

                            @if(\App\Enums\TypeType::getDescription($subscriber->type) == 'student' || \App\Enums\TypeType::getDescription($subscriber->type) == 'طالب')
                                <strong><i class="fa fa-book margin-r-5"></i> {{trans('admin.education')}}</strong>
                                <p class="text-muted">
                                    {{$subscriber->per_status}}
                                </p>
                            @else
                                <strong><i class="fa fa-adjust margin-r-5"></i> {{trans('admin.activity')}}</strong>
                                    <p class="text-muted">
                                        {{$subscriber->per_status}}
                                    </p>
                            @endif


                        <hr>

                        <strong><i class="fa fa-map-marker margin-r-5"></i> {{trans('admin.Location')}}</strong>

                        <p class="text-muted">{{$subscriber->address}}</p>
                        <hr>

                        <strong><i class="fa fa-circle margin-r-5"></i> {{trans('admin.age')}}</strong>

                        <p class="text-muted">{{$subscriber->age}}</p>

                        <hr>

                        <strong><i class="fa fa-circle margin-r-5"></i> {{trans('admin.gender')}}</strong>

                        <p class="text-muted">{{\App\Enums\GenderType::getDescription($subscriber->gender)}}</p>



                            <strong><i class="fa fa-facebook margin-r-5"></i></strong>

                            <p class="text-muted">{{$subscriber->facebook}}</p>
                            <hr>

                            <strong><i class="fa fa-twitter margin-r-5"></i></strong>

                            <p class="text-muted">{{$subscriber->twitter}}</p>

                            <hr>

                            <strong><i class="fa fa-phone margin-r-5"></i> {{trans('admin.mob')}} </strong>

                            <p class="text-muted">{{$subscriber->phone_1}}</p>
                            <hr>

                            <strong><i class="fa fa-phone margin-r-5"></i> {{trans('admin.phone')}} </strong>

                            <p class="text-muted">{{$subscriber->phone_2}}</p>

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
                            <!-- Post -->
                            <ul class="timeline timeline-inverse">
                                <!-- timeline time label -->
                                <li class="time-label">
                                    <span class="@if(session('lang') == 'ar') arabic @else '' @endif @if($subscriber->status == 0) bg-red @else bg-green @endif">
                                      {{date('Y M d', strtotime($subscriber->created_at))}}
                                    </span>
                                    @if($subscriber->branches != null)
                                        <span class="@if(session('lang') == 'ar') arabic @else '' @endif @if($subscriber->status == 0) bg-red @else bg-green @endif">
                                          {{session_lang($subscriber->branches->name_en,$subscriber->branches->name_ar)}}
                                        </span>
                                    @endif
                                    <span class="@if(session('lang') == 'ar') arabic @else '' @endif @if($subscriber->status == 0) bg-red @else bg-green @endif">
                                        {{trans('admin.first_date_debtor')}} @if($subscriber->debtor != null) {{$subscriber->debtor}} {{trans('admin.'.setting()->currancy)}} @else 0 @endif
                                    </span>
                                    <span class="@if(session('lang') == 'ar') arabic @else '' @endif @if($subscriber->status == 0) bg-red @else bg-green @endif">
                                        {{trans('admin.first_date_creditor')}} @if($subscriber->creditor != null) {{$subscriber->creditor}} {{trans('admin.'.setting()->currancy)}} @else 0 @endif
                                    </span>
                                </li>
                                <!-- /.timeline-label -->
                                <!-- timeline item -->

                                <!-- END timeline item -->

                            </ul>
                            <!-- /.post -->
                        </div>
                        <!-- /.tab-pane -->
                    </div>
                </div>
            </div>







@endsection
