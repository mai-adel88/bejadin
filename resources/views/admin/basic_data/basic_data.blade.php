@extends('admin.index')
@section('title',' البيانات الاساسية')

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
            <a href="customer_data">
                <div class="info-box">
                    <span class="info-box-icon bg-warning"><i class="fa fa-users" aria-hidden="true"></i></span>

                    <div class="info-box-content">
                        <h2 class="info-box-text"> بيانات العملاء</h2>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </a>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <a href="supplier_data">
                <div class="info-box">
                    <span class="info-box-icon bg-warning"><i class="fa fa-shopping-cart"></i></span>

                    <div class="info-box-content">
                        <h2 class="info-box-text"> بيانات الموردين</h2>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </a>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <a href="departments_data">
                <div class="info-box">
                    <span class="info-box-icon bg-warning"><i class="fa fa-bitcoin"></i></span>

                    <div class="info-box-content">
                        <h2 class="info-box-text">دليل الحسابات</h2>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </a>
        </div>

        <div class="col-md-3 col-sm-6 col-12">
            <a href="cc_data">
                <div class="info-box">
                    <span class="info-box-icon bg-warning"><i class="fa fa-shopping-cart"></i></span>

                    <div class="info-box-content">
                        <h2 class="info-box-text">مراكز التكلفة</h2>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </a>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <a href="employees_data">
                <div class="info-box">
                    <span class="info-box-icon bg-warning"><i class="fa fa-user-plus" aria-hidden="true"></i></span>

                    <div class="info-box-content">
                        <h2 class="info-box-text"> بيانات الموظفين</h2>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </a>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <a href="contractors">
                <div class="info-box">
                    <span class="info-box-icon bg-warning"><i class="fa fa-users" aria-hidden="true"></i></span>

                    <div class="info-box-content">
                        <h2 class="info-box-text"> بيانات المقاولين </h2>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </a>
        </div>

        <div class="col-md-3 col-sm-6 col-12">
            <a href="Fixed_assets">
                <div class="info-box">
                    <span class="info-box-icon bg-warning"><i class="fa fa-user-plus" aria-hidden="true"></i></span>

                    <div class="info-box-content">
                        <h2 class="info-box-text">الاصول الثابته</h2>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </a>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <a href="cars_data">
                <div class="info-box">
                    <span class="info-box-icon bg-warning"><i class="fa fa-user-plus" aria-hidden="true"></i></span>

                    <div class="info-box-content">
                        <h2 class="info-box-text">بيانات السيارات</h2>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </a>
        </div>

        <div class="col-md-3 col-sm-6 col-12">
            <a href="categroy_data">
                <div class="info-box">

                    <span class="info-box-icon bg-warning"><i class="fa fa-window-restore" aria-hidden="true"></i></span>

                    <div class="info-box-content">
                        <h2 class="info-box-text">بيانات الأصناف</h2>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </a>
        </div>


    </div>


@endsection
