@extends('hr.index')
@section('title','الادارات وجهات العمل')

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
            <a href="{{route('departmentLoc.index')}}">
                <div class="info-box">
                    <span class="info-box-icon bg-warning"><i class="fa fa-street-view" aria-hidden="true"></i></span>

                    <div class="info-box-content">
                        <h2 class="info-box-text"> بيانات الادارات وجهات العمل </h2>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </a>
        </div>

        


    </div>


@endsection
