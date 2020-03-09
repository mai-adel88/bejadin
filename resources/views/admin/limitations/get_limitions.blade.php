@extends('admin.index')
@section('title','القيود اليومية')

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
            <a href="limitations">
                <div class="info-box">
                    <span class="info-box-icon bg-warning"><i class="fa fa-calculator"></i></span>

                    <div class="info-box-content">
                        <h2 class="info-box-text">تسجيل القيود اليومية</h2>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </a>
        </div>
{{--        <div class="col-md-3 col-sm-6 col-12">--}}
{{--            <a href="limitations/create">--}}
{{--                <div class="info-box">--}}
{{--                    <span class="info-box-icon bg-warning"><i class="fa fa-user-plus"></i></span>--}}

{{--                    <div class="info-box-content">--}}
{{--                        <h2 class="info-box-text">تسجيل قيود اليومية</h2>--}}
{{--                    </div>--}}
{{--                    <!-- /.info-box-content -->--}}
{{--                </div>--}}
{{--                <!-- /.info-box -->--}}
{{--            </a>--}}
{{--        </div>--}}
        <div class="col-md-3 col-sm-6 col-12">
            <a href="openingentry/create">
                <div class="info-box">
                    <span class="info-box-icon bg-warning"><i class="fa fa-shopping-cart"></i></span>

                    <div class="info-box-content">
                        <h2 class="info-box-text">اضافة قيد افتتاحي </h2>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </a>
        </div>


    </div>


@endsection
