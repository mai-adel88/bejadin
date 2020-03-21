@extends('hr.index')

@section('content')
    @push('css')
        <style>

            .subbadgit{
                padding: 30px 10px;
            }
            .select2-container--default .select2-selection--multiple .select2-selection__choice{
                background-color: #333;
            }
            /* @if(session('lang') == 'ar')
                .wysihtml5-sandbox .wysihtml5-editor{
                direction: rtl;
            }
            .fi-img{
                text-align: right;
                direction: rtl;
            }
            @endif */
        </style>

    @endpush

    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>{{$users->count()}}</h3>
                    <p>{{trans('admin.User_Registrations')}}</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="#" class="small-box-footer">{{trans('admin.More_info')}} <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    @if (auth()->guard('hr')->user()->branches_id != null)
                        @if (auth()->guard('hr')->user()->branches_id == \App\Branches::all()->first()->id)
                            <h3>{{$subscription->count()}}</h3>
                        @else
                            <h3>{{count(\App\Branches::find(auth()->guard('hr')->user()->branches_id)->subscribers)}}</h3>
                        @endif
                    @else
                        <h3>0</h3>
                    @endif
                    <p>{{trans('admin.Subscribers')}}</p>
                </div>
                <div class="icon">
                    <i class="fa fa-users"></i>
                </div>
                <a href="#" class="small-box-footer">{{trans('admin.More_info')}} <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    @if (auth()->guard('hr')->user()->branches_id != null)
                        @if (auth()->guard('hr')->user()->branches_id == \App\Branches::all()->first()->id)
                            <h3>{{$drivers->count()}}</h3>
                        @else
                            <h3>{{count(\App\Branches::find(auth()->guard('hr')->user()->branches_id)->drivers)}}</h3>
                        @endif
                    @else
                        <h3>0</h3>
                    @endif

                    <p>{{trans('admin.drivers')}}</p>
                </div>
                <div class="icon">
                    <i class="fa fa-id-card"></i>
                </div>
                <a href="#" class="small-box-footer">{{trans('admin.More_info')}} <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
                <div class="inner">
                    @if (auth()->guard('hr')->user()->branches_id != null)
                        @if (auth()->guard('hr')->user()->branches_id == \App\Branches::all()->first()->id)
                            <h3>{{\App\bus::count()}}</h3>
                        @else
                            <h3>{{\App\bus::where('branche_id',auth()->guard('admin')->user()->branches_id)->count()}}</h3>
                        @endif
                    @else
                        <h3>0</h3>
                    @endif

                    <p>{{trans('admin.buses')}}</p>
                </div>
                <div class="icon">
                    <i class="fa fa-bus"></i>
                </div>
                <a href="#" class="small-box-footer">{{trans('admin.More_info')}} <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>

{{--    @hasrole('hr')--}}
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4><i class="fa fa-dashboard"></i> {{trans('hr.control_panel_setting')}}</h4>
        </div>
        <div class="panel-body bg-gray">

            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="fa fa-building"></i></span>
                    <div class="info-box-content">
                        <h5><a href="{{route('mainCompany.index')}}">{{trans('hr.com_fixes')}}</a></h5>
                    </div>
                </div>
                <!-- /.info-box -->
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="fa fa-desktop"></i></span>
                    <div class="info-box-content">
                        <h5><a href="">{{trans('hr.when_system_start')}}</a></h5>
                    </div>
                </div>
                <!-- /.info-box -->
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="fa fa-flag"></i></span>
                    <div class="info-box-content">
                        <h5><a href="{{route('nationality.index')}}">{{trans('hr.nationality')}}</a></h5>
                    </div>
                </div>
                <!-- /.info-box -->
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="fa fa-home"></i></span>
                    <div class="info-box-content">
                        <h5><a href="{{route('placeLicence.index')}}">{{trans('hr.where_licences_cities')}}</a></h5>
                    </div>
                </div>
                <!-- /.info-box -->
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="fa fa-exchange"></i></span>
                    <div class="info-box-content">
                        <h5><a href="{{route('entryDeparturePorts.index')}}">{{trans('hr.entry_and_departure_ports')}}</a></h5>
                    </div>
                </div>
                <!-- /.info-box -->
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="fa fa-money"></i></span>
                    <div class="info-box-content">
                        <h5><a href="{{route('bankPaymentData.index')}}">{{trans('hr.banks_information')}}</a></h5>
                    </div>
                </div>
                <!-- /.info-box -->
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="fa fa-hotel"></i></span>
                    <div class="info-box-content">
                        <h5><a href="{{route('houseTypeClass.index')}}">{{trans('hr.live_types_class')}}</a></h5>
                    </div>
                </div>
                <!-- /.info-box -->
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="fa fa-map-marker"></i></span>
                    <div class="info-box-content">
                        <h5><a href="{{route('companyLicencePlace.index')}}">{{trans('hr.where_com_license')}}</a></h5>
                    </div>
                </div>
                <!-- /.info-box -->
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="fa fa-sort"></i></span>
                    <div class="info-box-content">
                        <h5><a href="{{route('companyLicenceType.index')}}">{{trans('hr.com_license_types')}}</a></h5>
                    </div>
                </div>
                <!-- /.info-box -->
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="fa fa-compass"></i></span>
                    <div class="info-box-content">
                        <h5><a href="{{route('companyLicenceProviders.index')}}">{{trans('hr.com_license_providers')}}</a></h5>
                    </div>
                </div>
                <!-- /.info-box -->
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="fa fa-compass"></i></span>
                    <div class="info-box-content">
                        <h5><a href="{{route('emp_data')}}">{{trans('hr.employee_data')}}</a></h5>
                    </div>
                </div>
                <!-- /.info-box -->
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="fa fa-compass"></i></span>
                    <div class="info-box-content">
                        <h5><a href="{{route('hrcountries.index')}}">{{trans('admin.countries')}}</a></h5>
                    </div>
                </div>
                <!-- /.info-box -->
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="fa fa-compass"></i></span>
                    <div class="info-box-content">
                        <h5><a href="{{route('hrdepartments.index')}}">{{trans('hr.departments')}}</a></h5>
                    </div>
                </div>
                <!-- /.info-box -->
            </div>
            <!-- الإدارات  وجهات العمل -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="fa fa-street-view"></i></span>
                    <div class="info-box-content">
                        <h5><a href="{{route('departmentLoc.pages')}}">{{trans('hr.dep_loc')}}</a></h5>
                    </div>
                </div>
                <!-- /.info-box -->
            </div>
            <!-- العناوين -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="fa fa-street-view"></i></span>
                    <div class="info-box-content">
                        <h5><a href="{{route('address.index')}}">{{trans('hr.address')}}</a></h5>
                    </div>
                </div>
                <!-- /.info-box -->
            </div>
            <!-- المرافقين -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <a href="{{route('dependents.index')}}">
                        <span class="info-box-icon bg-aqua"><i class="fa fa-users"></i></span>
                        <div class="info-box-content">
                            <h5>{{trans('hr.escorts')}}</h5>
                        </div>
                    </a>
                </div>
                <!-- /.info-box -->
            </div>

        </div>
    </div>
{{--    @endhasrole--}}

@endsection
