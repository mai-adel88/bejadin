@extends('admin.index')
@section('title','التقارير المالية')

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
        <a href="general_accounts">
        <div class="info-box">
            <span class="info-box-icon bg-warning"><i class="fa fa-calculator"></i></span>

            <div class="info-box-content">
                <h2 class="info-box-text">تقارير الحسابات العامة</h2>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
        </a>
    </div>
    <div class="col-md-3 col-sm-6 col-12">
        <a href="customer_accounting">
        <div class="info-box">
            <span class="info-box-icon bg-warning"><i class="fa fa-user-plus"></i></span>

            <div class="info-box-content">
                <h2 class="info-box-text">تقارير محاسبة العملاء</h2>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
        </a>
    </div>
    <div class="col-md-3 col-sm-6 col-12">
        <a href="supplier_accounting">
        <div class="info-box">
            <span class="info-box-icon bg-warning"><i class="fa fa-shopping-cart"></i></span>

            <div class="info-box-content">
                <h2 class="info-box-text">تقارير محاسبة الموردين</h2>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
        </a>
    </div>
    <div class="col-md-3 col-sm-6 col-12">
        <a href="staff_accounting">
        <div class="info-box">
            <span class="info-box-icon bg-warning"><i class="fa fa-users"></i></span>

            <div class="info-box-content">
                <h2 class="info-box-text">تقارير محاسبة الموظفين</h2>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
        </a>
    </div>
    <div class="col-md-3 col-sm-6 col-12">
        <a href="cc_accounting">
        <div class="info-box">
            <span class="info-box-icon bg-warning"><i class="fa fa-money" aria-hidden="true"></i>
</span>

            <div class="info-box-content">
                <h2 class="info-box-text">تقارير مراكز التكلفة</h2>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
        </a>
    </div>

</div>


@endsection
