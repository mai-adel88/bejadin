@extends('admin.index')
@section('title',' البيانات الحسابات')

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
            <a href="departments">
                <div class="info-box">
                    <span class="info-box-icon bg-warning"><i class="fa fa-users" aria-hidden="true"></i></span>

                    <div class="info-box-content">
                        <h2 class="info-box-text"> بيانات   دليل الحسابات</h2>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </a>
        </div>

        <div class="col-md-3 col-sm-6 col-12">
            <a href="departments/reports/report">
                <div class="info-box">
                    <span class="info-box-icon bg-warning"><i class="fa fa-percent" aria-hidden="true"></i></span>

                    <div class="info-box-content">
                        <h2 class="info-box-text"> تقارير دليل الحسابات </h2>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </a>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <a href="{{route('goTree')}}">
                <div class="info-box">
                    <span class="info-box-icon bg-warning"><i class="fa fa-file" aria-hidden="true"></i></span>

                    <div class="info-box-content">
                        <h2 class="info-box-text">طباعه شجرة الحسابات </h2>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </a>
        </div>

    </div>


@endsection
