@extends('admin.index')
@section('title','اعدادات لوحة التحكم')

@section('content')
    @push('css')
        <style>
            .bg-warning {
                background-color: #ffc107!important;

            }
        </style>
    @endpush
    <div class="box">

        <div class="col-md-3 col-sm-6 col-12">
            <a href="setting">
                <div class="info-box">
                    <span class="info-box-icon bg-warning"><i class="fa fa-calculator"></i></span>

                    <div class="info-box-content">
                        <h2 class="info-box-text"> لوحة التحكم</h2>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </a>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <a href="companies">
                <div class="info-box">
                    <span class="info-box-icon bg-warning"><i class="fa fa-user-plus"></i></span>

                    <div class="info-box-content">
                        <h2 class="info-box-text">الشركات بالنظام</h2>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </a>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <a href="activities">
                <div class="info-box">
                    <span class="info-box-icon bg-warning"><i class="fa fa-shopping-cart"></i></span>

                    <div class="info-box-content">
                        <h2 class="info-box-text">انشطة الشركات بالنظام</h2>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </a>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <a href="branches">
                <div class="info-box">
                    <span class="info-box-icon bg-warning"><i class="fa fa-users"></i></span>

                    <div class="info-box-content">
                        <h2 class="info-box-text">الفروع بالشركات</h2>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </a>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <a href="{{route('stores.index')}}">
                <div class="info-box">
                    <span class="info-box-icon bg-warning"><i class="fa fa-money" aria-hidden="true"></i></span>

                    <div class="info-box-content">
                        <h2 class="info-box-text">{{trans('admin.delivery_place')}}</h2>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </a>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <a href="countries">
                <div class="info-box">
            <span class="info-box-icon bg-warning"><i class="fa fa-money" aria-hidden="true"></i></span>

                    <div class="info-box-content">
                        <h2 class="info-box-text">بيانات الدول </h2>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </a>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <a href="curencies">
                <div class="info-box">
            <span class="info-box-icon bg-warning"><i class="fa fa-money" aria-hidden="true"></i></span>

                    <div class="info-box-content">
                        <h2 class="info-box-text">بيانات العملات </h2>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </a>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <a href="#">
                <div class="info-box">
                    <span class="info-box-icon bg-warning"><i class="fa fa-money" aria-hidden="true"></i></span>

                    <div class="info-box-content">
                        <h2 class="info-box-text">المدن والمناطق </h2>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </a>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <a href="#">
                <div class="info-box">
            <span class="info-box-icon bg-warning"><i class="fa fa-money" aria-hidden="true"></i></span>

                    <div class="info-box-content">
                        <h2 class="info-box-text">طريقة الدفع للمبيعات و المشتريات </h2>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </a>
        </div>


        <div class="col-md-3 col-sm-6 col-12">
            <a href="{{route('import')}}">
                <div class="info-box">
            <span class="info-box-icon bg-warning"><i class="fa fa-money" aria-hidden="true"></i></span>

                    <div class="info-box-content">
                        <h2 class="info-box-text">{{trans('admin.data_transfere')}}</h2>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </a>
        </div>


    </div>


@endsection
