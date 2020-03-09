@extends('admin.index')
@section('title','محاسبة مراكز التكلفة')

@section('content')
    @push('css')
        <style>
            .info-box{
                background: #ffe8cc;
            }
            .bg-warning {
                background-color: #ffc107!important;

            }
        </style>
    @endpush
    <div class="box">
        <div class="box-body">

            <div class="col-md-3 col-sm-6 col-12">
                <a href="cc_balance">
                    <div class="info-box">
                        <span class="info-box-icon bg-warning"><i class="fa fa-calculator"></i></span>

                        <div class="info-box-content">
                            <h2 class="info-box-text">أرصدة مراكز التكلفه
                            </h2>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </a>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <a href="movement_statement">
                    <div class="info-box">
                        <span class="info-box-icon bg-warning"><i class="fa fa-balance-scale"></i></span>

                        <div class="info-box-content">
                            <h2 class="info-box-text">كشف بحركة مركز التكلفه</h2>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </a>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <a href="movement_balance">
                    <div class="info-box">
                        <span class="info-box-icon bg-warning"><i class="fa fa-500px"></i></span>

                        <div class="info-box-content">
                            <h2 class="info-box-text">ميزان مراجعه لمراكز التكلفة</h2>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </a>
            </div>
        </div>
        <a class="btn btn-danger" href="javascript:history.back()">الرجوع</a>
    </div>


@endsection
