@extends('admin.index')
@section('title','العقود والمشاريع')

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
            <br>
            <a href="projects">
                <div class="info-box">
                    <span class="info-box-icon bg-warning"><i class="fa fa-product-hunt" aria-hidden="true"></i></span>

                    <div class="info-box-content">
                        <h2 class="info-box-text">المشاريع</h2>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </a>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <br>

            <a href="project_contract">
                <div class="info-box">
                    <span class="info-box-icon bg-warning"><i class="fa fa-file-archive-o" aria-hidden="true"></i></span>

                    <div class="info-box-content">
                        <h2 class="info-box-text">عقود المشاريع</h2>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </a>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <br>

            <a href="#">
                <div class="info-box">
                    <span class="info-box-icon bg-warning"><i class="fa fa-file" aria-hidden="true"></i></span>

                    <div class="info-box-content">
                        <h2 class="info-box-text">تقارير المشاريع</h2>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </a>
        </div>


    </div>


@endsection
