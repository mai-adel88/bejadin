@extends('admin.index')
@section('title',' بيانات  الاصناف')

@section('content')
    @push('css')
        <style>
            .bg-warning {
                background-color: #ffc107!important;

            }
        </style>
    @endpush
    <div class="box">
        <div class="col-md-4 col-sm-6 col-12">
            <a href="#">
                <div class="info-box">
                    <span class="info-box-icon bg-warning"><i class="fa fa-window-restore" aria-hidden="true"></i></span>

                    <div class="info-box-content">
                        <h2 class="info-box-text">{{trans('admin.basic_information')}}</h2>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </a>
        </div>

            <div class="col-md-4 col-sm-6 col-12">
                <a href="{{route('mainCategories.index')}}">
                    <div class="info-box">
                        <span class="info-box-icon bg-warning"><i class="fa fa-barcode" aria-hidden="true"></i></span>

                        <div class="info-box-content">
                            <h2 class="info-box-text">{{trans('admin.basic_types')}}</h2>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </a>
            </div>

                <div class="col-md-4 col-sm-6 col-12">
                    <a href="{{route('units.index')}}">
                        <div class="info-box">
                            <span class="info-box-icon bg-warning"><i class="fa fa-balance-scale" aria-hidden="true"></i></span>
                            <div class="info-box-content">
                                <h2 class="info-box-text"> الوحدات الرئيسية للاصناف</h2>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </a>
                </div>

                    <div class="col-md-4 col-sm-6 col-12">
                        <a href="#">
                            <div class="info-box">
                                <span class="info-box-icon bg-warning"><i class="fa fa-bookmark" aria-hidden="true"></i></span>

                                <div class="info-box-content">
                                    <h2 class="info-box-text">فئات الاصناف </h2>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </a>
                    </div>


        <div class="col-md-4 col-sm-6 col-12">
            <a href="#">
                <div class="info-box">
                    <span class="info-box-icon bg-warning"><i class="fa fa-file" aria-hidden="true"></i></span>

                    <div class="info-box-content">
                        <h2 class="info-box-text">تقارير الاصناف </h2>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </a>
        </div>

    </div>


@endsection
