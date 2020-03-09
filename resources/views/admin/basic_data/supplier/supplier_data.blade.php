@extends('admin.index')
@section('title',' البيانات الموردين')

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
            <a href="suppliers">
                <div class="info-box">
                    <span class="info-box-icon bg-warning"><i class="fa fa-users" aria-hidden="true"></i></span>

                    <div class="info-box-content">
                        <h2 class="info-box-text"> بيانات الاساسية الموردين</h2>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </a>
        </div>

        <div class="col-md-3 col-sm-6 col-12" hidden>
            <a href="#">
                <div class="info-box">
                    <span class="info-box-icon bg-warning"><i class="fa fa-percent" aria-hidden="true"></i></span>

                    <div class="info-box-content">
                        <h2 class="info-box-text">بيانات  التعاقد </h2>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </a>
        </div>
        <div class="col-md-3 col-sm-6 col-12" >
            <a href="astsupctg">
                <div class="info-box">
                    <span class="info-box-icon bg-warning"><i class="fa fa-percent" aria-hidden="true"></i></span>

                    <div class="info-box-content">
                        <h2 class="info-box-text">بيانات  تصنيف الموردين
                        </h2>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </a>
        </div >
        <div class="col-md-3 col-sm-6 col-12">
            <a href="supplier_report">
                <div class="info-box">
                    <span class="info-box-icon bg-warning"><i class="fa fa-file" aria-hidden="true"></i></span>

                    <div class="info-box-content">
                        <h2 class="info-box-text">تقارير </h2>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </a>
        </div>

    </div>


@endsection
