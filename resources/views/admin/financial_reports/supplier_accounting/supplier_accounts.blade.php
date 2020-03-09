@extends('admin.index')
@section('title',trans('admin.supplier_accounts'))

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
            <a href="supp_account_statement">
                <div class="info-box">
                    <span class="info-box-icon bg-warning"><i class="fa fa-calculator"></i></span>

                    <div class="info-box-content">
                        <h2 class="info-box-text">كشف حساب</h2>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </a>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <a href="supp_trial_balance">
                <div class="info-box">
                    <span class="info-box-icon bg-warning"><i class="fa fa-balance-scale"></i></span>

                    <div class="info-box-content">
                        <h2 class="info-box-text">ميزان مراجعة </h2>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </a>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <a href="sup_daily_restriction">
                <div class="info-box">
                    <span class="info-box-icon bg-warning"><i class="fa fa-500px"></i></span>

                    <div class="info-box-content">
                        <h2 class="info-box-text">تقارير قيود اليومية</h2>
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
