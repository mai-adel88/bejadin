@extends('admin.index')
@section('title','تقارير البيانات الاساسية')

@section('content')
    @push('css')
        <style>
            .bg-warning {
                background-color: #ffc107!important;

            }
        </style>
    @endpush
    <div class="box">
<div class="box-body">

        <div class="col-md-3 col-sm-6 col-12">
            <a href="department_Reports">
                <div class="info-box">
                    <span class="info-box-icon bg-warning"><i class="fa fa-calculator"></i></span>

                    <div class="info-box-content">
                        <h2 class="info-box-text">تقارير دليل الحسابات</h2>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </a>
        </div>



        <div class="col-md-3 col-sm-6 col-12">
            <a href="#">
                <div class="info-box">
            <span class="info-box-icon bg-warning"><i class="fa fa-money" aria-hidden="true"></i>
            </span>

                    <div class="info-box-content">
                        <h2 class="info-box-text">طباعة دليل الحسابات</h2>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </a>
        </div>

    </div>
        <a href="javascript:history.back()" class="btn btn-danger">الرجوع</a>
    </div>


@endsection
