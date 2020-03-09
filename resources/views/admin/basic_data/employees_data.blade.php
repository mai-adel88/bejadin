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
            <a href="employees">
                <div class="info-box">
                    <span class="info-box-icon bg-warning"><i class="fa fa-user-plus" aria-hidden="true"></i></span>

                    <div class="info-box-content">
                        <h2 class="info-box-text"> البيانات الماليه للموظفين</h2>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </a>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <a href="#">
                <div class="info-box">
                    <span class="info-box-icon bg-warning"><i class="fa fa-users" aria-hidden="true"></i></span>

                    <div class="info-box-content">
                        <h2 class="info-box-text"> تقارير الموظفين </h2>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </a>
        </div>

        <div class="col-md-3 col-sm-6 col-12">
            <a href="employeeData">
                <div class="info-box">
                    <span class="info-box-icon bg-warning"><i class="fa fa-file" aria-hidden="true"></i></span>

                    <div class="info-box-content">
                        <h2 class="info-box-text">{{trans('admin.employee_basic_data')}}</h2>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </a>
        </div>




    </div>


@endsection
