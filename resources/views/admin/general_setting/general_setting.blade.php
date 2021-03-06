@extends('admin.index')
@section('title','اعدادات')

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
            <a href="sales_setting">
                <div class="info-box">
                    <span class="info-box-icon bg-warning"><i class="fa fa-calculator"></i></span>

                    <div class="info-box-content">
                        <h2 class="info-box-text">اعدادات المبيعات</h2>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </a>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <a href="account_setting">
                <div class="info-box">
                    <span class="info-box-icon bg-warning"><i class="fa fa-user-plus"></i></span>

                    <div class="info-box-content">
                        <h2 class="info-box-text">اعدادات الحسابات</h2>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </a>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <a href="#">
                <div class="info-box">
                    <span class="info-box-icon bg-warning"><i class="fa fa-shopping-cart"></i></span>

                    <div class="info-box-content">
                        <h2 class="info-box-text">اعدادات الموظفين</h2>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </a>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <a href="contractortype">
                <div class="info-box">
                    <span class="info-box-icon bg-warning"><i class="fa fa-users"></i></span>

                    <div class="info-box-content">
                        <h2 class="info-box-text">اعدادات المشاريع</h2>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </a>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <a href="#">
                <div class="info-box">
                    <span class="info-box-icon bg-warning"><i class="fa fa-users"></i></span>

                    <div class="info-box-content">
                        <h2 class="info-box-text">اعدادات السيارات</h2>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </a>
        </div>

    </div>


@endsection
