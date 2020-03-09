@extends('admin.index')
@section('title',' البيانات الاساسية للموظفين ')

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
                    <span class="info-box-icon bg-warning"><i class="fa fa-users" aria-hidden="true"></i></span>

                    <div class="info-box-content">
                        <h2 class="info-box-text"> بيانات الاساسية للموظفين</h2>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </a>
        </div>

        <div class="col-md-3 col-sm-6 col-12" hidden>
            <a href="customer_report">
                <div class="info-box">
                    <span class="info-box-icon bg-warning"><i class="fa fa-percent" aria-hidden="true"></i></span>

                    <div class="info-box-content">
                        <h2 class="info-box-text">تصنيف التعاقد للعملاء</h2>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </a>
        </div>
        <div class="col-md-3 col-sm-6 col-12" hidden>
            <a href="#">
                <div class="info-box">
                    <span class="info-box-icon bg-warning"><i class="fa fa-exchange" aria-hidden="true"></i></span>

                    <div class="info-box-content">
                        <h2 class="info-box-text">تحويل العملاء المندوب</h2>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </a>
        </div>

        <div class="col-md-3 col-sm-6 col-12">
            <a href="employees_report">
                <div class="info-box">
                    <span class="info-box-icon bg-warning"><i class="fa fa-file" aria-hidden="true"></i></span>

                    <div class="info-box-content">
                        <h2 class="info-box-text">تقارير</h2>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </a>
        </div>

    </div>


@endsection
